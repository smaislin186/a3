@extends('layouts.master')

@push('head')
    <!--<link href='/css/scrabble/show.css' rel='stylesheet'>-->
@endpush

@section('title')
    Scrabble : {{$word}}
@endsection


@section('content')
    <h1>Scrabble : {{$word}}</h1>
@endsection


@push('body')
    <script src="/js/scrabble/show.js"></script>
@endpush