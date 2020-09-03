<?php

namespace App;

class Plan extends \Osiset\ShopifyApp\Storage\Models\Plan
{
    /**
     * A plan has many shops
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shops()
    {
        return $this->hasMany(User::class);
    }
}
