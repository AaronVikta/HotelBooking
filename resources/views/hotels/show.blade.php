@extends('layouts.app')
@section('content')
<div class="container">
  <div class="">
      <h1 class="text-center" style="text-transform:capitalize;">{{$hotel->name}}</h1>
      <h3 class="text-center">Rooms</h3>
      <div class="row">
        <div class="col-md-3">
          Room One
          <room-listing></room-listing>
        </div>
      </div>
  </div>
</div>
@endsection
