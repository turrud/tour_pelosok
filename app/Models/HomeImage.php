<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeImage extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['order_number', 'caption', 'image', 'home_id'];

    protected $searchableFields = ['*'];

    protected $table = 'home_images';

    public function home()
    {
        return $this->belongsTo(Home::class);
    }
}
