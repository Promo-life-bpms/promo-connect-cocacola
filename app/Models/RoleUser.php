<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    public $table = 'role_user';

    protected $fillable = [
        'role_id',
        'user_id',
        'user_type'
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public $timestamps = false;

}
