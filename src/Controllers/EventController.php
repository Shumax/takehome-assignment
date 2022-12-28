<?php

namespace Src\Controllers;

class EventController {

  public function __construct()
  {

    $post = json_decode(file_get_contents('php://input'),true);

    echo json_encode($post);
  }

}