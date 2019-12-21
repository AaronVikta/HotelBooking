<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\RoomType;
use App\Http\Resources\RoomTypeResource;
use View;
use Auth;

class RoomTypeController extends Controller
{
    // public function __construct(){
    //   $this->middleware('auth')->except(['index','show']);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the RoomTypes in DB
        return RoomTypeResource::collection(RoomType::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { if((Auth::user()->type)=='admin'){
        //redirect to the create view
        return view('rooms.createtype');
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
      $this->validate($request,[
        'room_type'=>'required'
      ]);
        $type = new RoomType;
        $type->type= $request->room_type;
        $type->save();
        // return redirect('createtype');
        return $type;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find a RoomType based on a given Id
        return new RoomTypeResource(RoomType::findOrFail($id));
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
        //get a RoomType using the $id
        $this->validate($request,[
          'type'=>'required'
        ]);
        $roomType = RoomType::findOrFail($id);
        $roomType->update($request->all());
        return $roomType;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find and delete a RoomType with a particular id
        $type =RoomType::find($id);
        $type->delete();

        return response()->json(['status'=>'ok'], 200);
    }
}
