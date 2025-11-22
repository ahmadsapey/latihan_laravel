<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('landing.index', [
            'user' => $user
        ]);
    }
}

