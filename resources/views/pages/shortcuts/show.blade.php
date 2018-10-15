@extends('layout.master')

@section('content')
    Name: {{ $shortcut->name }}<br/>
    Link: <a href="{{ $shortcut->link }}">{{ $shortcut->link }}</a><br/>
    Description: {{ $shortcut->name }}<br/>
    Created: {{ $shortcut->created_at->diffForHumans() }}<br/>
@endsection