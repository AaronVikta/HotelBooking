<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_type', 'capacity_id', 'image',
    ];
    public function hotel()
  {
      return $this->belongsTo('App\Hotel');
  }
  public function bookings(){
    return $this->hasMany('App\Booking');
  }
}
