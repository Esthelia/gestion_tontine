<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    protected $table = 'payements';

    protected $guarded = [
        'id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 

    
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    
    public function contribution()
    {
        return $this->belongsTo(Contribution::class, 'contribution_id');
    }
    public function versements()
    {
        return $this->hasMany(Versement::class, 'payement_id'); 
    }
}
