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
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Presupuesto</title>
  </head>
  <body>


    <div class="card-body">
        <div class="table-responsive">
            <table id="tableId" class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>Id</th>
                        
                        <th>Categoría </th>
                        <th>Nombre</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Seleccionar</th>
                        <th>Cantidad</th>
                        <th>SubTotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        {{-- <tr id="container_{{++$i}}"> --}}
                        <tr class="container">
                            <td class="idRow"></td>
                            
                            <td>

                                {{ $producto->categoria->nombre}}
                            </td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{$producto->cantidad}}</td>
                            <td class="prices">{{$producto->precio}}</td>
                            <td><input type="checkbox" name="productos" value="item" class="marcado" onchange="enanbleDisable(this)"></td>
                            <td><input type="number" class="quantities" style="width: 80px" onchange="quantityChange(this)" disabled value="0"></td>
                            <td class="subtotales">0</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <h3 id="precioTotal">Total: $0</h3>
            </div>
            
                <button class="btn btn-primary btn-sm type="button" id="boton" onclick="crearPresupuesto()">Generar Presupuesto</button>
          
           
            @csrf
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
   $('#tableId').DataTable({
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

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script> 
    
    var ids = document.getElementsByClassName('idRow');
    var prices = document.getElementsByClassName('prices');
    var quantities = document.getElementsByClassName('quantities');
    var marcado = document.getElementsByClassName('marcado');
    let subtotales = document.getElementsByClassName('subtotales');
    
    for (let k = 0; k < ids.length; k++) {
        ids[k].innerText = k+1;
        prices[k].setAttribute('id', `price${k+1}`);
        quantities[k].setAttribute('id', `quantity${k+1}`);
        quantities[k].setAttribute('name', `${k+1}`);
        marcado[k].setAttribute('id',`checkbox${k+1}`);
        marcado[k].setAttribute('num',`${k+1}`);
        subtotales[k].setAttribute('id',`subtotal${k+1}`);
        
    }
    var presupuestoTotal = {};
    var listaPresupuesto = []; // aca van los checkeados
    var unProducto = {};
    var boton = document.getElementById('boton')
    var container = document.getElementsByClassName("container");
    var preciot = 0;
    let preciototal = document.getElementById('precioTotal'); // Total: 0
    

    function calculateTotal(q) {
        preciot = 0;
        preciototal.innerText = "Total: $0";

        for (let s = 0; s < subtotales.length; s++) {
            // if (!q.getAttribute('disabled', true)) {
                preciot = preciot + Number(subtotales[s].innerText);
            // }
        }
        preciototal.innerText = "Total: $" + preciot;
    }
    function guardar_localstorage (){
        localStorage.setItem("localpresupuesto",JSON.stringify(presupuestoTotal));   
    }

    function crearPresupuesto(){

        listaPresupuesto = [];
        for (let i = 0; i < container.length; i++) {
            unProducto = {};
            if (container[i].children[5].firstChild.checked == true) {
                
                unProducto.id = container[i].children[0].innerText;
                unProducto.category = container[i].children[1].innerText;
                unProducto.name = container[i].children[2].innerText;
                unProducto.stock = container[i].children[3].innerText;
                unProducto.price = container[i].children[4].innerText;
                unProducto.quantity = container[i].children[6].firstChild.value;
                unProducto.subtotal = container[i].children[7].innerText;
                listaPresupuesto.push(unProducto);
            }
            
        }
        presupuestoTotal.listaPresupuesto = listaPresupuesto;
        presupuestoTotal.total = preciot;
        // console.log(presupuestoTotal)
        guardar_localstorage()
        console.log("linea 165",JSON.parse(localStorage.getItem("localpresupuesto")))
        // localStorage.clear();
        window.location.href = "/pdf";

        // axios.post("/presupuesto-test", presupuestoTotal)
        // .then (r=> {
        //     alert("Se genero tu presupuesto exitosamente!")
        //     console.log(r.data)
        // })
        // .catch(e => console.log(e.response.data));
    
    };   
     
//      .then(response => response.json())
//      .catch(function (error) {
//     console.log(error);
//   });
       
        // const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        // fetch('http://127.0.0.1:8000/productos/presupuesto', {
        //     method:"POST",

           
        //     body: JSON.stringify(presupuestoTotal)
        //     headers:{
        //         "Content-type": "application/json"
        //         "X-CSRF-Token":csrfToken
        //     },
        // });
        //   .then(res=>res.json())
        //  .then(data=>console.log(data))

        
            // function() {
            //     let tbody = document.getElementById('idtbody');
            //     let store = JSON.parse(localStorage.getItem("localpresupuesto"));

                
            //     for (let fila = 0; fila < store.listaPresupuesto; fila++) {
            //         let tr = document.createElement("tr")
            //         let tdcat = document.createElement("td")
            //         tdcat.innerText = store.listaPresupuesto[fila].category;
            //         tr.appendChild(tdcat);
                    
            //         let tdcat = document.createElement("td")
            //         tdcat.innerText = store.listaPresupuesto[fila].category;
            //         tr.appendChild(tdcat);
                    
            //         let tdcat = document.createElement("td")
            //         tdcat.innerText = store.listaPresupuesto[fila].category;
            //         tr.appendChild(tdcat);
                    
            //         let tdcat = document.createElement("td")
            //         tdcat.innerText = store.listaPresupuesto[fila].category;
            //         tr.appendChild(tdcat);
                    
            //         tbody.appendChild(tr)
            //     }
            //     document.getElementById("idTotal").innerText = store.total;
            // }
   

    function quantityChange(e) {
        if (e.value < 0) {
            e.value = 0;
        }
        let precio = document.getElementById(`price${e.name}`).innerText;
        let q = document.getElementById(`quantity${e.name}`);
        document.getElementById(`subtotal${e.name}`).innerText = Number(precio) * Number(e.value);
        calculateTotal(q);
    }
    function enanbleDisable(e) {
        let q = document.getElementById(`quantity${e.getAttribute('num')}`);
        if (e.checked) {                
            q.removeAttribute("disabled");
        }
        else {
            document.getElementById(`quantity${e.getAttribute('num')}`).value = 0;
            document.getElementById(`subtotal${e.getAttribute('num')}`).innerText = '0';
            q.setAttribute("disabled", 'true');
            calculateTotal(q);
            
        }
    }
   
    
    
    
</script>

@stop