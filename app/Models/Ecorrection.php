<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecorrection extends Model
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
        return $this->hasMany(Document::class, 'ecorrection_id', 'id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'ecor_id', 'id');
    }


}
