@extends('layouts.dashboard')

@section('content')
    
    <h2>{{ $this_accomodation->title }}</h2>
    <img src="{{ $this_accomodation->picture }}" alt="">
    <h4>{{ $this_accomodation->address }}</h4>
    <p>{{ $this_accomodation->price_per_night }}</p>

    <a class="btn btn-primary" href="{{ route('admin.accomodations.edit', ['accomodation' => $this_accomodation->id]) }}">Modify</a>
@endsection