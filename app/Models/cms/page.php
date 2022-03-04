<?php

namespace App\Models\cms;

use App\Models\meta_page;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class page extends Model
{
    use HasFactory,SoftDeletes;

    const SHOW = TRUE;
    const HIDE = FALSE;
    const DEPARTMENT = 'Department';
    const NAMESPACE = 'App\Models\cms\page';
    
    protected $fillable = [
        'page_type_id',
        'title',
        'slug',
        'content',
        'page_id',
        'show_on_home_page',
        'position'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function pageType(): BelongsTo
    {
        return $this->belongsTo(page_type::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(image::class,'imageable');
    }

    public function Parents(): HasMany /* Refrencing own class for parents */
    {
        return $this->hasMany(page::class);
    }

    public function Children(): BelongsTo /* Refrencing own class for children */
    {
        return $this->belongsTo(page::class,'page_id');
    }

    public function metaPage(): HasMany
    {
        return $this->hasMany(meta_page::class);
    }
    
    public function scopeParent($query)
    {
        return $query->whereNull('page_id')->whereNotNull('title');
    }
}
