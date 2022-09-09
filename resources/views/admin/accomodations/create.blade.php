@extends('layouts.dashboard')

@section('content')
    <div class="container" id="create-style">
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

        <form action="{{ route('admin.accomodations.store') }}" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf

            <div class="form-group">
                <label for="title">Title *</label>
                <input type="text" class="form-control" name="title" id="title" required
                    value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="picture">Picture *</label>
                <input type="file" required value="{{ old('picture') }}" name="picture" id="picture">
            </div>

            <div class="form-group" required>
                <label>Address *</label>
                <input type="text" class="form-control" name="address" id="address" onkeyup="searchAddress()" required
                    value="{{ old('address') }}">
                <ul id="suggestions-container" class="list-group mt-2 position-absolute"></ul>
                <input type="text" class="form-control d-none" name="lat" id="lat" required
                    value="{{ old('lat') }}">

                <input type="text" class="form-control d-none" name="lon" id="lon" required
                    value="{{ old('lon') }}">

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
                <label for="square_meters">Square meters *</label>
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

            <div class="visibility mt-4">
                <label>Visibility</label>
                <input type="hidden" id="visible" name="visible" value="0">
                <input type="checkbox" id="visible" name="visible" value="1">
                <label for="visible">visible</label>
            </div>

            <div class="form-group py-3">
                <label for="price_per_night">Required *</label>
            </div>

            <button type="submit" class="btn btn-primary">Create accomodation</button>
        </form>
    </div>

    <script>
        function searchAddress() {
            const resultsContainer = document.getElementById("suggestions-container");
            // window.axios.defaults.headers.common = {
            //     'Accept': 'application/json',
            //     'Content-Type': 'application/json',
            // };
            const addressQuery = document.getElementById("address").value;

            if (addressQuery.length > 1) {
                const linkApi =
                    `https://api.tomtom.com/search/2/search/${addressQuery}.json?key=xrJRsnZQoM2oSWGgQpYwSuOSjIRcJOH7`
                axios.get(linkApi).then(resp => {
                    this.collectAddress(resp);

                })
            } else {
                resultsContainer.innerHTML = "";
            }
        }

        function collectAddress(addressData) {
            const resultsContainer = document.getElementById("suggestions-container");
            resultsContainer.innerHTML = "";
            const response = addressData.data.results;
            response.forEach(element => {
                const listItem = document.createElement("li");
                listItem.classList.add("address-result", "border", "list-group-item");
                listItem.style.cursor = "pointer";
                listItem.innerHTML = element.address.freeformAddress;
                document.getElementById("suggestions-container").append(listItem);
                listItem.addEventListener("mouseover", () => {
                    listItem.classList.add("active");
                });
                listItem.addEventListener("mouseleave", () => {
                    listItem.classList.remove("active");
                });
                listItem.addEventListener("click", () => {
                    document.getElementById("address").value = element.address.freeformAddress;
                    document.getElementById("lat").value = element.position.lat;
                    document.getElementById("lon").value = element.position.lon;
                    resultsContainer.innerHTML = "";
                });
            });
        }        
    </script>
@endsection
