@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Manage') }}</div>

                    <div class="card-body">
                        Manage Users here<br>
                        @if($isAdmin)
                            <a href="{{route('manage.users')}}">Users List</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
