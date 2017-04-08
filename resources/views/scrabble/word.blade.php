@extends('layouts.master')

{{--blade comment--}}

@section('title')
    Lookup
@endsection

@section('content')
    <div class="content">Welcome to Scrabble Calculator v2</div>
    Scrabble Calculator will help you validate and score your scrabble words so you can get back to the game faster! 

    Enter a word below, then choose to validate the word or skip straight to scoring. 

    <h1>Word</h1>

    @if(count($errors) > 0)
        <ul>
            @foreach ($errors->get('inputWord') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif    
        
    <form method='GET' action='/score'>

        <label for='inputWord'>Enter word:</label>
        <input type='text' name='inputWord' id='inputWord' value='{{ old('inputWord') }}'>

        <input type='checkbox' name='lookupDefinition' {{ ($lookupDefinition) ? 'CHECKED' : '' }} >
        <label>lookup definition</label>

        <br>
        <input type='submit' value="Score" class='btn btn-primary btn-small'>

    </form>
@endsection