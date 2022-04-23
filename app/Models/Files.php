<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'original_url',
        'short_url',
        'mime_type',
        'extension',
        'size',
        'download_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
