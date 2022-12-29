<?php

namespace Src\Controllers;

use Data as Src;

class EventController 
{

  private $body;
  private $file;

  public function __construct()
  {

    $this->body = json_decode(file_get_contents('php://input'),true);

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
    $this->file = json_decode(file_get_contents(dirname(__DIR__).'/Data/file.json'),true);
    $destination = [];

    if(isset($this->file['destination'])) {
      $this->file['destination']['id'] == $this->body['destination'] ? (
        $this->file['destination']['balance'] = $this->body['amount']
      ) : ('');
    } else {
      $this->file = [
        'destination' => [
          'id' => $this->body['destination'],
          'balance' => $this->body['amount']
        ]
      ];
    }

    $destination['destination'] = $this->file['destination'];

    file_put_contents(dirname(__DIR__).'/Data/file.json',json_encode($this->file));

    header("HTTP/1.1 201 Created");
    echo json_encode($destination);

  }

  public function handleWithdraw()
  {
    echo 'withdraw';
  }

  public function handleTransfer()
  {
    echo 'transfer';
  }

}