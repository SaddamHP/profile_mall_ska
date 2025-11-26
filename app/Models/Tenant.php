<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_tenant';
    protected $fillable = ['id_category', 'id_floor', 'nama_tenant', 'deskripsi', 'gambar'];

    public function promos() {
        return $this->hasMany(Promo::class, 'id_tenant');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    public function floor() {
        return $this->belongsTo(Floor::class, 'id_floor', 'id_floor');
    }
}
