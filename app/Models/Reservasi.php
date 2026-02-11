<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_reservasi',
        'id_kamar',
        'nama_tamu',
        'no_hp',
        'check_in',
        'check_out',
        'jumlah_tamu',
        'total_bayar',
        'status_reservasi'
    ];

    public function kamar()
    {
        return $this->belongsTo(DataKamar::class, 'id_kamar', 'id_kamar');
    }
}
