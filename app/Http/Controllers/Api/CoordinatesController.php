<?php

namespace App\Http\Controllers\Api;

use App\Accomodation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoordinatesController extends Controller
{
    public function checkDistance(Request $request) {
        $data = $request->all();
        // dd($data["lat"]);
        $accomodations = Accomodation::all();
        $lat1 = $data["lat"];
        $lon1 = $data["lon"];
        $distance = 0;

        function degreesToRadians($degrees) {
            return $degrees * pi() / 180;
        }
          
        function distanceBetweenCoordinates($lat1, $lon1, $lat2, $lon2) {
            $earthRadiusKm = 6371;
          
            $dLat = degreesToRadians($lat2-$lat1);
            $dLon = degreesToRadians($lon2-$lon1);
          
            $lat1 = degreesToRadians($lat1);
            $lat2 = degreesToRadians($lat2);
          
            $a = sin($dLat/2) * sin($dLat/2) +
                    sin($dLon/2) * sin($dLon/2) * cos($lat1) * cos($lat2); 
            $c = 2 * atan2(sqrt($a), sqrt(1-$a)); 
            return $earthRadiusKm * $c;
        }              

        foreach ($accomodations as $accomodation) {
            $lat2 = $accomodation->lat;
            $lon2 = $accomodation->lon;
            $this->$distance = distanceBetweenCoordinates($this->lat1, $this->lon1, $lat2, $lon2);
            dd($this->$distance);
        }

        return response()->json([
            'success' => true,
            'distance' => 50
        ]);
    }
}
