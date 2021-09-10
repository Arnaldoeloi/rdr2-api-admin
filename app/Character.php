<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'gang_id',
        'name',
        'gender',
        'age',
        'status',
        'cause_of_death',
        'date_of_birth',
        'date_of_death',
        'nationality',
        'voiced_by',
        'description',
        'image',
        'artwork',
    ];


    public function gang()
    {
        return $this->belongsTo('App\Gang');
    }

    public function quotes()
    {
        return $this->hasMany('App\Quote');
    }

    public function nicknames()
    {
        return $this->hasMany('App\Nickname');
    }
}
