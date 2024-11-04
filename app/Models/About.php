<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'main_image'];

    protected $searchableFields = ['*'];

    public function aboutImages()
    {
        return $this->hasMany(AboutImage::class);
    }

    public function tagabouts()
    {
        return $this->belongsToMany(Tagabout::class);
    }
}
