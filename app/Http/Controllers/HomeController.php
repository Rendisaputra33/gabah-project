<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        if(validate()) {
            abort('401', 'login required');
        }

         return view('home');
    }

    public function viewChart()
    {
        return view('detail');
    }
    
}
