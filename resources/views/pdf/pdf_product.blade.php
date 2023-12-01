<!DOCTYPE html>
<head>
    
    <title></title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
          @page { margin-left: 80px; }
.justtext {text-align: justify}        
h4 {text-align: center;}
h5 {text-align: center;}
table {
    border-left: 0.01em solid #000000;
    border-right: 0.01em solid #000000;
    border-top: 0.01em solid #000000;
    border-bottom: 0.01em solid #000000;
    border-collapse: collapse;
}
table td {
    padding-bottom: 0.5em;
    padding-top: 0.5em;
    padding-left: 0.5em;
}
table td {
    border-left: 0.01em solid #666666;
    border-right: 0.01em solid #666666;
    border-top: 0.01em solid #666666;
    border-bottom: 0.01em solid #666666;
}
div.a{
    font-size: 14px;
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
}
img{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
}
div.imgcenter{
    margin-left: auto;
    margin-right: auto;
    width: 80px;
}


footer { position: fixed; bottom: 40px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }


    </style>
        
    
</head>
<body>
    
    
    <div class="imgcenter">
        <img src="{{public_path('img/logo_patita.png') }}" alt="" title="" />
    </div>
    {{-- <h4>MĀO IMPORTACIONES</h4> --}}
    <h4>MÃO IMPORTACIONES</h4>

    <table>
        <thead>
            <th colspan="3">{{$record->name}}</th>
        </thead>
        <tbody>
            <tr>
                <td rowspan="8" style="width: 30%"><img src="{{public_path('storage/'.$record->image_url) }}" /></td>  

                <td>Producto</td>
                <td>{{$record->name}}</td>
            </tr>
            <tr>  
                <td>Descripcion</td>
                <td>{{$record->description}}</td>
            </tr>
            <tr>
                <td>Categoria</td>
                <td>{{$record->category->name}}</td>
            </tr>
            <tr>
                
                <td>Subcategoria</td>
                <td>{{$record->subcategory->name}}</td>
            </tr>
            <tr>                
                <td>En Almacenes</td>
                <td>{{$record->stock_in}}</td>
            </tr>
            <tr>                
                <td>Precio Unitario</td>
                @if ($unit_price == 1)
                <td>{{$record->sell_price}}</td>
                @else    
                <td> - </td>
                @endif
            </tr>
            <tr>                
                <td>Precio x Docena</td>
                @if ($box_price == 1)
                <td>{{$record->box_price}}</td>
                @else
                <td> - </td>
                @endif
            </tr>
            <tr>                
                <td>Precio x Mayor</td>
                @if ($wholesome_price == 1)
                <td>{{$record->wholesale_price}}</td>                    
                @else
                <td> - </td>
                @endif
            </tr>
                

        </tbody>
    </table>
   


@php
   \Carbon\Carbon::setLocale('es');
@endphp

</body>
</html>