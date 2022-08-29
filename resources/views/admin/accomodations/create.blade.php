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
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}">
            </div>
        </form>
    </div>
  
    
@endsection