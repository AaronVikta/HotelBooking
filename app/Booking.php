<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'room_id', 'total_nights','customer_email','cutomer_name','user_id','total_price'
        ];
        // relationship showing a booking belongs to one customer
      public function user()
    {
        return $this->belongsTo('App\User');
    }
}
