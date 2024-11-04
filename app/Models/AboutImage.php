<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutImage extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['order_number', 'caption', 'image', 'about_id'];

    protected $searchableFields = ['*'];

    protected $table = 'about_images';

    public function about()
    {
        return $this->belongsTo(About::class);
    }
}
