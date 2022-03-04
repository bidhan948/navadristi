<?php

namespace App\Models;

use App\Models\cms\page;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class meta_page extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['page_id','content'];

    public function Page(): BelongsTo
    {
        return $this->belongsTo(page::class);
    }
}
