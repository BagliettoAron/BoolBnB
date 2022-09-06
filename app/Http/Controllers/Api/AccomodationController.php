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

    public function search(Request $request) {
        $data = $request->all();
        // dd($data);
        $centerLat = $data["lat"];
        $centerLon = $data["lon"];
        // dd($centerLon);
        $radius = $data["searchRadius"];
        $nbrOfRooms = $data["nbrOfRooms"];
        $nbrOfBeds = $data["nbrOfBeds"];
    
        $accomodations = Accomodation::all();
        // dd($accomodations);

        $distance = 0;

        $nearAccomodations = [];

        function degreesToRadians($degrees) {
            return $degrees * pi() / 180;
        }
          
        function distanceBetweenCoordinates($centerLat, $centerLon, $lat2, $lon2) {
            $earthRadiusKm = 6371;
          
            $dLat = degreesToRadians($lat2-$centerLat);
            $dLon = degreesToRadians($lon2-$centerLon);
          
            $centerLat = degreesToRadians($centerLat);
            $lat2 = degreesToRadians($lat2);
          
            $a = sin($dLat/2) * sin($dLat/2) +
                    sin($dLon/2) * sin($dLon/2) * cos($centerLat) * cos($lat2); 
            $c = 2 * atan2(sqrt($a), sqrt(1-$a)); 
            return $earthRadiusKm * $c;
        }              
        
        foreach ($accomodations as $accomodation) {
            $lat2 = $accomodation->lat;
            $lon2 = $accomodation->lon;
            $distance = distanceBetweenCoordinates($centerLat, $centerLon, $lat2, $lon2);
            if ($distance <= $radius) {
                // dd($distance);
                // dd($accomodation);
                // array_push($nearAccomodations, $accomodation);
                $nearAccomodations[] = $accomodation;
            }
        }
        // dd($nearAccomodations);


        // foreach ($accomodations as $accomodation) {
        //     if ($nbrOfRooms > 1) {
        //         if($accomodation->number_of_rooms >= $nbrOfRooms) {
        //             $nearAccomodations[] = $accomodation;
        //         }
        //         // foreach ($nearAccomodations as $accomodation) {
                    
        //             // }
        //         }
        //     }
        
        return response()->json([
            'success' => true,
            'accomodationsInRadius' => $nearAccomodations
        ]);
    }

    
}
