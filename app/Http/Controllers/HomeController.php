<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $surveys = Survey::all();
        return inertia('Home/Index', compact('surveys'));
    }
}
