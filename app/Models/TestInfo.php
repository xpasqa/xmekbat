<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestInfo extends Model
{
    use HasFactory;
    protected $table = 'test_info';
    protected $primaryKey = 'id_test_info';
    protected $fillable = [
        "name",
        "output",
        "method",
        "standard_method_description",
        "output_description",
    ];

    public function images()
    {
        return $this->hasMany(TestInfoImage::class, 'id_test_info', 'id_test_info');
    }
}
