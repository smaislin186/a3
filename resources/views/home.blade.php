@extends('layouts.master')

@section('title')
    Welcome to Scrabble Calculator v2
@endsection

@section('content')
    <div class="content">Welcome to Scrabble Calculator v2</div>
    Scrabble Calculator will help you validate and score your scrabble words so you can get back to the game! 

    Enter a word below, then choose to lookup the word or skip straight to scoring. 

    <form method='GET' action='/score'>

        <label for='searchTerm'>Enter a word:</label>
        <input type='text' name='searchTerm' id='searchTerm' value='{{ $searchTerm or 'scrabble' }}'>

        <input type='checkbox' name='caseSensitive' {{ ($caseSensitive) ? 'CHECKED' : '' }} >
        <label>lookup</label>

        <br>
        <input type='submit' value="Score" class='btn btn-primary btn-small'>
    </form>    
@endsection