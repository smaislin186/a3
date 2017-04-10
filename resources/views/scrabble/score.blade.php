@extends('layouts.master')

@section('title')
    Scrabble Score
@endsection

@section('content')
    <h1>Word entered: {{$word}}</h1>
    
    @if($definition != '')
        Definition: {{ $definition }}
    @endif

    @if($word != null)
        <form method ='POST' action='/result'>
            {{ csrf_field() }}
            <div class ='LetterBonus'>
                <fieldset class='radios'>  
                <legend>Letter Bonus</legend>
                    @foreach($letters as $key => $letter)
                    <div class ='letter-group'>
                        <div class='letter'>{{ $letter }}</div>
                        <div class='radioGroup'>
                            <div class="radio-inline">
                                <input type='radio' id='radioN' name='bonusLetter[@php print $key @endphp][@php print $letter @endphp]'
                                    value='None' checked='CHECKED'>
                                <label for='radioN'>None</label>
                            </div>
                            <div class="radio-inline">
                                <input type='radio' id='radioD' name='bonusLetter[@php print $key @endphp][@php print $letter @endphp]'
                                    value='Double'>
                                <label for='radioD'>Double</label>
                            </div>
                            <div class="radio-inline">
                                <input type='radio' id='radioT' name='bonusLetter[@php print $key @endphp][@php print $letter @endphp]'
                                    value='Triple'>
                                <label for='radioT'>Triple</label>
                            </div>  
                            </div>
                    @endforeach
                </fieldset>
            </div>
             <div class='WordBonus'>
                <legend>Word Bonus</legend>
                <select name='bonusWord' id='bonusWord'>
                    <option value='none' >None</option>
                    <option value='double'>Double Word</option>
                    <option value='triple'>Triple Word</option>
                </select>
            </div>
            <div class = "BingoBonus">
                <legend>Bingo Bonus</legend>
                <input type='checkbox' name='bingo' id ='bingo' 
                    {{ (!$bingoBonus) ? 'disabled' : ''}}
                >
                <label>Played all seven tiles in your hand?</label>    
            </div>
            <div class='Calculate'>
                <input type='submit' value='Calculate' class='btn-primary btn small'>
            </div>
        </form>
    @endif
@endsection