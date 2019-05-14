<?php

namespace App\Http\Controllers;

use App\Http\Response;

class HomeController
{
    public static function index()
    {
      /**
       * Basic controller method implementation
       * 
       * Returns a content
       */
        return Response::view('index');
    }
    
}
