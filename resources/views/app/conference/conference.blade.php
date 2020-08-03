@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Conference') }}</div>

                    <div class="card-body">
                        {{$conf_id}}
                        {{gettype($conf_data)}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
