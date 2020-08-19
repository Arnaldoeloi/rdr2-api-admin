<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gang extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    public function characters()
    {
        return $this->hasMany('App\Character');
    }

}