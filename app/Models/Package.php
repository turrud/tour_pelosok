<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'main_image', 'price'];

    protected $searchableFields = ['*'];

    public function packageImages()
    {
        return $this->hasMany(PackageImage::class);
    }

    public function tagpackages()
    {
        return $this->belongsToMany(Tagpackage::class);
    }
}
