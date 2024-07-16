<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = "positions";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        'description',
        'max_vote',
        'priority',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public $timestamps = false;

    public function candidates(){
        return $this->hasMany(Candidate::class);
    }

    public function vote(){
        return $this->hasMany(Vote::class);
    }
}
