@extends('layouts.app')
@section('content')
  <div class="container-fluid">
    <div class="col-md-12">
      <h2 class="text-center mt-2"> Room 00{{$room->id}}</h2>
      <div class="row">
        <div class="col-md-6">
        <img src="{{$room->image}}" alt="" class="mb-2" width="100%" style="max-height:400px;">
        <p style="text-transform:capitalize;">Room Type: {{$type}}</p>
        <p>${{$price}}</p>
        </div>
        <div class="col-md-6">
          <div class="col-md-12">
            <h4 class="text-center">Make Your Booking</h4>
            <div class="col-md-10 offset-md-1 mb-1 mt-2">
              <form action="{{route('book')}}" method="post">
              <div class="form-group row">

                <label for="inputEmail3" class="col-sm-2 col-form-label">Selected Room:</label>
                <div class="col-sm-10">
                  <input type="text" name="" disabled value="{{$room->room_name}}" class="form-control">
                </div>
              </div>
              <input type="hidden"name="" value="{{$room->room_name}}" class="form-control">
              <input type="hidden" name="price" value="{{$price}}" class="form-control">
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Price Per Night</label>
                <div class="col-sm-10">
                  <input type="number" disabled name="" value="{{$price}}" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Customer Email</label>
                <div class="col-sm-10">
                  <input type="text" name="" value="{{Auth::user()->email}}" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Customer Name</label>
                <div class="col-sm-10">
                  <input type="text" name="fullname" value="{{Auth::user()->name}}" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Start Date</label>
                <div class="col-sm-10">
                  <input type="date" name="start" value="" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">End Date</label>
                <div class="col-sm-10">
                  <input type="date" name="end" value="" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-10 offset-md-2">
                  <button type="submit" class="btn btn-primary form-control no-borders">Complete Booking</button>
                </div>
              </div>
            </form>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
