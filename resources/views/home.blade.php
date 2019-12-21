@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              @if((Auth::user()->type)=='admin')
                <div class="card-header"><h2 class="text-center">Admin Dashboard</h2></div>
                @else
                <div class="card-header">Welcome Dear valued Customer</div>
                <p class="text-center">Dear {{Auth::user()->name}}, Welcome to your profile</p>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    @if((Auth::user()->type)=='admin')
                    <p class="text-center">Dear Admin {{Auth::user()->name}}, Welcome to your profile</p>
                    <created-room>
                    </created-room>
                    <a type="button" href="/createroom" class="float-right btn btn-outline-primary btn-sm"
                    name="button">Add Room</a>
                    <created-type>
                    </created-type>
                    @endif
                      @if((Auth::user()->type)=='admin')
                    <a type="button" href="/createtype" class="float-right btn btn-outline-primary btn-sm"
                    name="button">Add Type</a>
                    <a type="button" href="/createprice" class="float-left btn btn-outline-primary btn-sm"
                    name="button">Set New Prices</a>
                    <booked-component>
                    </booked-component>
                    @else
                    <my-booking-component>
                    </my-booking-component>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
