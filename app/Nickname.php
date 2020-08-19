<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nickname extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nickname'];

    public function character()
    {
        return $this->belongsTo('App\Character');
    }
}
