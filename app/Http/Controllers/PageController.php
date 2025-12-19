<?php
// app/Http/Controllers/PageController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function transactions()
    {
        return view('transactions');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
