<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $table = 'address';

    public function user()
    {
        return $this->belongsTo('\App\User', 'id');
    }

    protected $fillable = [
        'user_id','type','streetaddress','city','province','country','postalcode',
    ];

    protected $hidden = [
        'default',
    ];
}
