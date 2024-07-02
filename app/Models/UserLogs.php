<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLogs extends Model
{
    use HasFactory;

    public $table = 'user_logs';

    protected $fillable = ['user_id','type', 'value'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
