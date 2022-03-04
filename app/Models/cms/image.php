<?php

namespace App\Models\cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class image extends Model
{
    use HasFactory;

    const NAMESPACE = 'App\Models\cms\page';
    
    protected $fillable = ['name','imageable_id','imageable_type','is_banner'];
    
    public function imageable() : MorphTo
    {
        return $this->morphTo();
    }
}
