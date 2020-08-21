@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Note') }}</div>
                    @if ( $page == "before")
                        <div class="card-body">
                            <form method="POST" action="{{route('app.conference.action.note.add',$conf_id)}}">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Note Title</label>
                                    <input id="title" class="form-control" type="text" name="title">
                                    <small id="titleHelp" class="form-text text-muted">The Note title</small>
                                </div>
                                <div class="form-group">
                                    <label for="article">Note Content</label>
                                    <textarea name="article" class="form-control" id="article" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="recipient">Note Recipient</label>
                                    <input id="recipient" class="form-control" type="text" name="recipient">
                                </div>

                                <button type="submit" id="btn_submit" class="form-control btn btn-outline-primary">Submit Amendment</button>
                            </form>
                        </div>
                    @else
                        <div class="card-body">
                            @if ($status == "ok")
                                <div class="alert alert-success">
                                    <h4 class="alert-heading">Note Sent!</h4>
                                    {{$msg}}
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    <h4 class="alert-heading">Something Wrong!</h4>
                                    {{$msg}}
                                </div>
                                <a href="{{route('app.conference.role.home',$conf_id)}}" class="w-100 btn btn-primary">Conference Roles (Countries)</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
