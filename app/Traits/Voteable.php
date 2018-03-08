<?php

namespace App\Traits;

use App\Vote;

trait Voteable
{
    function votes() {
        return $this->morphMany(Vote::class, 'voteable');
    }


    public function countVotes() {
        $count = 0;
        foreach($this->votes as $vote) {
            $vote->is_upvote ? $count++ : $count--;
        }
        return $count;
    }

}