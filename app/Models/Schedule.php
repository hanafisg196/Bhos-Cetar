<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'schedule_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'lbh_id', 'id');
    }

    public function trackingPoints()
    {
        return $this->hasMany(TrackingPoint::class, 'lbh_id', 'id');
    }
}
