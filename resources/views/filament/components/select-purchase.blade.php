<div class="flex rounded-md relative">
    <div class="flex">
        <div class="px-2 py-3">
            <div class="h-16 w-16">
                <img src="{{ url('/storage/'.$image_url.'') }}" alt="{{ $name }}" role="img" class="h-full w-full overflow-hidden shadow object-cover" />
            </div>
        </div>
 
        <div class="flex flex-col pl-3 py-2">
            <div class="flex justify-stretch">
                <div class="text-sm font-bold pb-1 pr-5">{{ $name }}</div> 
                <div class="text-sm font-bold pb-1">(Nro Item Origen: {{ $item_source }})</div>
            </div>
            
            <div class="text-xs leading-none font-bold">Piezas en Almacen: {{ $total_pieces }}</div>
            <div class="flex flex-col items-start">
                <div class="text-xs leading-none">Categoria: {{ $category }}</div>
                <div class="text-xs leading-none">Subcategoria: {{ $subcategory }}</div>
                <div class="text-xs leading-none">Item Mao: {{ $item_mao }}</div>
            </div>
        </div>
    </div>
</div>