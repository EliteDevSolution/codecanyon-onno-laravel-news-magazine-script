<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    protected $fillable = [
        'poll_id',
        'option',
        'order',
    ];

    public function pollresults()
    {
    	return $this->hasMany(PollResult::class, 'poll_option_id', 'id');
    }
}
