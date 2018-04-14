<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = ['id','twitter_id','message','favorite_count','retweet_count','created_date'];
    
    public function feelings(){
        return $this->belongsTo(Feeling::class, 'twitter_id');
    }
}
