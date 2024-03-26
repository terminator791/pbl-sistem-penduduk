<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class wargaPendatangController extends Controller
{
    // Create
    public function Create()
    {
        return view('dataWarga.wargaPendatang.create');
    }

    // Read
    public function index()
    {
        return view('dataWarga.wargaPendatang.index');
    }

    // Update
    public function update()
    {
        return view('dataWarga.wargaPendatang.update');
    }

    // Delete
    public function delete()
    {
        return view('dataWarga.wargaPendatang.index');
    }
}
