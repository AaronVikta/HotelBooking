<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'address','city','state','country','phone','email','zip',
    ];
    // establish a one to many relationship
    public function rooms()
  {
      return $this->hasMany('App\Room');
  }
}
