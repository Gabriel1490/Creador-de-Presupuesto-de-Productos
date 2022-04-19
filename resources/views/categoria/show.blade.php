{{-- @extends('layouts.app') --}}



@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
@section('template_title')
{{ $categoria->name ?? 'Show Categoria' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Show Categoria</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('categorias.index') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $categoria->nombre }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


