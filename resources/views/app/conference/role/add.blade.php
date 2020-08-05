@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Role') }}</div>
                    @if ( $page == "before")
                        <div class="card-body">
                            Add Role
                            <hr>
                            <form method="POST" action="{{route('app.conference.action.add')}}">
                                @csrf
                                <label for="title">title</label>
                                <input id="title" type="text" name="title">
                                <input type="submit" id="btn_submit" class="btn btn-info">
                            </form>
                        </div>
                    @else
                        <div class="card-body">
                            Added Role<br>
                            {{$status}}
                            {{$title}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
