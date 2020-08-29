@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('App') }}</div>

                    <div class="card-body">
                        Welcome to {{ config('app.name', "Sweet MUN") }} !!!<br>
                        <a href="{{route('app.conference.home')}}">Conference</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
