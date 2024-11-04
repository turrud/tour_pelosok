<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExploreImage extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['order_number', 'caption', 'image', 'explore_id'];

    protected $searchableFields = ['*'];

    protected $table = 'explore_images';

    public function explore()
    {
        return $this->belongsTo(Explore::class);
    }
}
