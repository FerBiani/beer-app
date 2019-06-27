@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Favoritos</div>
                <div class="card-body">
                    <div class="container mb-3">
                            <div class="row justify-content-center align-items-center">
                                <button class="btn btn-primary" id="previous" onclick="previous()"><i class="fas fa-arrow-left"></i></button>
                                <h6 class="mx-4">Página: <span id="page">1</span></h6>
                                <button class="btn btn-primary" id="next" onclick="next()"><i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <div class="overflow-x">
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
    <script type="text/javascript" src="{{asset('js/favorites/favorites.js')}}"></script>
@endsection