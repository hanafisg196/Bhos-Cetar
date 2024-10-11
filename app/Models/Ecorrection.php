<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecorrection extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function dokumens()
    {
        return $this->hasMany(Document::class, 'ecorrection_id', 'id');
    }
}
