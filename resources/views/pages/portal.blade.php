@extends('layout.master')

@section('content')
    @foreach ($all_shortcuts as $category=>$shortcuts)
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">{{$category}}</legend>
            @foreach($shortcuts as $shortcut)
                <a href="{{$shortcut->link}}" target="_blank"><button type="button" class="btn btn-lg btn-primary staff_button">{{$shortcut->name}}</button></a>
            @endforeach
        </fieldset>
    @endforeach
@endsection