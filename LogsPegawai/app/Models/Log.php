<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'NIP',
        'Nama',
        'Jabatan',
        'Catatan',
        'Tanggal',
        'Status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
