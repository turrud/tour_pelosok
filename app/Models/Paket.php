<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paket extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['image', 'title', 'fasilitas', 'price'];

    protected $searchableFields = ['*'];
}
