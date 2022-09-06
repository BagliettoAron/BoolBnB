@extends('layouts.dashboard')

@section('content')
    <div class="container" id="edit-accomodations">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="pb-4" id="title-edit">Edit this accomodation</h2>

        <form action="{{ route('admin.accomodations.update', ['accomodation' => $accomodation->id]) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="title" id="label-edit">Title *</label>
                <input type="text" class="form-control" name="title" id="title" required
                    value="{{ old('title') ? old('title') : $accomodation->title }}">
            </div>

            <div class="form-group">
                <label for="picture" id="label-edit">Picture *</label>
                <input type="text" class="form-control" name="picture" id="picture" required
                    value="{{ old('picture') ? old('picture') : $accomodation->picture }}">
            </div>

            <div class="form-group" required>
                <label id="label-edit">Address *</label>
                <input type="text" class="form-control" name="address" id="address" onkeyup="searchAddress()" required
                    value="{{ old('address') ? old('address') : $accomodation->address }}">
                <div id="suggestions-container" class="mt-2"></div>
                <input type="text" class="form-control d-none" name="lat" id="lat" required
                    value="{{ old('lat') ? old('lat') : $accomodation->lat }}">

                <input type="text" class="form-control d-none" name="lon" id="lon" required
                    value="{{ old('lon') ? old('lon') : $accomodation->lon }}">

            </div>

            <div class="form-group">
                <label for="number_of_rooms" id="label-edit">Number of rooms *</label>
                <input type="number" class="form-control" name="number_of_rooms" required min="1" max="255"
                    id="number_of_rooms"
                    value="{{ old('number_of_rooms') ? old('number_of_rooms') : $accomodation->number_of_rooms }}">
            </div>

            <div class="form-group">
                <label for="number_of_beds" id="label-edit">Number of beds *</label>
                <input type="number" class="form-control" name="number_of_beds" required min="1" max="255"
                    id="number_of_beds"
                    value="{{ old('number_of_beds') ? old('number_of_beds') : $accomodation->number_of_beds }}">
            </div>

            <div class="form-group">
                <label for="number_of_bathrooms" id="label-edit">Number of bathrooms *</label>
                <input type="number" class="form-control" name="number_of_bathrooms" required min="0" max="255"
                    id="number_of_bathrooms"
                    value="{{ old('number_of_bathrooms') ? old('number_of_bathrooms') : $accomodation->number_of_bathrooms }}">
            </div>

            <div class="form-group">
                <label for="square_meters" id="label-edit">Square meters</label>
                <input type="number" class="form-control" name="square_meters" required min="20" id="square_meters"
                    value="{{ old('square_meters') ? old('square_meters') : $accomodation->square_meters }}">
            </div>

            <div class="form-group">
                <label for="price_per_night" id="label-edit">Price *</label>
                <input type="number" class="form-control" name="price_per_night" required id="price_per_night"
                    min="10"
                    value="{{ old('price_per_night') ? old('price_per_night') : $accomodation->price_per_night }}">
            </div>

            <div class="services">
                <label id="label-edit">Services</label>
                @foreach ($services as $service)
                    <div class="form-check">
                        <input class="form-check-input" name="services[]" type="checkbox" value="{{ $service->id }}"
                            id="service-{{ $service->id }}"
                            {{ $accomodation->services->contains($service) || in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="service-{{ $service->id }}">
                            {{ $service->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="visibility">
                <label>Visibility</label>
                <input type="hidden" id="visible"  name="visible" value="0">
                <input type="checkbox" id="visible" name="visible" value="1"  {{ $accomodation->visible  ?  'checked'  : '' }}>
                <label for="visible">visible</label>
            </div>

            <div class="form-group py-3">
                <label for="price_per_night" id="label-edit">Required *</label>
            </div>

            <button type="submit" class="btn btn-primary" id="btn-edit">Save changes</button>
        </form>
    </div>

    <script>
        function searchAddress() {
            window.axios.defaults.headers.common = {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            };
            const resultsContainer = document.getElementById('suggestions-container');
            resultsContainer.innerHTML = '';
            const addressQuery = document.getElementById('address').value;
            const linkApi =
                `https://api.tomtom.com/search/2/search/${addressQuery}.json?key=xrJRsnZQoM2oSWGgQpYwSuOSjIRcJOH7`
            console.log(linkApi);
            axios.get(linkApi).then(resp => {
                const response = resp.data.results;
                response.forEach(element => {
                    const divElement = document.createElement('div');
                    divElement.classList.add('address-result');
                    divElement.innerHTML = element.address.freeformAddress;
                    document.getElementById('suggestions-container').append(divElement);
                    divElement.addEventListener('click', function() {
                        document.getElementById('address').value = element.address.freeformAddress;
                        document.getElementById('lat').value = element.position.lat;
                        document.getElementById('lon').value = element.position.lon;
                        resultsContainer.innerHTML = '';
                    });
                });
            })
        }
    </script>
@endsection
