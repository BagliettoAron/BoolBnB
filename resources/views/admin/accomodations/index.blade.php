@extends('layouts.dashboard')

@section('content')
    <h2>lista delle tue accomodations</h2>

    <div class="row row-cols-3">
        @foreach ($loggedUser->accomodation as $accomodation)
            <div class="col">

                <div class="card mb-3" style="width: 18rem;">
                    <img class="card-img-top" src="{{ $accomodation->picture }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $accomodation->title }}</h5>
                        <p class="card-text">{{  $accomodation->address }}</p>
                        <a href="#" class="btn btn-primary">Show accomodation</a>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
@endsection
