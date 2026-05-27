<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;
    protected $table = 'sample';
    protected $primaryKey = 'id_sample';
    protected $fillable = [
        "name",
        "price_rates",
        "sample_rates",
        "type",
        "output",
        "method",
        "standard_method_description",
        "output_description",
        "display",
    ];

    public function images()
    {
        return $this->hasMany(SampleImage::class, 'id_sample', 'id_sample');
    }
}
