@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Join Conference') }}</div>
                    @if ( $page == "before")
                        <div class="card-body">
                            <form method="POST" action="{{route('app.conference.action.join')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="confID">Conference ID</label>
                                    <input id="confID" class="form-control" max="{{$maxID}}" min="1" type="number" name="conferenceID">
                                </div>
                                <div class="form-group">
                                    <label for="confPWD">Conference Password </label>
                                    <input name="password" autocomplete="new-password"  class="form-control" type="password" id="confPWD">
                                </div>
                                <button type="submit" id="btn_submit" class="form-control btn btn-outline-primary">Join Conference</button>
                            </form>
                        </div>
                    @else
                        <div class="card-body">
                            Added Conference<br>
                            {{$status}}
                            {{$msg}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
