@extends('layouts.master')

{{--blade comment--}}

@section('title')
    Lookup
@endsection

@section('content')
    <h1>Lookup</h1>

    <form method='GET' action='/lookup'>

        <label for='searchTerm'>Search by title:</label>
        <input type='text' name='searchTerm' id='searchTerm' value='{{ $searchTerm or 'example' }}'>

        <input type='checkbox' name='caseSensitive' {{ ($caseSensitive) ? 'CHECKED' : '' }} >
        <label>case sensitive</label>

        <br>
        <input type='submit' value="Lookup" class='btn btn-primary btn-small'>

        <input type='submit' value="Score without Lookup" class='btn btn-primary btn-small'>

    </form>

    @if($searchTerm != null)
    <h2>Results for query: <em>{{ $searchTerm }}</em></h2>

    @if(count($searchResults) == 0)
        No matches found.
    @else
        <div class='book'>
            @foreach($searchResults as $title => $book)
{{--blade comment--}}
                <h3>{{ $title }}</h3>
                
            @endforeach
        </div>
    @endif
@endif
@endsection