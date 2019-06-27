@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{$data['user'] ? 'Atualização de Dados' : 'Cadastro'}}</div>

                <div class="card-body">
                    <!-- Auth::check() ? url('user/'.Auth::user()->id) : url('user') -->
                    <form id="form" method="POST" action="{{ url($data['url']) }}">
                        @csrf

                        @auth
                            @method('PUT')
                        @endauth

                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label"><b>Nome</b></label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="user[name]" value="{{ old('user.name', $data['user'] ? $data['user']->name : '') }}" placeholder="Nome" required autofocus>
                                <span class="errors"> {{ $errors->first('user.name') }} </span>
                            </div>
                        </div>

                        @guest

                            <div class="form-group">
                                <label for="email" class="col-md-4 col-form-label"><b>E-mail</b></label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="user[email]" value="{{ old('user.email') }}" placeholder="E-mail" required>
                                    <span class="errors"> {{ $errors->first('user.email') }} </span>
                                </div>
                            </div>

                        @endguest

                        <div class="col-md-12">
                            <div id="phones">
                                <label class="col-form-label"><b>Telefones</b></label>
                                @foreach(old('phones', $data['phones']) as $key => $phone)
                                    <div class="form-group row phone-group">

                                        @if(isset($phone['id']))
                                            <input hidden value="{{old('phones.'.$key.'.id', $phone['id'])}}" name="phones[{{$key}}][id]">
                                        @endif

                                        <div class="col-md-9">
                                            <input type="text" class="form-control phone" name="phones[{{$key}}][number]" value="{{ old('phones.'.$key.'.number', isset($phone->number) ? $phone->number : '')}}" placeholder="Telefone" required>
                                            <span class="errors"> {{ $errors->first('phones.'.$key.'.number') }} </span>
                                        </div>
                                        <div class="col-md-3 mt-1">
                                            <i class="btn btn-primary cursor-pointer fas fa-lg fa-plus add-phone"></i>
                                            <i class="btn btn-danger cursor-pointer fas fa-lg fa-trash-alt del-phone"></i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @guest

                            <div class="form-group">
                                <label for="password" class="col-md-4 col-form-label"><b>Senha</b></label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="user[password]" placeholder="Senha" required>
                                    <span class="errors"> {{ $errors->first('user.password') }} </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 col-form-label"><b>Confirmar Senha</b></label>

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="user[password_confirmation]" placeholder="Confirmar Senha" required>
                                </div>
                            </div>

                        @endguest

                        <div class="form-group mb-0">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success send-form">
                                    {{$data['button']}}
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
    <script type="text/javascript" src="{{asset('js/jquery.mask.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/form/register.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/form/validations.js')}}"></script>
@endsection

