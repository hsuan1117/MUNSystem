@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Conference Settings') }}</div>

                    <div class="card-body">
                        @if(isset($msg))
                            @if ($status=='ok')
                                <div class="alert alert-success">
                                    {{$msg}}
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    {{$msg}}
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        @endif
                        <div class="card">
                            <div class="card-header">
                                Set Step
                            </div>
                            <div class="card-body">
                                <form action="{{route('app.conference.settings.action.setStep',$conferenceID)}}"
                                      method="post">
                                    @csrf
                                    <div class="form-group">
                                        <select name="step" id='step' class="form-control">
                                            <option>Opening Speech</option>
                                            <option>Roll Call</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="form-control">Submit</button>
                                </form>
                            </div>
                        </div>
                        &nbsp;
                        <div class="card-header bg-danger">
                            Dangerous Zone
                        </div>
                        <div class="card">
                            <div class="card-header">
                                Delete Conference
                            </div>
                            <div class="card-body">
                                <form action="{{route('app.conference.settings.action.delete',$conferenceID)}}"
                                      method="post">
                                    @csrf
                                    <button type="submit" class="btn-outline-danger form-control">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
