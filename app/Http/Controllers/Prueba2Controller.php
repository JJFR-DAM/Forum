<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Creado con la siguiente línea de código: php artisan make:controller 'nombreControlador' --resource

class Prueba2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'Estoy en el index.';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'Estoy en el create';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'Estoy en el show';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return 'Estoy en el edit.';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
