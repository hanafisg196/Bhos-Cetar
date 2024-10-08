<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    public function ruleType()
    {
        return $this->belongsTo(RuleType::class, 'rule_id', 'id');
    }
}
