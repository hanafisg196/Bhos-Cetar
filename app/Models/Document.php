<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function schedules()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }
    public function ecorrections()
    {
        return $this->belongsTo(Ecorrection::class, 'ecorrection_id', 'id');
    }
    public function trackingPoints()
    {
        return $this->belongsTo(TrackingPoint::class, 'track_id', 'id');
    }
}
