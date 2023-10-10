<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function index($name = 'Juan') {
        return 'Hola '.$name . ', estoy en la función index de PruebaController.';
    }
}
