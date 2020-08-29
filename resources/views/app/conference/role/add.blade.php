@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Role') }}</div>
                    <div class="card-body">
                        @if ( $page == "before")
                            <div class="alert alert-info">
                                The role of chairs must be 【chair】!
                            </div>
                            <form method="POST" action="{{route('app.conference.action.role.add',$conf_id)}}">
                                @csrf
                                <div class="form-group">
                                    <label for="role">Country Name (Role)</label>
                                    <input id="role" class="form-control" type="text" name="role">
                                    <small id="roleHelp" class="form-text text-muted">The country name</small>
                                </div>
                                <div class="form-group">
                                    <label for="id">User ID</label>
                                    <input id="id" class="form-control" type="number" min="1" max="{{$maxID}}" name="id">
                                </div>
                                <button type="submit" class="form-control btn btn-outline-primary" id="btn_submit"
                                        class="btn btn-info">Submit
                                </button>
                            </form>
                        @else
                            @if ($status == "ok")
                                <div class="alert alert-success">
                                    {{$message}}
                                </div>
                            @elseif($status == "error")
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
