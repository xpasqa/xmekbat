<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labtest extends Model
{
    use HasFactory;
    protected $table = 'labtest';
    protected $primaryKey = 'id_labtest';
    protected $fillable = [
        "id_order",
        "selesai_qty",
        "catatan",
    ];

    public function order()
    {
        return $this->hasOne(Order::class, 'id_order', 'id_order');
    }
}
