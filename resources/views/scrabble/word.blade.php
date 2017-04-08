@extends('layouts.master')

{{--blade comment--}}

@section('title')
    Lookup
@endsection

@section('content')
    <div class="content">
        <div class="title">Welcome to Scrabble Calculator</div>
        <div class="intro">
        Scrabble Calculator will help you validate and score your scrabble words so you can get back to the game faster! 
        <br>
        Begin by entering a word below. Optionally, choose to lookup the word's definition or simply skip straight to scoring. 
        </div>

        @if(count($errors) > 0)
            <div class='alert alert-danger'>
            <ul>
                @foreach ($errors->get('inputWord') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif    
            
        <form method='GET' action='/score'>

            <label for='inputWord'>Enter word:</label>
            <input type='text' name='inputWord' id='inputWord' value='{{ old('inputWord') }}'>

            <input type='checkbox' name='lookupDefinition' {{ ($lookupDefinition) ? 'CHECKED' : '' }} >
            <label>lookup definition</label>

            <br>
            <input type='submit' value="Score" class='btn btn-primary btn-small'>

        </form>
    </div>
@endsection