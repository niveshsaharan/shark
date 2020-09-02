<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * User type: Super Admin.
     *
     * @var string
     */
    public const SUPER_ADMIN_TYPE = 'super';

    /**
     * User type: Admin.
     *
     * @var string
     */
    public const ADMIN_TYPE = 'admin';

    /**
     * Guard
     * @var string
     */
    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check if user is super admin
     * @return bool
     */
    public function isSuperAdmin()
    {
        return in_array($this->type, [self::SUPER_ADMIN_TYPE]);
    }

    /**
     * @param bool $exact If user should be only admin, not super-admin
     *
     * @return bool
     */
    public function isAdmin($exact = false)
    {
        return $exact ? $this->type === self::ADMIN_TYPE : in_array($this->type, [self::SUPER_ADMIN_TYPE, self::ADMIN_TYPE]);
    }

    /**
     * @return bool
     */
    public function canImpersonate()
    {
        // For example
        return $this->isAdmin();
    }
}
