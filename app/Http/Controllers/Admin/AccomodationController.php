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
        // $accomodations = Accomodation::all();
        // dd($accomodations);
        // $user_accomodations = Accomodation::all()->where('id', Auth::user()->id);
        // if($accomodations->id === $logged_user->id) {
            // }
            return view('admin.accomodations.index', compact('logged_user'));
        // dd($user_accomodations->id);
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
        $this_accomodation = Accomodation::findOrFail($id);
        return view('admin.accomodations.show', compact('this_accomodation'));
        
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

    private function getValidationRules() {
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
