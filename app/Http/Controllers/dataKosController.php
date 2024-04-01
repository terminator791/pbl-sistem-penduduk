<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dataKosController extends Controller
{
    // Create
    public function Create()
    {
        return view('dataKos.create');
    }

    // Read
    public function index()
    {
        return view('dataKos.index');
    }

    // Update
    public function update()
    {
        return view('dataKos.update');
    }

    // Delete
    public function delete()
    {
        return view('dataKos.index');
    }
}
