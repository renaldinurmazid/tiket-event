<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable= [
        'id','nama_pemesan','nomor_unik','uang_bayar','uang_kembali','product','total_belanja'
    ];

    protected $casts = [
        'product' => 'json',
    ];
}
