<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller
{
    public function index()
    {
        $logins = Login::all(); // Obtiene todos los registros de accesos
        return view('logins.index', compact('logins'));
    }
}
