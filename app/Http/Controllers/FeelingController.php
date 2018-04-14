<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\Feeling;

class FeelingController extends Controller
{
    public function store(){

        $feelings = $this->getFeelings();

        Feeling::truncate();

        foreach($feelings as $key){

            $tw = new Feeling;
            $tw->twitter_id  = $key[0]['twitter_id'];
            $tw->category_id = $key[0]['category_id'];
            $tw->probability = $key[0]['probability'];
            $tw->label = $key[0]['label'];
            $tw->save();
        }
        return redirect('tweets');
    }

    public function getFeelings(){

        $ml = new \MonkeyLearn\Client('318867685091597e9524ce114b297bbc3b24c74c');

        $tweets = Tweet::orderby('twitter_id', 'desc')->get();

        $text_list = [];
        foreach($tweets as $t){
            $text_list[] = $t['message'];
        }

        $module_id = 'cl_qkjxv9Ly';
        $res = $ml->classifiers->classify($module_id, $text_list, false);;

        $i = 0;
        foreach($tweets as $t){
            $res->result[$i][0]['twitter_id'] = $t['twitter_id'];
            $i++;
        }

       return $res->result;
    }
}
