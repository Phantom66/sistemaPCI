@extends('master')

@section('content')

    @include('partials.genericTable', [
        'data' => $variables,
        'title' => $variables->getUsersGoal()
    ])

@stop
