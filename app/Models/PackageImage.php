<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageImage extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['order_number', 'caption', 'image', 'package_id'];

    protected $searchableFields = ['*'];

    protected $table = 'package_images';

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
