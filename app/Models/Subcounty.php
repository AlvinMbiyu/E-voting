<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcounty extends Model
{
    use HasFactory;

    protected $table = "subcounty";
    protected $primarykey = "id";
    protected $fillable = ['name', 'county_id'];

    
    public function towns(){
        return $this->hasMany(Town::class);
    }

    public function County(){
        return $this->belongsTo(County::class, 'county_id', 'id');
    }
}
