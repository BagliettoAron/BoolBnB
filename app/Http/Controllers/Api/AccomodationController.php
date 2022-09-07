<?php

namespace App\Http\Controllers\Api;

use App\Accomodation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccomodationController extends Controller
{
    public function index(Request $request)
    {
        $accomodations = Accomodation::paginate($request->accomodations_per_page);
        return response()->json([
            'success' => true,
            'results' => $accomodations
        ]);
    }

    public function search(Request $request)
    {
        $centerLat = $request->lat;
        $centerLon = $request->lon;
        $radius = $request->searchRadius;
        $nbrOfRooms = $request->nbrOfRooms;
        $nbrOfBeds = $request->nbrOfBeds;
        $services = $request->selectedServices;

        if (!$nbrOfRooms) {
            $nbrOfRooms = 1;
        }

        if (!$nbrOfBeds) {
            $nbrOfBeds = 1;
        }

        $accomodations = Accomodation::where([['number_of_rooms', '>=', $nbrOfRooms], ['number_of_Beds', '>=', $nbrOfBeds]])->get();

        $nearAccomodations = [];

        function degreesToRadians($degrees)
        {
            return $degrees * pi() / 180;
        }

        function distanceBetweenCoordinates($centerLat, $centerLon, $lat2, $lon2)
        {
            $earthRadiusKm = 6371;

            $dLat = degreesToRadians($lat2 - $centerLat);
            $dLon = degreesToRadians($lon2 - $centerLon);

            $centerLat = degreesToRadians($centerLat);
            $lat2 = degreesToRadians($lat2);

            $a = sin($dLat / 2) * sin($dLat / 2) +
                sin($dLon / 2) * sin($dLon / 2) * cos($centerLat) * cos($lat2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            return $earthRadiusKm * $c;
        }

        foreach ($accomodations as $accomodation) {
            $lat2 = $accomodation->lat;
            $lon2 = $accomodation->lon;
            $distance = distanceBetweenCoordinates($centerLat, $centerLon, $lat2, $lon2);
            if ($distance <= $radius) {
                $nearAccomodations[] = $accomodation;
            }
        }
        // dd($nearAccomodations);

        // if ($services) {
        //     foreach ($nearAccomodations as $accomodation) {
        //         foreach ($accomodation->services as $service) {
        //             // echo $service->id;
        //             // if (in_array($service, $services)) {
        //             //     echo 'ok';
        //             // }
        //             dd($services);
        //         }
        //     }
        // }

        return response()->json([
            'success' => true,
            'accomodationsInRadius' => $nearAccomodations
        ]);
    }
}
