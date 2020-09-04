@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('About SweetMUN') }}</div>
                    <div class="card-body" id="about_panel">
                        Proudly Made with ♥ by <b>Hsuan Design</b>(慢慢)<br>
                        特別感謝台南一中模聯社、台南一中資訊社的鼎力支持。
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-commenting-o"></i>
                                <button class="btn btn-link" data-toggle="collapse" data-target="#intro_1">
                                    這是甚麼?
                                </button>
                            </div>
                            <div id="intro_1" class="collapse show" data-parent="#about_panel">
                                <div class="card-body">
                                    <i class="fa fa-pencil-square-o"></i>&nbsp;
                                    這是一個為模擬聯合國(Model United Nation)設計的一套輔助會議軟體。
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-commenting-o"></i>
                                <button class="btn btn-link" data-toggle="collapse" data-target="#intro_2">
                                    這個軟體是誰開發的?
                                </button>
                            </div>
                            <div id="intro_2" class="collapse" data-parent="#about_panel">
                                <div class="card-body">
                                    <i class="fa fa-pencil-square-o"></i>&nbsp;
                                    這套系統由Hsuan一人獨自完成，特別感謝台南一中資訊社各位同學的測試及幫忙。
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-commenting-o"></i>
                                <button class="btn btn-link" data-toggle="collapse" data-target="#intro_3">
                                    此套系統需要收費嗎?
                                </button>
                            </div>
                            <div id="intro_3" class="collapse" data-parent="#about_panel">
                                <div class="card-body">
                                    <i class="fa fa-pencil-square-o"></i>&nbsp;
                                    此軟體為私有軟體，會議主辦單位須向我購買授權即可架設此軟體。
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
