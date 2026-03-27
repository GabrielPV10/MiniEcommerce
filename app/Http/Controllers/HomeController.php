<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function quienesSomos()
    {
        return view('home.quienes_somos');
    }

    public function contacto()
    {
        return view('home.contacto');
    }

    public function mision()
    {
        return view('home.mision');
    }

    public function ubicacion()
    {
        return view('home.ubicacion');
    }
}