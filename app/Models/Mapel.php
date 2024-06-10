<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_mapel',
        'kelas',
        'kode_mapel',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function category()
    {
        return $this->hasMany(Category::class);
    }
}
