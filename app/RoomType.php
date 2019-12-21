<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type','id','type_name'
    ];

    public function prices(){
      $this->hasOne('App\PriceList');
    }
}
