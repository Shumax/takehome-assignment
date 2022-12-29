<?php

namespace Src\Controllers;

class BalanceController {

  private $account_id;
  private $file;


  public function __construct()
  {
    $this->account_id = $_GET['account_id'];
    $this->file = json_decode(file_get_contents(dirname(__DIR__).'/Data/file.json'),true);
    
    $this->findOne();
  }

  public function findOne()
  {

    if(!isset($this->file[$this->account_id])) {
      header("HTTP/1.1 404 Not Found");
      echo json_encode(0);
    } else {
      header("HTTP/1.1 200 OK");
      echo json_encode($this->file[$this->account_id]['destination']['balance']);
    }

  }

}