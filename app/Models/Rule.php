<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function users()
    {
      return $this->belongsToMany(Rule::class, 'rule_user', 'nip', 'rule_id', 'nip', 'id');
    }
}
