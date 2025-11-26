<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_profile';
    protected $fillable = ['nama_mall', 'deskripsi', 'gambar'];

    public function contact() {
        return $this->hasOne(Contact::class, 'id_profile', 'id_profile');
    }
}
