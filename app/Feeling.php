<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeling extends Model
{
    protected $primaryKey = "twitter_id";
    protected $fillable = ['id','twitter_id','category_id','probability','label'];
}
