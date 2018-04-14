
@extends('layouts.main')
 
@section('content')

    <div class="content">
        <br>
        <div class="title m-b-md">
            <center><h2 class="text-muted">Últimos Tweets #farina</h2></center>
        </div>
        <br>
        <hr>
        <br>
    </div>
    <div>
        <a href="{{ action('TwitterController@saveTweets') }}" class="btn btn-info">Actualizar tweets</a><br><br>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="50px">No</th>
                <th>Twitter Id</th>
                <th>Mensaje</th>
                <th>Favoritos</th>
                <th>Retweets</th>
                <th>Fecha</th>
                <th>Sentimiento</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($tweets))
                @foreach($tweets as $key => $tweet)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td><a href="https://twitter.com/statuses/{{ $tweet['twitter_id'] }}" target="_blank">{{ $tweet['twitter_id'] }}</a></td>
                        <td>{{ $tweet['message'] }}</td>
                        <td>{{ $tweet['favorite_count'] }}</td>
                        <td>{{ $tweet['retweet_count'] }}</td>
                        <td>{{ $tweet['created_date'] }}</td>
                        <td>
                            <center>
                            @if($tweet->feelings['label']=='positive')
                            <i class="fas fa-smile text-success" style="font-size:25px"></i>
                            @elseif($tweet->feelings['label']=='neutral')
                            <i class="fas fa-meh text-warning" style="font-size:25px"></i>
                            @elseif($tweet->feelings['label']=='negative')
                            <i class="fas fa-frown text-danger" style="font-size:25px"></i>
                            @endif
                            </center>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">No se han encontrado tweets para mostrar.</td>
                </tr>
            @endif
        </tbody>
    </table>
    <center>
        {{ $tweets->links() }}
    </center>
@stop