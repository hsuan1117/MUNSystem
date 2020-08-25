@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Vote') }}</div>
                    @if ( $page == "before")
                        <div class="card-body">
                            <form method="POST" action="{{route('app.conference.action.voting.add',$conf_id)}}">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Voting Title</label>
                                    <input id="title" class="form-control" type="text" name="title">
                                    <small id="titleHelp" class="form-text text-muted">The voting title</small>
                                </div>
                                <button type="submit" id="btn_submit" class="form-control btn btn-outline-primary">Add Voting</button>
                            </form>
                        </div>
                    @else
                        <div class="card-body">
                            Added Vote<br>
                            {{$status}}
                            {{$title}}
                            <a href="" ></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
