<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use hasFactory;
    protected $primaryKey = 'id_contact';    
    protected $fillable = ['id_profile', 'alamat', 'telepon', 'email', 'maps_embed'];

    public function profile() {
        return $this->belongsTo(Profile::class, 'id_profile', 'id_profile');
    }
}
