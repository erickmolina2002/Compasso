<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return [
            'user' => $request->user(),
            'data' => [
                'name' => $request->user()->name,
                'email' => $request->user()->email,
            ],
        ];
    }
}
