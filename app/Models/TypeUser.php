<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TypeUser extends Model
{
    use HasFactory;


    protected $fillable = ['type'];

   /**
     * Function to get users
     */
    public function User()
    {
        return $this->hasMany(User::class, 'type_users_id');
    }

}
