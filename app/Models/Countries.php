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



   

    public function Countries()
    {
        return $this->hasMany(Countries::class,'countries_id');
    }
    public function childrenContries()
    {
    return $this->hasMany(Countries::class)->with('Countries');
    }
}
