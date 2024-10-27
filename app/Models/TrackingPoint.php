<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingPoint extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function schedules()
    {
        return $this->belongsTo(Schedule::class, 'lbh_id', 'id');
    }
    public function ecorrectios()
    {
        return $this->belongsTo(Ecorrection::class, 'ecor_id', 'id');
    }
    public function ranhams()
    {
        return $this->belongsTo(Ranham::class, 'lah_id', 'id');
    }
}
