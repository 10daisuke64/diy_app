@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('ログインしています') }}
                    <div>
                        <a href="{{route('answer')}}" class="btn btn-primary stretched-link">質問に対して提案する</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
