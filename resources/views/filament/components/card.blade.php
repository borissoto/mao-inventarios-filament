<div class="px-4 py-3">

    <div class="py-2 grid grid-rows-1 grid-cols-1 md:grid-cols-3 md:grid-rows-12 gap-2">
            <div class="col-span-2 md:col-span-1 md:row-span-12 m-auto ">
                <img src="{{ asset('storage/'.$getRecord()->image_url) }}" />
            </div>
            <div class="col-span-1 text-sm text-orange-50 bg-orange-300 rounded-md px-3">
                Producto:
            </div>
            <div class="col-span-1">
                {{ $getRecord()->name }}
            </div>
            <div class="col-span-1 text-sm text-orange-50 bg-orange-300 rounded-md px-3">
                Descripcion:
            </div>
            <div class="col-span-1">
                {{ $getRecord()->description }}
            </div>
            <div class="col-span-1 text-sm text-orange-50 bg-orange-300 rounded-md px-3">
                Item Ingreso:
            </div>
            <div class="col-span-1">
                {{ $getRecord()->item }}
            </div>
            <div class="col-span-1 text-sm text-orange-50 bg-orange-300 rounded-md px-3">
                Categoria:
            </div>
            <div class="col-span-1">
                {{ $getRecord()->category->name }}
            </div>
            <div class="col-span-1 text-sm text-orange-50 bg-orange-300 rounded-md px-3">
                Subcategoria:
            </div>
            <div class="col-span-1">
                {{ $getRecord()->subcategory->name }}
            </div>
        
            <div class="col-span-1 text-sm text-orange-50 bg-orange-300 rounded-md px-3">
                Precio Unitario:
            </div>
            @if($getRecord()->sell_price)
                <div class="col-span-1">
                    {{ $getRecord()->sell_price }}
                </div>
            @else
                <div class="col-span-1">
                    s/n
                </div>
            @endif        
            <div class="col-span-1 text-sm text-orange-50 bg-orange-300 rounded-md px-3">
                Precio Mayor:
            </div>
            @if($getRecord()->wholesale_price)
                <div class="col-span-1">
                    {{ $getRecord()->wholesale_price }}
                </div>
            @else
                <div class="col-span-1">
                    s/n
                </div>
            @endif
        
            <div class="col-span-1 text-sm text-orange-50 bg-orange-300 rounded-md px-3">
                Precio Caja:
            </div>
            @if($getRecord()->box_price)
                <div class="col-span-1">
                    {{ $getRecord()->box_price }}
                </div>
            @else
                <div class="col-span-1">
                    s/n
                </div>
            @endif
            <div class="col-span-1 text-sm text-orange-50 bg-orange-300 rounded-md px-3">
                Precio Liquidacion:
            </div>
            @if($getRecord()->liquidation_price)
                <div  class="col-span-1">
                    {{ $getRecord()->liquidation_price }}
                </div>
            @else
                <div class="col-span-1">
                    s/n
                </div>
            @endif
    </div>
</div>