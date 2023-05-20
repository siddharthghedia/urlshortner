<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class URLController extends Controller
{
    public function index() {
        return view('url-shortner.index');
    }
}
