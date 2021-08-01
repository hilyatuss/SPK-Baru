<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function show()
    {
        $data['title'] = 'Home';
        $data['periode'] = DB::table('tb_periode')->get();
        return view('home', $data);
    }
}
