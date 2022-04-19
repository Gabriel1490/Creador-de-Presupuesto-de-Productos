{{-- @extends('layouts.app') --}}

@section('template_title')
    Categoria
@endsection


@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Categorías Disponibles</h1>
@stop

@section('content')
   
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Categoria') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('categorias.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover " id="tabla1">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Nombre</th>
                                        <th style="text-align: center">Operar</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $categoria)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $categoria->nombre }}</td>

                                            <td style="width: 300px">
                                                <form action="{{ route('categorias.destroy',$categoria->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('categorias.show',$categoria->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('categorias.edit',$categoria->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Suprimir</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $categorias->links() !!}
            </div>
        </div>
    </div>
@endsection


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
     <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
     
     <script>
        $(document).ready(function() {
   $('#tabla1').DataTable({
       "language": {
           "search": "Buscar",
           "lengthMenu":  "Mostrar _MENU_ registros por paginas",
           "info":       "Mostrando pagina _PAGE_ de _PAGES_",

           "paginate": {
               "previous":"Anterior",
               "next": "Siguiente",
               "first": "Primero",
               "last": "Ultimo"
           }
       }
   });
} );
    </script>
@stop



