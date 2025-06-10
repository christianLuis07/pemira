<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BelumVotingController extends Controller
{
    public function index(){
        return view("admin.belum-voting");
    }
}
