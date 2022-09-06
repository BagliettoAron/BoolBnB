@extends('layouts.dashboard')

@section('content')
<div id="show-style">
    <div class="picture">
        <h2 class="mb-3"><strong>{{ $this_accomodation->title }}</strong></h2>
        @if ($this_accomodation->picture)
            <img class="mb-3" src="{{ asset('storage/' . $this_accomodation->picture) }}" alt="">
        @endif
    </div>
    <div class="description">
        <h4>Address: {{ $this_accomodation->address }}</h4>
        <p>Number of rooms: {{ $this_accomodation->number_of_rooms }}</p>
        <p>Number of beds: {{ $this_accomodation->number_of_beds }}</p>
        <p>Number of bathrooms: {{ $this_accomodation->number_of_bathrooms }}</p>
        <p>Square meters: {{ $this_accomodation->square_meters }}</p>
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
            <form action="{{ route('admin.accomodations.destroy', ['accomodation' => $this_accomodation->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Are you sure to delete this accomodation?')">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
