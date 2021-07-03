<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{

    protected $table = 'contact';

    public function user()
    {
        return $this->belongsTo('\App\User', 'id');
    }

    protected $fillable = [
        'user_id','type','value',
    ];


    protected $hidden = [
        'default',
    ];

}
