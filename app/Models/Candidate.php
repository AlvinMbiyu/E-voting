<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table = "candidates";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        'postion_id',
        'firstname',
        'lastname',
        'county_id'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public $timestamps = false;

    public function seat(){
        return $this->belongsTo(Position::class);
    }

    public function vote(){
        return $this->hasMany(Vote::class);
    }
}
