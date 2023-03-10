<?php

namespace Src\Controllers;

class EventController 
{

  private $body;
  private $file;

  public function __construct()
  {

    $this->body = json_decode(file_get_contents('php://input'),true);
    $this->file = json_decode(file_get_contents(dirname(__DIR__).'/Data/file.json'),true);

    switch ($this->body['type']) {
      case 'deposit':
        
        $this->handleDeposit();

        break;

      case 'withdraw':
        
        $this->handleWithdraw();

        break;
      
      case 'transfer':
        
        $this->handleTransfer();

        break;
    }

  }

  public function handleDeposit() 
  {
    $account = [];
    $accountKey = $this->body['destination'];
    $response = [];

    if(isset($this->file[$accountKey])) {
      
      $this->file[$accountKey]['destination']['balance'] = $this->file[$accountKey]['destination']['balance'] + $this->body['amount'];

      $response['destination'] = $this->file[$accountKey]['destination'];

    } else {
      $account = [
        'destination' => [
          'id' => $accountKey,
          'balance' => $this->body['amount']
        ]
      ];

      $this->file[$accountKey] = $account;
      $response['destination'] = $account['destination'];

    }

    file_put_contents(dirname(__DIR__).'/Data/file.json',json_encode($this->file));

    header("HTTP/1.1 201 Created");
    echo json_encode($response);
    
  }

  public function handleWithdraw()
  {
    $accountKey = $this->body['origin'];
    $response = [];

    if(!isset($this->file[$accountKey])) {
      header("HTTP/1.1 404 Not Found");
      echo json_encode(0);
    } else {
      
      $this->file[$accountKey]['destination']['balance'] = $this->file[$accountKey]['destination']['balance'] - $this->body['amount'];

      $response['origin'] = $this->file[$accountKey]['destination'];

      file_put_contents(dirname(__DIR__).'/Data/file.json',json_encode($this->file));

      header("HTTP/1.1 201 Created");
      echo json_encode($response);
    }

  }

  public function handleTransfer()
  {
    $accountKey = $this->body['origin'];
    $response = [];

    if(!isset($this->file[$accountKey])) {
      header("HTTP/1.1 404 Not Found");
      echo json_encode(0);
    } else {
      
      $this->file[$accountKey]['destination']['balance'] = $this->file[$accountKey]['destination']['balance'] - $this->body['amount'];

      $response['origin'] = $this->file[$accountKey]['destination'];
      $response['destination'] = [
        'id' => $this->body['destination'],
        'balance' => $this->body['amount']
      ];

      $this->file[$accountKey]['historyTransfer'] = $response;
      
      file_put_contents(dirname(__DIR__).'/Data/file.json',json_encode($this->file));

      header("HTTP/1.1 201 Created");
      echo json_encode($response);
    }
  }

}