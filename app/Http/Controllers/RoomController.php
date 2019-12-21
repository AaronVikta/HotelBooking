<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Room;
use App\RoomType;
use App\PriceList;
use App\Http\Resources\RoomResource;
use Auth;
use View;

class RoomController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth')->except(['list','index','showRoom']);
    // }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function list()
  {
      // get all the Rooms in DB
      return RoomResource::collection(Room::paginate(5));
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the Rooms in DB
        return RoomResource::collection(Room::paginate(4));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   if((Auth::user()->type)=='admin'){
      //redirect to the create view
      $types = RoomType::all();
      return view('rooms.create')->with(['types'=>$types]);
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
        //validate the data
        $this->validate($request, [
          'room_type'=>'required',
          'room_name'=>'required',
          'image'=>'image|nullable|max:1999'
        ]);
        // Handle file uplaod
        if($request->hasFile('image')){
          // get filename with the extension
          $filenamewithExt =$request->file('image')->getClientOriginalName();
          // get just file name
          $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
          // get just the extension
          $extension =$request->file('image')->getclientOriginalExtension();
          // $filenameToStore
          $filenameToStore = $filename.'_'.time().'.'.$extension;
          // uplaod image
          $path = $request->file('image')->storeAs('public/room_images', $filenameToStore);
        }
        else{
          $filenameToStore ='noImage.jpg';
        }
        // after validate
        Schema::disableForeignKeyConstraints();
        $room = new Room;
        $room->room_type = $request->room_type;
        $room->room_name= $request->room_name;
        $room->image=$filenameToStore;
        $room->save();
        return redirect('createroom');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRoom($id)
    {
        //find a Room based on a given Id
        $room = Room::findOrFail($id);
        $linkedtype = $room->room_type;
        // dd($linkedtype);
        $type = RoomType::where('type', $linkedtype)->get();
        // dd($type);
        $rtype=$type[0];
        $room_type= $rtype['type'];
        // dd($room_type);
        $price =PriceList::where('room_type',$room_type)->get();
        // dd($price);
        $price=$price[0];
        $price=$price['price'];
        $type = $type[0];
        // dd($price);
        $type =$type->type;
        // return view('rooms.show')->with(['room'=>$room, 'type'=>$type, 'price'=>$price]);
        $roomdetails = ['room'=>$room, 'type'=>$type, 'price'=>$price];
        return $roomdetails;
    }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //find a Room based on a given Id
            return new RoomResource(Room::findOrFail($id));
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

        //get a Room using the $id
        $this->validate($request,[
          'type'=>'required',
          'name'=>'required'
        ]);
        Schema::disableForeignKeyConstraints();
        $room = Room::findOrFail($id);
        $room->room_name =$request->name;
        $room->room_type = $request->type;
        $room->update();
        return $room;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find and delete a Room with a particular id
        $type =Room::find($id);
        $type->delete();

        return response()->json(['status'=>'ok'], 200);
    }
}
