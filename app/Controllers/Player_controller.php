<?php

namespace App\Controllers;

class Player_controller extends BaseController
{
    public function index(): string
    {
        
        return view('players/index');
    }
}
