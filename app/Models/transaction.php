<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable= [
        'id','id_product','nama_pemesan','nomor_unik','uang_bayar','uang_kembali','qty'
    ];

    public function category()
    {
        return $this->belongsTo(category::class, 'id_category', 'id');
    }
    public function products()
    {
        return $this->belongsTo(products::class, 'id_product', 'id');
    }
}
