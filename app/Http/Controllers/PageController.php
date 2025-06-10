<?php

namespace App\Http\Controllers;

use App\Models\Narahubung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{

    public function index()
    {
        return view('beranda');
    }

    public function organisasi()
    {
        return view('organisasi');
    }

    public function contact()
    {
        $narahubungs = Narahubung::get();

        return view('contact', [
            'narahubungs' => $narahubungs
        ]);
    }
}
