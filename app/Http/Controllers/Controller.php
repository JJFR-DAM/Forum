<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

//Para crear controladores usamos el comando php artisan make:controller 'nombre_Controller'

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
