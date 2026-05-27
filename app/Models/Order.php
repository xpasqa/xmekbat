<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    protected $fillable = [
        "id_sample",
        "id_project",
        "id_sample",
        "quantity",
        "total"
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project', 'id_project');
    }

    public function sample()
    {
        return $this->belongsTo(Sample::class, 'id_sample', 'id_sample');
    }

    public function labtest()
    {
        return $this->hasOne(Labtest::class, 'id_order', 'id_order');
    }
}
