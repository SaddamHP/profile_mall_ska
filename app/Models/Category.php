<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use hasFactory;
    protected $primaryKey = 'id_category';
    protected $fillable = ['nama_category', 'deskripsi'];

    public function tenants() {
        return $this->hasMany(Tenant::class, 'id_category', 'id_category');
    }
}
