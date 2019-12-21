<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Http\Resources\PriceListResource;
use App\PriceList;
use Auth;

class PriceListController extends Controller
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
        // get all the PriceLists in DB
        return PriceListResource::collection(PriceList::all());
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
        return view('prices.create');
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
        //validate the request form data
        $this->validate($request, [
          'type'=>'required',
          'price'=>'required'
        ]);
        Schema::disableForeignKeyConstraints();
        $price= new PriceList;
        $price->room_type= $request->type;
        $price->price =$request->price;
        $price->save();
        return $price;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find a PriceList based on a given Id
        return new PriceListResource(PriceList::findOrFail($id));
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
        //get a PriceList using the $id
        $priceList = PriceList::findOrFail($id);
        $priceList->price =$request->price;
        $priceList->update();
        return $priceList;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find and delete a PriceList with a particular id
        $price =PriceList::find($id);
        $price->delete();

        return response()->json(['status'=>'ok'], 200);
    }
}
