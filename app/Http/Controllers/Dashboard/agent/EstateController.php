<?php

namespace App\Http\Controllers\Dashboard\agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    public function index()
    {
        return view('agent.estaes.index');
    }

    public function create()
    {
        return view('agent.estaes.create');
    }
}
