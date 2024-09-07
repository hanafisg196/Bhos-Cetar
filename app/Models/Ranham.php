<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranham extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function kkps()
    {
        return $this->belongsTo(Kkp::class, 'kkp_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'lah_id', 'id');
    }
}
