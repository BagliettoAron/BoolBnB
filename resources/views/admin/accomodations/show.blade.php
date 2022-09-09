@extends('layouts.dashboard')

@section('content')
    <div id="show-style" class="row justify-content-center">
        <div class="picture col-12 col-md-12 col-lg-6">
            <h3 class="mb-3">{{ $this_accomodation->title }}</h3>
            @if ($this_accomodation->picture)
                <img class="mb-3" src="{{ asset('storage/' . $this_accomodation->picture) }}" alt="">
            @endif
            <div class="vote">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fa-solid fa-star-half-stroke"></i>
            </div>
        </div>
        <div class="description col-12 col-md-12 col-lg-6">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <h4>Address: {{ $this_accomodation->address }}</h4>
            <p>Number of rooms: {{ $this_accomodation->number_of_rooms }}</p>
            <p>Number of beds: {{ $this_accomodation->number_of_beds }}</p>
            <p>Number of bathrooms: {{ $this_accomodation->number_of_bathrooms }}</p>
            @if ($this_accomodation->square_meters)
                <p>Square meters: {{ $this_accomodation->square_meters }}</p>
            @endif
            <p>Services:
                @forelse ($this_accomodation->services as $service)
                    {{ $service->name }}{{ $loop->last ? '' : ', ' }}
                @empty
                    nessuno
                @endforelse
            </p>
            <p>
                @if ($this_accomodation->visible)
                    Visibile
                @else
                    Non visibile
                @endif
            <h5>Price per night: €{{ $this_accomodation->price_per_night }}</h5>
            <div class="d-flex show-button py-4">
                <a class="btn btn-primary mr-3"
                    href="{{ route('admin.accomodations.edit', ['accomodation' => $this_accomodation->id]) }}">Modify</a>
                <form action="{{ route('admin.accomodations.destroy', ['accomodation' => $this_accomodation->id]) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure to delete this accomodation?')">Delete</button>
                </form>
            </div>
            <!-- Maps div-->
            <div id="map-div" class="h-75 w-75"></div>
        </div>
    </div>
@endsection
