@extends('layouts.dashboard')

@section('content')
    <h2 class="mb-3">Hi {{$logged_user->name}} {{$logged_user->last_name}}! These are your accomodations</h2>
    <div class="row row-cols-3">

        @forelse ($logged_user->accomodation as $accomodation)
            <div class="col">

                <div class="card mb-3" style="width: 18rem;">
                    <img class="card-img-top" src="{{ $accomodation->picture }}" alt="Card image cap">
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
@endsection
