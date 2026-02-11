<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKamar extends Model
{
    use HasFactory;

    protected $table = 'data_kamar';
    protected $primaryKey = 'id_kamar';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_kamar',
        'nomor_kamar',
        'tipe_kamar',
        'harga_kamar',
        'status_kamar'
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_kamar', 'id_kamar');
    }
}
