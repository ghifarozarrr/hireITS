<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
      return view('users.profile');
    }

    public function test(){
      return $_POST["user-desc"];
    }
}
