<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class UserData extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'users_id',
        'name',
        'phone',
        'identification',
        'date_of_birth',
        'code_city',
    ];


   /**
     * Function to get User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
