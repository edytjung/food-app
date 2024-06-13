<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductGallery extends Model
{
    use HasFactory;
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
