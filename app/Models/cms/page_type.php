<?php

namespace App\Models\cms;

use App\Models\cms\page;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class page_type extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'slug'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }
    
    public function Page(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    public function Images(): MorphToMany
    {
        return $this->morphToMany(image::class, 'imageable');
    }
}
