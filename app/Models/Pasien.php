<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_kelurahan',
        'no_pasien',
        'nama',
        'alamat',
        'no_telepon',
        'rt_rw',
        'tanggal_lahir',
        'jenis_kelamin'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan', 'id');
    }
}
