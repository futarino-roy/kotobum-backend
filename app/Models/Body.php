<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Body extends Model
{
    use HasFactory;

    protected $fillable = [
        'albums_id', 
        'textData',
        'imageData',
        'pdfImage',
        'colors'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class, 'albums_id');
    }
}
