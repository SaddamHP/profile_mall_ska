<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    protected $table = 'promos';
    protected $primaryKey = 'id_promo';
    protected $fillable = ['id_tenant', 'nama_promo', 'tanggal_mulai', 'tanggal_selesai', 'gambar'];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime'
    ];

    public function tenant() {
        return $this->belongsTo(Tenant::class, 'id_tenant', 'id_tenant');
    }
}
