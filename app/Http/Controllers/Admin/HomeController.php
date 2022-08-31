<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        
        $logged_user = Auth::user();
        return view ('admin.accomodations.index', compact('logged_user'));
    }

}
