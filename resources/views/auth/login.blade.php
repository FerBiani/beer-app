@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form id="form" method="POST" action="{{ url('/login') }}" autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label"><b>E-mail</b></label>
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', '') }}" placeholder="Nome" required>
                                <span class="errors"> {{ $errors->first('email') }} </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 col-form-label"><b>Senha</b></label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Senha" required>
                                <span class="errors"> {{ $errors->first('password') }} </span>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success send-form">
                                    Login
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{asset('js/form/validations.js')}}"></script>
@endsection
