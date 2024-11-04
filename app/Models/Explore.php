<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Explore extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'main_image'];

    protected $searchableFields = ['*'];

    public function exploreImages()
    {
        return $this->hasMany(ExploreImage::class);
    }

    public function tagexplores()
    {
        return $this->belongsToMany(Tagexplore::class);
    }
}
