<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;


class Email extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table="emails";
    protected $primaryKey = 'id';
    protected $fillable = [
        'users_id',
        'email',
        'subject',
        'body',
        'status'
    ];

    function User()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
