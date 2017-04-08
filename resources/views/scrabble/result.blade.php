@extends('layouts.master')

@push('head')
    <!--<link href='/css/scrabble/show.css' rel='stylesheet'>-->
@endpush

@section('title')
    Scrabble Score
@endsection


@section('content')
    <h1>Your word scored {{$score}} points</h1>
     Here's the breakdown:
     @foreach($bonusLetter as $index => $letter)
        @foreach($bonusLetter[$index] as $key => $value)
            @if ($loop->first)
                <br>
                <strong>{{ $key }}</strong> is worth <strong>{{ $letter['tileValue'] }} </strong> points
                @if( $value != "None")
                    , but was on a <strong>{{ $value }}</strong> letter tile
                    and is worth <strong>{{ $letter['total'] }}</strong> points
                @endif
            @endif
        @endforeach
    @endforeach
    
    <br>
    
    @if($wordBonus != "none")
        Received a {{$wordBonus}} word bonus for {{$wordBonusContribution}} more points
    @endif

    <br>
    @if($bingoBonus == "on")
        Played all seven tiles in your hand and received a 50 point bonus, well done!
    @endif

    <div>
        <a href='/'>&larr; Score a new Word</a>
    </div>
@endsection


@push('body')
    <script src="/js/scrabble/show.js"></script>
@endpush