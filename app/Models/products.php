<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $fillable = [
        'products_name',
        'description',
        'section_id',
        'created_by',
    ];

    public function  section()
    {
        return $this->belongsTo(Sections::class, 'section_id' , 'id');
    }

}
