<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Post\Entities\PollOption;

class Poll extends Model
{
    protected $fillable = [];

    public function pollOptions()
    {
    	return $this->hasMany(PollOption::class, 'poll_id', 'id')
            ->orderBy('order', 'asc');
    }

    public function pollResults()
    {
        return $this->hasMany(PollResult::class, 'poll_id', 'id');
    }

    protected $casts = [
	    'start_date' => 'datetime:Y-m-d H:i:s',
	    'end_date' => 'datetime:Y-m-d H:i:s',
	];
}
