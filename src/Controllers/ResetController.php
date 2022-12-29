<?php 

namespace Src\Controllers;

use stdClass;

class ResetController 
{

  public function __construct()
  {
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
      file_put_contents(dirname(__DIR__).'/Data/file.json',json_encode(new stdClass));
      header("HTTP/1.1 200 OK");
    } else {
      header("HTTP/1.1 501 Not Implemented");
    }

  }

}
