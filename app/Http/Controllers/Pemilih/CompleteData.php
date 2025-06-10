<?php

namespace App\Http\Controllers\Pemilih;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompleteData extends Controller
{
    public function index()
    {
        return view('pemilih.complete-data');
    }
}
