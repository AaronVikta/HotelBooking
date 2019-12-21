<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Hotel;
use App\Http\Resources\HotelResource;
use View;
Use Auth;

class HotelController extends Controller
{
    public function __construct(){
      $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the hotels in DB
        return HotelResource::collection(Hotel::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if((Auth::user()->type)=='admin'){
        //redirect to the create view
        return view('hotels.create');
      }
      else{
        return redirect('/');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //some validation in place
        $this->validate($request, [
          'hotel_name'=>'required',
          'address'=>'required',
          'city'=>'required',
          'state'=>'required',
          'country'=>'required',
          'zip'=>'required',
          'email'=>'required',
          'phone'=>'required',
          'image'=>'image|nullable'
        ]);
        // Handle file uplaod
        if($request->hasFile('image')){
          // get filename with the extension
          $filenamewithExt =$request->file('image')->getClientOriginalName();
          // get just file name
          $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
          // get just the extension
          $extension =$request->file('images')->getclientOriginalExtension();
          // $filenameToStore
          $filenameToStore = $filename.'_'.time().'.'.$extension;
          // uplaod image
          $path = $request->file('image')->storeAs('public/hotel_images', $filenameToStore);
        }
        else{
          $filenameToStore ='noImage.jpg';
        }
        // after validate
        $hotel =new Hotel;
        $hotel->name=$request->hotel_name;
        $hotel->address =$request->address;
        $hotel->city=$request->city;
        $hotel->state=$request->state;
        $hotel->country=$request->country;
        $hotel->zip=$request->zip;
        $hotel->phone =$request->phone;
        $hotel->email =$request->email;
        $hotel->image= $filenameToStore;
        $hotel->save();
        return new HotelResource($hotel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find a Hotel based on a given Id
        return new HotelResource(Hotel::findOrFail($id));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showHotel($id)
    {
        //find a Hotel based on a given Id
        $hotel = Hotel::findOrFail($id);
        return view('hotels.show')->with('hotel',$hotel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //redirects to the edit view
        return view('hotels.edit');
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
        //get a hotel using the $id
        $hotel = Hotel::findOrFail($id);
        $hotel->name=$request->hotel_name;
        $hotel->address =$request->address;
        $hotel->city=$request->city;
        $hotel->state=$request->state;
        $hotel->country=$request->country;
        $hotel->zip=$request->zip;
        $hotel->phone =$request->email;
        $hotel->image=$request->image;
        $hotel->save();
        return new HotelResource($hotel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find and delete a Hotel with a particular id
        Hotel::find($id)->delete();

        return 204;
    }
}
