@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-md-6 offset-md-3">
      <h2 class="text-center">Room Manager</h2>
      <form action="api/rooms" method="post" enctype="multipart/form-data">
        <select class="form-control mb-2 mt-1 no-borders" id="room_type" name="room_type">
          <option value="">Choose Room Type</option>
          @foreach($types as $type)
          <option value="{{$type->type}}" >{{$type->type}}</option>
          @endforeach
        </select>
        <input type="file" name="image" value="" class="form-control no-borders">
        <input type="submit" name="button" value="Add Room" class=" no-borders btn btn-outline-success mt-2 form-control">
      </form>
    </div>

    <div class="col-md-10 offset-md-1">
      <created-room>
      </created-room>
    </div>
  </div>
@endsection
