<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;

    protected $table = "county";
    protected $primarykey = "id";
    protected $fillable = ['name'];

    
    public function subCounty(){
        return $this->hasMany(Subcounty::class, 'county_id', 'id');
    }
}
