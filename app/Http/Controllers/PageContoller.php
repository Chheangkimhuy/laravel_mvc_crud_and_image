<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageContoller extends Controller
{
    //
    function viewpage(){
        return view('view-page');
    }
}
