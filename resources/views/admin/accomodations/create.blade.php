@extends('layouts.dashboard')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="pb-4">Add new accomodation</h2>

        <form action="{{ route('admin.accomodations.store') }}" method="POST">
            @method('POST')
            @csrf

            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" class="form-control" name="title" id="title" required value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="picture">Picture *</label>
                <input type="text" class="form-control" name="picture" id="picture" required
                    value="{{ old('picture') }}">
            </div>

            {{-- address --}}
            <div class="form-group" required>
                <label>Address *</label>
                <input type="text" class="form-control" name="address" id="address" onkeyup="searchAddress()" required
                    value="{{ old('address') }}">
                    <div id="autocomplete" class="mt-2" >

                    </div>
            </div>

            <div class="form-group">
                <label for="number_of_rooms">Number of rooms *</label>
                <input type="number" class="form-control" name="number_of_rooms" required min="1" max="255"
                    id="number_of_rooms" value="{{ old('number_of_rooms') }}">
            </div>
            <div class="form-group">
                <label for="number_of_beds">Number of beds *</label>
                <input type="number" class="form-control" name="number_of_beds" required min="1" max="255"
                    id="number_of_beds" value="{{ old('number_of_beds') }}">
            </div>
            <div class="form-group">
                <label for="number_of_bathrooms">Number of bathrooms *</label>
                <input type="number" class="form-control" name="number_of_bathrooms" required min="0" max="255"
                    id="number_of_bathrooms" value="{{ old('number_of_bathrooms') }}">
            </div>
            <div class="form-group">
                <label for="square_meters">Square meters</label>
                <input type="number" class="form-control" name="square_meters" required min="20" id="square_meters"
                    value="{{ old('square_meters') }}">
            </div>
            <div class="form-group">
                <label for="price_per_night">Price *</label>
                <input type="number" class="form-control" name="price_per_night" required id="price_per_night"
                    min="10" value="{{ old('price_per_night') }}">
            </div>

            <div class="services">
                <label>Services</label>
                @foreach ($services as $service)
                    <div class="form-check">
                        <input class="form-check-input" name="services[]" type="checkbox" value="{{ $service->id }}"
                            id="service-{{ $service->id }}"
                            {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="service-{{ $service->id }}">
                            {{ $service->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="visibility">
                <label>Visibility *</label>
                <input type="radio" required id="visible" name="visible" value="1">
                <label for="visible">visible</label>
                <input type="radio" name="visible" id="not-visible" value="0">
                <label for="not-visible">not visible</label>
            </div>

            <div class="form-group py-3">
                <label for="price_per_night">Required *</label>
            </div>

            <button type="submit" class="btn btn-primary">Create accomodation</button>
        </form>
    </div>

    <script>
        function searchAddress() {
            window.axios.defaults.headers.common = {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            };
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
                    divElement.setAttribute('onclick', 'selectedResult()');
                    document.getElementById('autocomplete').append(divElement);
                });
            })
        }

        function selectedResult() {
            console.log('test');
        }
    </script>



@endsection
