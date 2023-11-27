<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session('logged_in') == true &&  session()->get('role') == 1) {
            return view('admin/dashboard');
        }else if(session('logged_in') == true &&  session()->get('role') == 2){
            return view('user/dashboard');
        }else{
            return view('login');
        }
        
    }
}
