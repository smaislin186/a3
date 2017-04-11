@extends('layouts.master')

@section('title')
    Results
@endsection

@section('content')
    <div class='finalscore'>Score: {{$score}}</div>
     <div class='total'>Word breakdown:</div>
        <table class="table table-bordered">
        <thead>
            <tr>
            <th>Tile</th>
            @foreach($bonusLetter as $index => $letter)
                @foreach($bonusLetter[$index] as $key => $value)
                    @if ($loop->first)
                        <th>{{ $key }}</th>
                    @endif
                @endforeach   
            @endforeach 
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">Base Value</th>
                @foreach($bonusLetter as $index => $letter)
                    @foreach($bonusLetter[$index] as $key => $value)
                        @if ($loop->first)
                            <td>{{ $letter['tileValue'] }}</td>
                        @endif
                    @endforeach   
                @endforeach
            </tr>
            <tr>
            <th scope="row">Bonus Type</th>
                @foreach($bonusLetter as $index => $letter)
                    @foreach($bonusLetter[$index] as $key => $value)
                        @if ($loop->first)
                            <td>{{ $value }}</td>
                        @endif
                    @endforeach   
                @endforeach
            </tr>
            <tr>
            <th scope="row">Tile Value with Bonus</th>
                @foreach($bonusLetter as $index => $letter)
                    @foreach($bonusLetter[$index] as $key => $value)
                        @if ($loop->first)
                            <td>{{ $letter['total'] }}</td>
                        @endif
                    @endforeach  
                @endforeach
            </tr>
        </tbody>
        </table> 
        <div class='total'>Word Total: {{ $score_from_letters }}</div>
        <div class='total'>
            @if($wordBonus != "None")
                {{$wordBonus}} Word Bonus: {{$wordBonusContribution}}
            @endif
        </div>
        <div class='total'>
            @if($bingoBonus == "on")
                Bingo Bonus: 50 (nice!)
            @endif
        </div>
    <div>
        <a href='/'>&larr; Score a new Word</a>
    </div>
@endsection
