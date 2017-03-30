@extends('layouts.master')

@push('head')
    <!--<link href='/css/scrabble/show.css' rel='stylesheet'>-->
@endpush

@section('title')
    Scrabble Score
@endsection


@section('content')
    <h1>Your word scored {{$score}} points</h1>
@endsection


@push('body')
    <script src="/js/scrabble/show.js"></script>
@endpush