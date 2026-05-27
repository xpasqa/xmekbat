<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $primaryKey = 'id_news';
    protected $fillable = [
        "slug",
        "title",
        "cover",
        "content",
        "image_content",
        "type",
    ];

    public function tags()
    {
        return $this->hasManyThrough(
            Tag::class,
            News_Tag::class,
            'id_news', // Foreign key on the environments table...
            'id_tag', // Foreign key on the deployments table...
            'id_news', // Local key on the projects table...
            'id_tag' // Local key on the environments table...
        );
    }
}
