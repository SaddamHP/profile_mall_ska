<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use hasFactory;
    protected $primaryKey = 'id_floor';
    protected $fillable = ['lantai'];

    public function events() {
        return $this->hasMany(Event::class, 'id_floor');
    }

    public function facilities() {
        return $this->hasMany(Facility::class, 'id_floor');
    }

    public function tenants() {
        return $this->hasMany(Tenant::class, 'id_floor', 'id_floor');
    }
}
