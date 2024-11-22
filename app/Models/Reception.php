<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    protected $table = 'receptions';

    protected $guarded = [
        'id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contributions()
    {
        return $this->belongsToMany(Contribution::class, 'reception_id');
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'reception_id');
    }
}
