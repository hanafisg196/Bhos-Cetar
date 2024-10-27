<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixFile extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function ecorrections()
    {
        return $this->belongsTo(Ecorrection::class, 'ecor_id', 'id');
    }
}
