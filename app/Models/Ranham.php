<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranham extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function kkps()
    {
        return $this->belongsTo(Kkp::class, 'kkp_id', 'id');
    }
    public function category_ranhams()
    {
        return $this->belongsTo(CategoryRanhamn::class, 'catran_id', 'id');
    }
    public function trackingPoints()
    {
        return $this->hasMany(TrackingPoint::class, 'lah_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'lah_id', 'id');
    }
}
