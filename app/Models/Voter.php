<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Voter extends Authenticatable
{
    use HasFactory;

    protected $table = "voters";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        'password',
        'firstname',
        'lastname',
        'county_id'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public $timestamps = false;

    public function vote(){
        return $this->hasMany(Vote::class);
    }
}
