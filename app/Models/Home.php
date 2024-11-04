<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Home extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'main_image'];

    protected $searchableFields = ['*'];

    public function homeImages()
    {
        return $this->hasMany(HomeImage::class);
    }

    public function taghomes()
    {
        return $this->belongsToMany(Taghome::class);
    }
}
