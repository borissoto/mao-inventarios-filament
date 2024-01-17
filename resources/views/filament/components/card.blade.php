<p class="px-4 py-3 ">
    <span>
    <img src= "{{ asset('storage/'.$getRecord()->image_url) }}" width="80" />
    </span>
    <span class="font-small">
        Producto:
    </span>
    <span>
        {{ $getRecord()->name }}
    </span><br/>
    <span class="font-medium">
        Descripcion:
    </span>
    <span>
        {{ $getRecord()->description }}
    </span><br/>
    <span class="font-small">
        Item Ingreso:
    </span>
    <span>
        {{ $getRecord()->item }}
    </span><br/>
    <span class="font-small">
        Categoria:
    </span>
    <span>
        {{ $getRecord()->category->name }}
    </span><br/>
    <span class="font-small">
        Subcategoria:
    </span>
    <span>
        {{ $getRecord()->subcategory->name }}
    </span><br/>
    <span class="font-small">
        Precio Unitario:
    </span>
    <span>
        {{ $getRecord()->sell_price }}
    </span><br/>
    <span class="font-small">
        Precio X Mayor:
    </span>
    <span>
        {{ $getRecord()->wholesale_price }}
    </span><br/>
    <span class="font-small">
        Precio X Caja:
    </span>
    <span>
        {{ $getRecord()->box_price }}
    </span><br/>
    <span class="font-small">
        Precio X Liquidacion:
    </span>
    <span>
        {{ $getRecord()->liquidation_price }}
    </span><br/>
</p>