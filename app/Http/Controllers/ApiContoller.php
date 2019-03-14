<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ApiContoller extends Controller
{
        use ApiResponser;

public function __construct()

{
  $this->middleware('auth:api');

}

}
