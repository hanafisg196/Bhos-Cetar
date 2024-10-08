<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleType extends Model
{
    use HasFactory;
    public function rules()
    {
        return $this->hasMany(Rule::class, 'rule_id', 'id');
    }
}
