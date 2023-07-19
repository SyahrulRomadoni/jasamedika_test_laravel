<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahan';

    protected $primaryKey = 'id';

    protected $fillable = [
        'kelurahan',
        'kecamatan',
        'kota'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pasiens()
    {
        return $this->hasMany(Pasien::class, 'id_kelurahan', 'id');
    }
}
