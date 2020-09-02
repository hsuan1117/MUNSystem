@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('About SweetMUN') }}</div>
                <div class="card-body">
                    Proudly Made with ♥ by <b>Hsuan Design</b>(慢慢)
                    <div class="card">
                        <div class="card-header"><i class="fa fa-commenting-o"></i>&nbsp;What's this?</div>
                        <div class="card-body">
                            <i class="fa fa-pencil-square-o"></i>&nbsp;This is the system for Model United Nation
                        </div>
                    </div>
                    &nbsp;
                    <div class="card">
                        <div class="card-header"><i class="fa fa-commenting-o"></i>&nbsp;Who developed this?</div>
                        <div class="card-body">
                            <i class="fa fa-pencil-square-o"></i>&nbsp;The system is made by Hsuan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
