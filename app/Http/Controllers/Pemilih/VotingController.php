<?php

namespace App\Http\Controllers\Pemilih;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function index(){
        return view('pemilih.voting');
    }
}
