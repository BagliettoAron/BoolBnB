@extends('layouts.dashboard')

@section('content')
    
    <h2>{{ $this_accomodation->title }}</h2>
    <img src="{{ $this_accomodation->picture }}" alt="">
    <h4>{{ $this_accomodation->address }}</h4>
    <p>{{ $this_accomodation->price_per_night }}</p>


@endsection