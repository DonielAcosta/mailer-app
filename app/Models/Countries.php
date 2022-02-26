<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Countries;

class Countries extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'countries_id',
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Countries','countries_id');

    }

    // public function parent(){
    //     return $this->belongsTo('App\Service','service_root_id');
    //   }
}
