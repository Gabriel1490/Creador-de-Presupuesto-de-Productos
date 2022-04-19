@section('template_title')
    Producto
@endsection



@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Presupuesto</h1>
@stop

@section('content')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js" integrity="sha512-w3u9q/DeneCSwUDjhiMNibTRh/1i/gScBVp2imNVAMCt6cUHIw6xzhzcPFIaL3Q1EbI2l+nu17q2aLJJLo4ZYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
    <title>Presupuesto</title>
    
</head>
<body>

    <button  id="btnCrearPdf" class="btn btn-primary btn-sm">Generar PDF</button>
    
 <div id="container_presupuesto">
    <div class="card-body">
        <div class="table-responsive">
            <table id="tableId" class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        
                        
                        <th>Catergoria </th>
                        <th>Nombre</th>
                        <th>Precio/Unidad</th>                
                        <th>Cantidad</th>
                        <th>Subtotal</th>

                    </tr>
                </thead>
                <tbody id="idtbody">
                
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <h3 id="idTotal"></h3>
    </div>
    </div>
  <script>
      let htmlPDF = document.getElementById("container_presupuesto")
        let exportPDF = document.getElementById("btnCrearPdf")
        exportPDF.onclick =(e) => html2pdf(htmlPDF);
  </script>
    <script>
            
        

           

                // let tede = document.createElement("td");
                // let paragraph = document.createElement("p").innerText = 'Ejemplo';
                // tede.append(paragraph)
                

                // tbody.append(tede);                
                // console.log(store, typeof store);
                var tbody = document.getElementById('idtbody');
                var store = JSON.parse(localStorage.getItem("localpresupuesto"));
                for (var fila = 0; fila < store.listaPresupuesto.length; fila++) {
                    
                    let tr = document.createElement("tr")
                    let tdcat = document.createElement("td")
                    tdcat.innerText = store.listaPresupuesto[fila].category;
                    tr.append(tdcat);
                    
                    let tdnombre = document.createElement("td")
                    tdnombre.innerText = store.listaPresupuesto[fila].name;
                    tr.append(tdnombre);

                   
                    
                    let tdprecio = document.createElement("td")
                    tdprecio.innerText = store.listaPresupuesto[fila].price;
                    tr.append(tdprecio);

                    
                    
                    let tdcantidad = document.createElement("td")
                    
                    tdcantidad.innerText = store.listaPresupuesto[fila].quantity.toString();
                    tr.append(tdcantidad);
                    
                    let tdsubtotal = document.createElement("td")
                    tdsubtotal.innerText = store.listaPresupuesto[fila].subtotal;
                    tr.append(tdsubtotal);
                    
                    tbody.append(tr);
                }
                document.getElementById("idTotal").innerText = "Total: $"+store.total;
                
            // let store = JSON.parse(localStorage.getItem("localpresupuesto"));

        // console.log(store)
        // localStorage.clear();
    </script>
    
</body>

</html>
@endsection

    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
   
@stop

@section('js')

@stop