<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = "admin";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        'username',
        'password',
        'firstname',
        'lastname',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public $timestamps = false;
}
