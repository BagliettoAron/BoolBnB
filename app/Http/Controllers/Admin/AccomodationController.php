<?php

namespace App\Http\Controllers\Admin;

use App\Accomodation;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccomodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logged_user = Auth::user();
        return view('admin.accomodations.index', compact('logged_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.accomodations.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // dd($request->all());
        $request->validate($this->getValidationRules());
        $data = $request->all();

        $accomodation = new Accomodation();

        // test
        // $accomodation->address = 'indirizzo test';
        // $accomodation->lat = '15';
        // $accomodation->lon = '16';
        // test

        $data['user_id'] = Auth::user()->id;

        $accomodation->fill($data);
        $accomodation->save();

        return redirect()->route('admin.accomodations.show', ['accomodation' => $accomodation->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logged_user_id = Auth::user()->id;
        $this_accomodation = Accomodation::findOrFail($id);

        if ($logged_user_id === $this_accomodation->user_id) {
            return view('admin.accomodations.show', compact('this_accomodation'));
        } else {
            return view('admin.accomodations.error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // test

    private function getValidationRules()
    {
        return [
            'title' => 'required',
            'picture' => 'required',
            'number_of_rooms' => 'required|integer|min:1|max:255',
            'number_of_beds' => 'required|integer|min:1|max:255',
            'number_of_bathrooms' => 'required|integer|min:0|max:255',
            'square_meters' => 'required|integer|min:20',
            'price_per_night' => 'required|integer|min:10',
            'visible' => 'required|boolean'
        ];
    }
}
