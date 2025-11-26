<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use hasFactory;
    protected $primaryKey = 'id_event';
    protected $fillable = ['id_floor', 'nama_event', 'tanggal_mulai', 'tanggal_selesai', 'deskripsi', 'gambar'];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime'
    ];

    public function floor() {
        return $this->belongsTo(Floor::class, 'id_floor');
    }
}
