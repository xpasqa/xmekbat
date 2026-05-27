<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id_project';
    protected $fillable = [
        "id_user",
        "no_order",
        "project_name",
        "project_location",
        "pic",
        "company_name",
        "company_address",
        "file",
        "current_step",
        "sidebar_step",
        "status",
        "accepted_at",
        "estimated_opened",
        "bukti_pembayaran",
        "invoice",
        "saran",
        "email",
        "phone",
        "address"
    ];
    protected $dates = ['deleted_at'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_project', 'id_project');
    }

    public function preparing_image()
    {
        return $this->hasMany(PreparingImage::class, 'id_project', 'id_project');
    }

    public function notes()
    {
        return $this->hasMany(Notes::class, 'id_project', 'id_project');
    }

    public function hasil_image()
    {
        return $this->hasMany(HasilImage::class, 'id_project', 'id_project');
    }
}
