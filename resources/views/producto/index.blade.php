{{-- @extends('layouts.app') --}}


@section('template_title')
    Producto
    
@endsection



@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Productos Disponibles</h1>
@stop

@section('content')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <title>Document</title>
</head>
<body>
     
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Producto') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                            <table id="tabla" class="table table-striped table-hover ">
                                <thead class="thead">
                                    <tr>
                                        <th>Id</th>                                      
										<th>Catergoria </th>
										<th>Nombre</th>
                                        <th>Stock</th>
                                        <th>Precio</th>
                                        <th style="text-align: center">Operar</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											
                                           <td> {{ $producto->categoria->nombre}} </td>
                                         
											<td>{{ $producto->nombre }}</td>
                                            <td>{{$producto->cantidad}}</td>
                                            <td>{{$producto->precio}}</td>
                    

                                            <td width="270px">
                                                <form action="{{ route('productos.destroy',$producto->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('productos.show',$producto->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('productos.edit',$producto->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $productos->links() !!}
            </div>
        </div>
    </div>


   

</body>
</html>
    

@endsection

    
@stop

@section('css')
  
    <link rel="stylesheet" href="/css/admin_custom.css">
  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
   
@stop

@section('js')


     <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
     <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
     
     <script>
         $(document).ready(function() {
    $('#tabla').DataTable({
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



