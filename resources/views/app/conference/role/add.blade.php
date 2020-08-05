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
                            <form method="POST" action="{{route('app.conference.action.role.add',$conf_id)}}">
                                @csrf
                                <label for="role">role</label>
                                <input id="role" type="text" name="role"><br>
                                <label for="id">user id</label>
                                <input id="id" type="text" name="id"><br>
                                <input type="submit" id="btn_submit" class="btn btn-info">
                            </form>
                        </div>
                    @else
                        <div class="card-body">
                            Added Role<br>
                            {{$status}}
                            {{$role}}
                            {{$id}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
