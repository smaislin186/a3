@extends('layouts.master')

@section('title')
    Score
@endsection

@section('content')
    <h1>Word entered: {{$word}}</h1>
    
    @if($definition == 'none')
        <div class='alert alert-warning'>Word not found! </div>
    @elseif ($definition != '')
        <div class='alert alert-info'>Definition: {{ $definition }}</div>
    @endif

    @if($word != null)
        <form method ='POST' action='/result'>
            {{ csrf_field() }}
                <fieldset class='radios'>  
                <legend>Letter Bonus</legend>
                    @foreach($letters as $key => $letter)
                    <div class ='letter-group'>
                        <div class='letter'>{{ $letter }}</div>
                        <div class='radioGroup'>
                            <div class="radio-inline">
                                <input type='radio' id='bonusLetter[@php print $key @endphp][@php print $letter @endphp]' name='bonusLetter[@php print $key @endphp][@php print $letter @endphp]'
                                    value='None' checked='CHECKED'>
                                <label for='bonusLetter[@php print $key @endphp][@php print $letter @endphp]' name='bonusLetter[@php print $key @endphp][@php print $letter @endphp]'>None</label>
                            </div>
                            <div class="radio-inline">
                                <input type='radio' id='bonusLetter[@php print $key @endphp][@php print $letter @endphp]' name='bonusLetter[@php print $key @endphp][@php print $letter @endphp]'
                                    value='Double'>
                                <label for='bonusLetter[@php print $key @endphp][@php print $letter @endphp]' name='bonusLetter[@php print $key @endphp][@php print $letter @endphp]'>Double</label>
                            </div>
                            <div class="radio-inline">
                                <input type='radio' id='bonusLetter[@php print $key @endphp][@php print $letter @endphp]' name='bonusLetter[@php print $key @endphp][@php print $letter @endphp]'
                                    value='Triple'>
                                <label for='bonusLetter[@php print $key @endphp][@php print $letter @endphp]' name='bonusLetter[@php print $key @endphp][@php print $letter @endphp]'>Triple</label>
                            </div>  
                        </div>
                    @endforeach
                </fieldset>
                <legend>Word Bonus</legend>
                    <select name='bonusWord' id='bonusWord'>
                        <option value='None' >None</option>
                        <option value='Double'>Double Word</option>
                        <option value='Triple'>Triple Word</option>
                    </select>
                <legend>Bingo Bonus</legend>
                    <input type='checkbox' name='bingo' id ='bingo' 
                        {{ (!$bingoBonus) ? 'disabled' : ''}}
                    >
                    <label>Played all seven tiles in your hand?</label>    
            <div class='Calculate'>
                <input type='submit' value='Calculate' class='btn-primary btn small'>
            </div>
        </form>
    @endif
@endsection