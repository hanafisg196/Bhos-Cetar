<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kkp extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function ranhams()
    {
        return $this->hasMany(Ranham::class, 'kkp_id', 'id');
    }
}
