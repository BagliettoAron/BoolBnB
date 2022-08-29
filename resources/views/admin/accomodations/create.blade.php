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
    
        <form action="" method="POST">
            @method('POST')
            @csrf 
    
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="picture">Picture</label>
                <input type="text" class="form-control" name="picture" id="picture" value="{{ old('picture') }}">
            </div>
            {{-- <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}">
            </div> --}}
            <div class="form-group" id="address">
                <label>Address</label>
            </div>
            <div class="form-group">
                <label for="number_of_rooms">Number of rooms</label>
                <input type="number" class="form-control" name="number_of_rooms" id="number_of_rooms" value="{{ old('number_of_rooms') }}">
            </div>
            <div class="form-group">
                <label for="number_of_beds">Number of beds</label>
                <input type="number" class="form-control" name="number_of_beds" id="number_of_beds" value="{{ old('number_of_beds') }}">
            </div>
            <div class="form-group">
                <label for="number_of_bathrooms">Number of bathrooms</label>
                <input type="number" class="form-control" name="number_of_bathrooms" id="number_of_bathrooms" value="{{ old('number_of_bathrooms') }}">
            </div>
            <div class="form-group">
                <label for="square_meters">Square meters</label>
                <input type="number" class="form-control" name="square_meters" id="square_meters" value="{{ old('square_meters') }}">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}">
            </div>

        </form>
    </div>

     {{-- tom tom services --}}
     <script>
        var options = {
            searchOptions: {
                key: 'xrJRsnZQoM2oSWGgQpYwSuOSjIRcJOH7',
                language: 'en-GB',
                limit: 5
            },
            autocompleteOptions: {
                key: 'xrJRsnZQoM2oSWGgQpYwSuOSjIRcJOH7',
                language: 'en-GB'
            }
        };
        var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
        var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
        document.getElementById('address').append(searchBoxHTML);
    </script>
  
    
@endsection