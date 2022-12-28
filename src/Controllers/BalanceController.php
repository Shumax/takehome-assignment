<?php

namespace Src\Controllers;

class BalanceController {

  public function __construct()
  {
    echo json_encode($_GET);
  }

}