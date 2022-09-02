<?php

namespace App\Http\Controllers\Api;

use App\Accomodation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccomodationController extends Controller
{
    public function index(Request $request) {
        $accomodations = Accomodation::paginate($request->accomodations_per_page);
        return response()->json([
            'success' => true,
            'results' => $accomodations
        ]);
    }


}
