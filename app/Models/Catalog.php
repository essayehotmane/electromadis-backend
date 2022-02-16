<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function extension()
    {
        return $this->belongsTo(Extension::class);
    }
}
