<div>
    <div>
        {{-- <div class="flex flex-col w-full">
            <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden  sm:rounded-lg p-2 flex flex-row justify-between"> --}}
                        <div class="flex justify-center">
                            <input wire:model.live="search" class="border-2 rounded-md p-2 border-gray-600 
                            focus:border-indigo-300 focus:ring focus:ring-indigo-400 focus:ring-opacity-50  block mt-1 w-1/2" 
                            id="search" type="text" name="search"  required="required" autofocus="autofocus" placeholder="Buscar Articulo...">
                        </div>
                    {{-- </div>
                </div>
            </div>
        </div> --}}
    </div>
    <section class="w-fit mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-5 p-10">
        @forelse ($rows as $row)
        <div class="w-72 bg-white shadow rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
            <img src="{{ asset('storage/'.$row->image_url) }}" class="h-80 w-72 object-fit rounded-t-xl hover:object-cover bg-gray-400"/>
                <div class="px-4 py-3 w-72">
                    <div class="text-sm font-bold text-black truncate block capitalize">{{$row->name}}</div>
                    <div class="text-sm font-bold text-black truncate block capitalize">{{$row->item}}</div>
                    <div class="text-gray-600 mr-3 text-sm">Descripcion: {{$row->description}}</div>
                    <div class="text-gray-400 mr-3 uppercase text-xs">Categoria: {{$row->category->name}}</div>
                    <div class="text-gray-400 mr-3 uppercase text-xs">Subcategoria: {{$row->subcategory->name}}</div>
                    <div class="justify-items-stretch">
                        @if ( ($row->stock_in - $row->stock_out) > 0)
                            <div class="text-sm font-semibold text-black cursor-auto my-1">Stock: <span class="text-sm text-green-600 font-light cursor-auto ml-2 float-right">En Stock</span></div>                            
                        @else
                            <div class="text-sm font-semibold text-black cursor-auto my-1">Stock: <span class="text-sm text-red-600 font-light cursor-auto ml-2 float-right">Agotado</span></div>                            
                        @endif
                        {{-- <div class="text-sm font-semibold text-black cursor-auto my-1">Precio Unitario: <span class="text-sm text-gray-600 font-light cursor-auto ml-2 float-right">Bs.{{$row->sell_price}}</span></div>
                        <div class="text-sm font-semibold text-black cursor-auto my-1">Precio Mayor: <span class="text-sm text-gray-600 font-light cursor-auto ml-2 float-right">Bs.{{$row->wholesale_price}}</span></div>
                        <div class="text-sm font-semibold text-black cursor-auto my-1">Precio Caja: <span class="text-sm text-gray-600 font-light cursor-auto ml-2 float-right">Bs.{{$row->box_price}}</span></div>
                        <div class="text-sm font-semibold text-black cursor-auto my-1">Precio Liquidacion: <span class="text-sm text-gray-600 font-light cursor-auto ml-2 float-right">Bs.{{$row->liquidation_price}}</span></div> --}}
                        {{-- <a href="#" class="text-orange-500 hover:text-orange-700" wire:click="edit({{ $row->id }})">{{ __("Exportar PDF") }}</a> --}}
                    </div>
                </div>
        </div>
            
        @empty
            <div>Sin Registros </div> 
        @endforelse
        
    </section>
    <div>
        Mostrando del {{ $rows->firstItem() }} al {{ $rows->lastItem() }} de {{$rows->total()}} resultados.
    </div>  
    <div class="p-2 justify-items-start">
        {{ $rows->links() }}
    </div>


      {{--    create / edit form --}}
      @if($showForm)
      <div class="fixed z-10 inset-0 overflow-y-scroll" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-200 opacity-75 transition-opacity" aria-hidden="true"></div>

                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full mx-auto">
                        <div class="flex flex-row justify-start p-2 bg-gray-100">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full {{ $mode == 'create' ? 'bg-green-100' : 'bg-blue-100' }} sm:mx-0 sm:h-10 sm:w-10">
                                @if($mode == 'create')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900 ml-4 p-2" id="modal-title">
                                {{ $mode == 'create' ? 'Add New Record' : 'Generar PDF para Clientes' }}
                            </h3>
                        </div>

                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">

                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">

                                    <div class="mt-2">
                                       <div>
                                            <label class='block'>
                                                <input type='checkbox' wire:model='is_unit' class='w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'>
                                                <span class='text-gray-700 @error('name') text-red-500  @enderror'>Precio Unitario</span>
                                            </label>
                                        </div>
                                        <div>
                                            <label class='block'>
                                                <input type='checkbox' wire:model='is_wholesale' class='w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'>
                                                <span class='text-gray-700 @error('mobile') text-red-500  @enderror'>Precio Mayor</span>
                                            </label>
                                        </div>
                                        <div>
                                            <label class='block'>
                                                <input type='checkbox' wire:model='is_box' class='w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'>
                                                <span class='text-gray-700 @error('address') text-red-500  @enderror'>Precio Caja</span>
                                            </label>
                                        </div>
                                        <div>
                                            <label class='block'>
                                                <input type='checkbox' wire:model='is_liquidation' class='w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'>
                                                <span class='text-gray-700 @error('address') text-red-500  @enderror'>Precio Liquidacion</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button @if($mode == 'create') wire:click="store()" @else wire:click="update()" @endif type="button"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-500 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm">
                                {{ $mode == 'create' ? 'Save Record' : 'Generar PDF' }}
                            </button>
                            <button wire:click="$set('showForm', false)" type="button"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    @endif
{{--    /create /edit form--}}
</div>
