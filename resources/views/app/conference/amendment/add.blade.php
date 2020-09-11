@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Amendment') }}</div>
                    @if ( $page == "before")
                        <div class="card-body">
                            <form method="POST" action="{{route('app.conference.action.amendment.add',$conf_id)}}">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Amendment Title</label>
                                    <input id="title" class="form-control" type="text" name="title">
                                    <small id="titleHelp" class="form-text text-muted">The amendment title</small>
                                </div>
                                <div class="form-group">
                                    <label for="article">Amendment Content</label>
                                    <textarea name="article" class="form-control" id="article" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="method">Amendment Method</label>
                                    <select id="method" name="method" id="method" class="form-control">
                                        <option>strike</option>
                                        <option>add</option>
                                        <option>modify</option>
                                    </select>
                                </div>

                                <button type="submit" id="btn_submit" class="form-control btn btn-outline-primary">Submit Amendment</button>
                            </form>
                        </div>
                    @else
                        <div class="card-body">
                            @if ($status == "ok")
                                <div class="alert alert-success">
                                    <h4 class="alert-heading">Amendment Added!</h4>
                                    {{$msg}}
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    <h4 class="alert-heading">Something Wrong!</h4>
                                    {{$msg}}
                                </div>
                                <!--<a href="{{route('app.conference.role.home',$conf_id)}}" class="w-100 btn btn-primary">Conference Roles (Countries)</a>-->
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
