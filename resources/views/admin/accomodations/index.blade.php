@extends('layouts.dashboard')

@section('content')
    <div id="index-style">
        <h2 class="mb-3">Hi {{$logged_user->name}} {{$logged_user->last_name}}! These are your accomodations</h2>


        <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2">
    
            @forelse ($logged_user->accomodation as $accomodation)
                <div class="col d-flex justify-content-center">
    
                    <div class="card mb-5 w-85">
                        <img class="card-img-top" src="{{ asset('storage/' . $accomodation->picture) }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $accomodation->title }}</h5>
                            <p class="card-text">{{ $accomodation->address }}</p>
                            <a href="{{ route('admin.accomodations.show', ['accomodation' => $accomodation->id]) }}" class="btn btn-primary">Show accomodation</a>
                        </div>
                    </div>
    
                </div>
            @empty
                <div class="col">
    
                    <a class="btn btn-primary" href="{{route('admin.accomodations.create')}}">Add a new accomodation</a>
                </div>
            @endforelse
        </div>
    </div>
@endsection
