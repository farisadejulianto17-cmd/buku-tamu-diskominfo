<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    // Nama tabel Anda
    protected $table = 'tamus';

    // Beritahu Laravel Primary Key-nya bukan 'id'
    protected $primaryKey = 'unique_id';

    // Jika unique_id bukan auto-increment, set ke false (tapi di foto Anda A_I, jadi biarkan true)
    public $incrementing = true;

    protected $fillable = [
    'nama', 
    'no_hp', // Tambahkan ini!
    'instansi', 
    'kebutuhan', 
    'waktu_kedatangan', 
    'waktu_keluar', 
    'unique_id'
    ];
}