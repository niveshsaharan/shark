<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends \Osiset\ShopifyApp\Storage\Models\Plan
{
    use HasFactory;

    /**
     * A plan has many shops
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shops()
    {
        return $this->hasMany(User::class);
    }
}
