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

    public function show($id) {
        // Nel with vanno gli attributi delle tabelle collegate che ci interessano. Vedi il model per controllare che siano al singolare o al plurale (anche a logica).
        $accomodation = Accomodation::where('id', '=', $id)->first();
        if ($accomodation->picture) {
            $accomodation->picture = url('storage/' . $accomodation->picture);
        }

        if($accomodation) {
            return response()->json([
                'success' => true,
                'results' => $accomodation
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => 'Accomodation not found'
            ]);
        }
    }

    public function search(Request $request)
    {
        $centerLat = $request->lat;
        $centerLon = $request->lon;
        $radius = $request->searchRadius;
        $nbrOfRooms = $request->nbrOfRooms;
        $nbrOfBeds = $request->nbrOfBeds;
        $checkedServices = $request->selectedServices;
        // dd($checkedServices);

        if (!$nbrOfRooms) {
            $nbrOfRooms = 1;
        }

        if (!$nbrOfBeds) {
            $nbrOfBeds = 1;
        }

        // Accomodations filtered for number of rooms and beds
        $accomodations = Accomodation::where([['number_of_rooms', '>=', $nbrOfRooms], ['number_of_Beds', '>=', $nbrOfBeds]])->get();

        // Accomodations in the requested radius
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

        // $filteredAccomodation = $nearAccomodations;

        // if ($checkedServices) {
        //     foreach ($nearAccomodations as $index => $accomodation) {
        //         foreach ($accomodation->services as $service) {
        //             if (in_array($service->id, $checkedServices)) {
        //                 // dd('ok');
        //                 unset($filteredAccomodation[$accomodation->id]);
        //             }
        //         }
        //     }
        //     return response()->json([
        //         'success' => true,
        //         'accomodationsInRadius' => $filteredAccomodation
        //     ]);
        // }

        return response()->json([
            'success' => true,
            'accomodationsInRadius' => $nearAccomodations
        ]);
    }
}
