<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $table = "votes";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        'voters_id',
        'candidate_id',
        'position_id',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public $timestamps = false;


    public function candidate(){
        return $this->belongsTo(Candidate::class);
    }

    public function position(){
        return $this->belongsTo(Vote::class);
    }

    public function voter(){
        return $this->belongsTo(Voter::class);
    }

}
