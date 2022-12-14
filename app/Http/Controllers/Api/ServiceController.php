<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request) {
        $services = Service::all();
        return response()->json($services);
    }
}
