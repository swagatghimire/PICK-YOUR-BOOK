<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin_info';

    protected $fillable = [
        'firstName', 'lastName', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
    public function subsubcategories()
    {
        return $this->hasMany(Subsubcategory::class);
    }
}
