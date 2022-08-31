@extends('layouts.dashboard')

@section('content')
    
    <h2>{{ $this_accomodation->title }}</h2>
    <img src="{{ $this_accomodation->picture }}" alt="">
    <h4>Address: {{ $this_accomodation->address }}</h4>
    <p>Number of rooms: {{ $this_accomodation->number_of_rooms }}</p>
    <p>Number of beds: {{ $this_accomodation->number_of_beds }}</p>
    <p>Number of bathrooms: {{ $this_accomodation->number_of_bathrooms }}</p>
    <p>Square meters: {{ $this_accomodation->square_meters}}</p>
    <p>Services:
        @forelse ($this_accomodation->services as $service)
        {{ $service->name }}{{ $loop->last ? '' : ', ' }}
    @empty
        nessuno
    @endforelse
    </p>
    <h5>Price per night: €{{ $this_accomodation->price_per_night }}</h5>

    <div class="d-flex">
        <a class="btn btn-primary mr-3" href="{{ route('admin.accomodations.edit', ['accomodation' => $this_accomodation->id]) }}">Modify</a>
        <form action="{{ route('admin.accomodations.destroy', [ 'accomodation' => $this_accomodation->id ]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection