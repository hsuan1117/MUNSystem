@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Conference') }}</div>
                    <div class="card-body">
                    @if ( $page == "before")

                            <form method="POST" action="{{route('app.conference.action.add')}}">
                                @csrf
                                <label for="title">title</label>
                                <input id="title" type="text" name="title">
                                <div class="form-group">
                                    <label for="confPWD">Conference Password </label>
                                    <input name="password" autocomplete="new-password"  class="form-control" type="password" id="confPWD">
                                </div>
                                <input type="submit" id="btn_submit" class="btn btn-info">
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
