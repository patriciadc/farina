<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\Feeling;
use Twitter;
use File;
use Charts;
use DateTime;
use MonkeyLearn\MonkeyLearnClient;
use LithiumDev\TagCloud\TagCloud;

class TwitterController extends Controller
{
    public function getTweetsByHashtag(){
        $data = Twitter::getSearch(array('q' => '#farina', 'count' => 100, 'format' => 'array'));
        return view('twitter',compact('data'));
    }

    public function saveTweets(){
        Tweet::truncate();
        $data = Twitter::getSearch(array('q' => '#farina', 'count' => 100, 'format' => 'array'));
        foreach($data['statuses'] as $key){
            $date = new DateTime( $key['created_at'] );
            $date->modify('+2 hours');
            $tw_date = $date->format( 'M jS G\:00\h.' );

            $tw = new Tweet;
            $tw->twitter_id   = $key['id'];
            $tw->message = $key['text'];
            $tw->favorite_count = $key['favorite_count'];
            $tw->retweet_count = $key['retweet_count'];
            $tw->created_date = $tw_date;
            $tw->save();
        }
        return redirect('feelings');
    }

    public function getTweets(){
        $tweets = Tweet::orderby('twitter_id', 'desc')->with('feelings')->paginate(20);
        return view('twitter',compact('tweets'));
    }

    public function getCharts()
    {
        $chart = Charts::database(Tweet::orderby('created_date', 'asc')->get(), 'bar', 'highcharts')
                ->title("Tweets por hora")
                ->elementLabel("Total")
                ->dimensions(500, 500)
                ->responsive(false)
                ->groupBy('created_date');
        
        $chart2 = Charts::database(Tweet::orderby('created_date', 'asc')->get(), 'line', 'highcharts')
                ->title("Tweets por hora")
                ->elementLabel("Total")
                ->dimensions(500, 500)
                ->responsive(false)
                ->groupBy('created_date');

        $data3 = Tweet::orderBy('retweet_count', 'desc')->first();

        $chart3 = Charts::create('gauge', 'justgage')
                ->title('Mayor Nº Retweets')
                ->elementLabel($data3['twitter_id'])
                ->values([$data3['retweet_count'],0,50000])
                ->responsive(false)
                ->height(300)
                ->width(1000);

        $chart4 = Charts::database(Feeling::all(), 'donut', 'highcharts')
                ->title("Tweets por sentimiento")
                ->elementLabel("Total")
                ->dimensions(600, 500)
                ->colors(['#00ff00', '#ffcc00', '#ff0000'])
                ->responsive(false)
                ->groupBy('label');

        $chart5 = Charts::database(Tweet::orderby('retweet_count', 'asc')->get(), 'pie', 'highcharts')
                ->title("Favoritos por tweet")
                ->elementLabel("Total")
                ->dimensions(400, 500)
                ->responsive(false)
                ->groupBy('favorite_count');

        return view('graficas', ['chart' => $chart, 'chart2' => $chart2, 'chart3' => $chart3, 'chart4' => $chart4, 'chart5' => $chart5]);
    }

}