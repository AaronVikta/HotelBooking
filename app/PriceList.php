<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    //
    protected $fillable =[
      'price','room_type'
    ];
    
    public function roomtype(){
      return $this->belongsTo('App\RoomType');
    }
}
