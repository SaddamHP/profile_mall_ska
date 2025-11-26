<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use hasFactory;
    protected $primaryKey = 'id_facility';
    protected $fillable = ['id_floor', 'nama_facility', 'deskripsi', 'foto'];

    public function floor() {
        return $this->belongsTo(Floor::class, 'id_floor');
    }
}
