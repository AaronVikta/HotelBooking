<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\User;
use App\Http\Resources\BookingResource;
use Auth;

class BookingController extends Controller
{
  // public function __construct(){
  //   $this->middleware('auth');
  // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return BookingResource::collection(Booking::all());
    }

    public function mine($id){
      $me = User::findOrFail($id);
      $email=$me['email'];
      // dd($email);
      $booking = Booking::where('customer_email',$email)->get();

      // dd($booking);
      return response()->json($booking);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //redirects to the create view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //validate data
      $this->validate($request,[
        'room_id'=>'required',
        'total_nights'=>'required',
        'customer_email'=>'required',
        'customer_name'=>'required',
        'total_price'=>'required',
        'end_date'=>'required',
        'start_date'=>'required'
      ]);
        // store them in the database
        $booking =new Booking;
        $booking->room_id=$request->room_id;
        $booking->total_price=$request->total_price;
        $booking->customer_name=$request->customer_name;
        $booking->customer_email=$request->customer_email;
        $booking->total_nights=$request->total_nights;
        $booking->start_date= $request->start_date;
        $booking->end_date= $request->end_date;
        $booking->save();
        return $booking;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return new BookingResource(Booking::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //get a hotel using the $id
        $booking= Booking::findOrFail($id);
        $booking->update($request->all());
        return $booking;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Booking::find($id)->delete();

        return 204;
    }
}
