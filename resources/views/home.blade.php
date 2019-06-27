@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Página Inicial</div>

                <div class="col-md-12 mt-4">
                    <form autocomplete="off">
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Nome</b></label>
                                    <input class="form-control" type="text" id="name" placeholder="Nome da cerveja">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Malte</b></label>
                                    <input class="form-control" type="text" id="malt" placeholder="Malte utilizado">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Combina com</b></label>
                                    <input class="form-control" type="text" id="food" placeholder="Comidas que combinam">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" id="filter">Filtrar</button>
                        </div>
                    </form>
                    <hr>
                </div>

                <div class="card-body">
                    <div class="container mb-3">
                        <div class="row justify-content-center align-items-center">
                            <button class="btn btn-primary" id="previous" onclick="previous()"><i class="fas fa-arrow-left"></i></button>
                            <h6 class="mx-4">Página: <span id="page">1</span></h6>
                            <button class="btn btn-primary" id="next" onclick="next()"><i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                    <div style="overflow-x:auto">
                        <table class="table">
                            <thead class="thead thead-dark">
                                <tr>
                                    <th>Nome</th>
                                    <th>Slogan</th>
                                    <th>Primeira Fabricação</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="result">

                            </tbody>
                            
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/home/home.js')}}"></script>
@endsection
