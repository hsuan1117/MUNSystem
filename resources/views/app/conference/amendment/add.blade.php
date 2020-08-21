@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Amendment') }}</div>
                    @if ( $page == "before")
                        <div class="card-body">
                            Add Amendment
                            <hr>
                            <form method="POST" action="{{route('app.conference.action.amendment.add',$conf_id)}}">
                                @csrf
                                <label for="title">title</label>
                                <input id="title" type="text" name="title"><br>
                                <textarea name="article"></textarea>
                                <label for="title"></label>
                                <select id="method" name="method">
                                    <option>strike</option>
                                    <option>add</option>
                                    <option>modify</option>
                                </select>
                                <input type="submit" id="btn_submit" class="btn btn-info">
                            </form>
                        </div>
                    @else
                        <div class="card-body">
                            Added Amendment<br>
                            {{$status}}
                            {{$title}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
