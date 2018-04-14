@extends('layouts.main')
 
@section('content')

@if(!empty($chart))
        <div class="app"> {!! Charts::styles() !!}
                <br>
                <div class="content">
                        <div class="title m-b-md">
                                <center><h2 class="text-muted">Gráficas</h2></center>
                        </div>
                </div>
                <br>
                <hr>
                <br>
                <div class="pull-left">{!! $chart->html() !!}</div>
                <div class="pull-left">{!! $chart2->html() !!}</div>
                <div class="pull-left">{!! $chart3->html() !!}</div>
                <div class="pull-left">{!! $chart4->html() !!}</div>
                <div class="pull-left">{!! $chart5->html() !!}</div>
        </div>
        {!! Charts::scripts() !!}
        {!! $chart->script() !!}
        {!! $chart2->script() !!}
        {!! $chart3->script() !!}
        {!! $chart4->script() !!}
        {!! $chart5->script() !!}
@endif

@stop