@push('styles')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush

<div class="">

    <div class="mb-6">

        <h1 class="text-3xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-thin mb-6  bg-white">Trámites</h1>

        <div class="flex justify-between">

            <div>

                <input type="text" wire:model.debounce.500ms="search" placeholder="Buscar" class="bg-white rounded-full text-sm">

                <select class="bg-white rounded-full text-sm" wire:model="pagination">

                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>

                </select>

            </div>

            @can('Crear trámite')

                <button wire:click="abrirModalCrear" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right text-sm py-2 px-4 text-white rounded-full focus:outline-none hidden md:block">

                    <img wire:loading wire:target="abrirModalCrear" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Agregar nuevo trámite

                </button>

                <button wire:click="abrirModalCrear" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right text-sm py-2 px-4 text-white rounded-full focus:outline-none md:hidden">+</button>

            @endcan

        </div>

    </div>

    @if($tramites->count())

        <div class="relative overflow-x-auto rounded-lg shadow-xl border-t-2 border-t-gray-500">

            <table class="rounded-lg w-full">

                <thead class="border-b border-gray-300 bg-gray-5">

                    <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                        <th wire:click="order('numero_control')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Número de Control

                            @if($sort == 'numero_control')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th wire:click="order('estado')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Estado

                            @if($sort == 'estado')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th wire:click="order('id_servicio')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Servicio

                            @if($sort == 'id_servicio')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th wire:click="order('solicitante')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Solicitante

                            @if($sort == 'solicitante')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th wire:click="order('folio_real')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Folio Real

                            @if($sort == 'folio_real')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th wire:click="order('tomo')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Tomo / Bis

                            @if($sort == 'tomo')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th wire:click="order('registro')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Registro / Bis

                            @if($sort == 'registro')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th wire:click="order('monto')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Monto

                            @if($sort == 'monto')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th wire:click="order('tipo_servicio')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Tipo de Servicio

                            @if($sort == 'tipo_servicio')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th wire:click="order('limite_de_pago')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Límite de pago

                            @if($sort == 'limite_de_pago')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th wire:click="order('created_at')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Registro

                            @if($sort == 'created_at')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th wire:click="order('updated_at')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Actualizado

                            @if($sort == 'updated_at')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">Acciones</th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                    @foreach($tramites as $tramite)

                        <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Número de control</span>

                                {{ date("Y") }}-{{ $tramite->numero_control }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center  lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Estado</span>

                                @if($tramite->estado == 'pagado')

                                    <span class="bg-green-400 py-1 px-2 rounded-full text-white uppercase text-xs">Pagado</span>

                                @elseif($tramite->estado == 'nuevo')

                                    <span class="bg-blue-400 py-1 px-2 rounded-full text-white  uppercase text-xs">nuevo</span>

                                @elseif($tramite->estado == 'finalizado')

                                    <span class="bg-gray-400 py-1 px-2 rounded-full text-white  uppercase text-xs">finalizado</span>

                                @elseif($tramite->estado == 'expirado')

                                    <span class="bg-red-400 py-1 px-2 rounded-full text-white  uppercase text-xs">expirado</span>

                                @elseif($tramite->estado == 'recibido')

                                    <span class="bg-yellow-400 py-1 px-2 rounded-full text-white  uppercase text-xs">recibido</span>

                                @elseif($tramite->estado == 'revision')

                                    <span class="bg-orange-400 py-1 px-2 rounded-full text-white  uppercase text-xs">revisión</span>

                                @elseif($tramite->estado == 'procesando')

                                    <span class="bg-green-400 py-1 px-2 rounded-full text-white  uppercase text-xs">procesando</span>

                                @elseif($tramite->estado == 'entregado')

                                    <span class="bg-gray-400 py-1 px-2 rounded-full text-white  uppercase text-xs">entregado</span>

                                @endif

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo de trámite</span>

                                {{ $tramite->servicio->nombre }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Solicitante</span>

                                {{ $tramite->solicitante }}

                                {{ $tramite->nombre_solicitante ? '/ ' . $tramite->nombre_solicitante : ''}}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Folio Real</span>

                                {{ $tramite->folio_real ? $tramite->folio_real : 'N/A' }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto capitalize p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden  absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tomo / Bis</span>

                                {{ $tramite->tomo ? $tramite->tomo : 'N/A' }} {{ $tramite->tomo_bis ? '/ Bis' : ''}}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto capitalize p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden  absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registro / Bis</span>

                                {{ $tramite->registro ? $tramite->registro : 'N/A' }} {{ $tramite->registro_bis ? '/ Bis' : ''}}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Monto</span>

                                ${{ number_format($tramite->monto, 2) }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo de servicio</span>

                                {{ $tramite->tipo_servicio }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Límite de pago</span>

                                {{ $tramite->limite_de_pago->format('d-m-Y') }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                @if($tramite->creadoPor != null)

                                    <span class="font-semibold">Registrado por: {{$tramite->creadoPor->name}}</span> <br>

                                @endif

                                {{ $tramite->created_at }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                @if($tramite->actualizadoPor != null)

                                    <span class="font-semibold">Actualizado por: {{$tramite->actualizadoPor->name}}</span> <br>

                                @endif

                                {{ $tramite->updated_at }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                                <div class="flex flex-col justify-center lg:justify-start items-center space-y-1">

                                    @can('Editar entrada')

                                        <button
                                            wire:click="abrirModalEditar({{$tramite->id}})"
                                            wire:loading.attr="disabled"
                                            wire:target="abiriModalEditar({{$tramite->id}})"
                                            class="w-1/3 lg:w-full bg-blue-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-1 items-center rounded-full hover:bg-blue-700 flex justify-center focus:outline-none"
                                        >

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-2">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>

                                            Editar

                                        </button>

                                    @endcan

                                    @can('Borrar entrada')

                                        <button
                                            wire:click="abrirModalBorrar({{$tramite->id}})"
                                            wire:loading.attr="disabled"
                                            wire:target="abrirModalBorrar({{$tramite->id}})"
                                            class="w-1/3 lg:w-full bg-red-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-1 items-center rounded-full hover:bg-red-700 flex justify-center focus:outline-none"
                                        >

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-2">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>

                                            Eliminar

                                        </button>

                                    @endcan

                                </div>

                            </td>
                        </tr>

                    @endforeach

                </tbody>

                <tfoot class="border-gray-300 bg-gray-50">

                    <tr>

                        <td colspan="20" class="py-2 px-5">
                            {{ $tramites->links()}}
                        </td>

                    </tr>

                </tfoot>

            </table>

            <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading.delay.longer>

                <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

            </div>

        </div>

    @else

        <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

            No hay resultados.

        </div>

    @endif

    <x-jet-dialog-modal wire:model="modal">

        <x-slot name="title">

            @if($crear)
                Nuevo Trámite
            @elseif($editar)
                Editar Trámite
            @endif

        </x-slot>

        <x-slot name="content">

            <div class="relative p-1">

                <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-3">

                    <div class="flex-auto mr-1 ">

                        <div class="flex space-x-4 items-center">

                            <Label>¿Adiciona a otro trámite?</Label>

                            <x-jet-checkbox wire:model="adicionaTramite"></x-jet-checkbox>

                        </div>

                    </div>

                </div>

                <div>

                    @if ($adicionaTramite)

                        <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                            <div class="flex-auto mr-1 ">

                                <div class="flex space-x-4 items-center">

                                    <Label>Seleccione el trámite</Label>

                                </div>

                                <div class="w-full md:w-1/2" wire:ignore>

                                    <select class="select2 bg-white rounded text-sm w-full  z-50" wire:model="modelo_editar.adiciona">

                                        @foreach ($tramites as $tramite)

                                            <option value="{{ $tramite->id }}">{{ $tramite->numero_control }}</option>

                                        @endforeach

                                    </select>

                                </div>

                                <div>

                                    @error('modelo_editar.adiciona') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                </div>

                            </div>

                        </div>

                    @endif

                </div>

                <div class="flex flex-col md:flex-row justify-between md:space-x-3 ">

                    <div class="flex-auto mb-3">

                        <div>

                            <Label>Categoría de servicios</Label>
                        </div>

                        <div>

                            <select class="bg-white rounded text-sm w-full" wire:model="categoria_servicio">

                                <option value="" selected>Seleccione una opción</option>

                                @foreach ($categorias as $categoria)

                                    <option  value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            @error('categoria_servicio') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    @if($servicios)

                        <div class="flex-auto ">

                            <div>

                                <Label>Servicio</Label>
                            </div>

                            <div>

                                <select class="bg-white rounded text-sm w-full" wire:model="modelo_editar.id_servicio">

                                    <option value="" selected>Seleccione una opción</option>

                                    @foreach ($servicios as $servicio)

                                        <option  value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>

                                    @endforeach

                                </select>

                            </div>

                            <div>

                                @error('modelo_editar.id_servicio') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                    @endif

                </div>

                <div class="flex flex-col md:flex-row justify-between md:space-x-3 ">

                    <div class="flex-auto mb-3 w-1/3">

                        <div>

                            <Label>Solicitante</Label>

                        </div>

                        <div>

                            <select class="bg-white rounded text-sm w-full" wire:model="modelo_editar.solicitante">

                                <option value="" selected>Seleccione una opción</option>

                                @foreach ($solicitantes as $solicitante)

                                    <option value="{{ $solicitante }}">{{ $solicitante }}</option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            @error('modelo_editar.solicitante') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    @if ($flags['flag_nombre_solicitante'])

                        <div class="flex-auto mb-3 w-full">

                            <div>

                                <Label>Nombre del solicitante</Label>

                            </div>

                            <div>

                                <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.nombre_solicitante">

                            </div>

                            <div>

                                @error('modelo_editar.nombre_solicitante') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                    @endif

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">

                        @if ($flags['flag_numero_oficio'])

                            <div class="flex-auto ">

                                <div>

                                    <Label>Número de oficio</Label>

                                </div>

                                <div>

                                    <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.numero_oficio">

                                </div>

                                <div>

                                    @error('modelo_editar.numero_oficio') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                </div>

                            </div>

                        @endif

                        @if($flags['flag_folio_real'])

                            <div class="flex-auto ">

                                <div>

                                    <Label>Folio Real</Label>
                                </div>

                                <div>

                                    <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.folio_real">

                                </div>

                                <div>

                                    @error('modelo_editar.folio_real') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                </div>

                            </div>

                        @endif

                        @if($flags['flag_tomo'])

                            <div class="flex items-center space-x-2">

                                <div class="flex-auto">

                                    <div>

                                        <Label>Tomo</Label>

                                    </div>

                                    <div>

                                        <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.tomo">

                                    </div>

                                    <div>

                                        @error('modelo_editar.tomo') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>

                                </div>

                                <div class="flex-auto">

                                    <div>

                                        <Label>Bis</Label>

                                    </div>

                                    <div>

                                        <x-jet-checkbox wire:model.defer="modelo_editar.tomo_bis"></x-jet-checkbox>

                                    </div>

                                    <div>

                                        @error('modelo_editar.tomo_bis') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>

                                </div>

                            </div>

                        @endif

                        @if($flags['flag_registro'])

                            <div class="flex items-center space-x-2">

                                <div class="flex-auto">

                                    <div>

                                        <Label>Registro</Label>

                                    </div>

                                    <div>

                                        <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.registro">

                                    </div>

                                    <div>

                                        @error('modelo_editar.registro') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>

                                </div>

                                <div class="flex-auto" >

                                    <div>

                                        <Label>Bis</Label>

                                    </div>

                                    <div>

                                        <x-jet-checkbox wire:model.defer="modelo_editar.registro_bis"></x-jet-checkbox>

                                    </div>

                                    <div>

                                        @error('modelo_editar.registro_bis') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>

                                </div>

                            </div>

                        @endif

                        @if($flags['flag_distrito'])

                            <div class="flex-auto">

                                <div>

                                    <Label>Distrito</Label>
                                </div>

                                <div>

                                    <select class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.distrito">

                                        <option value="" selected>Seleccione una opción</option>
                                        <option value="1" selected>1</option>
                                        <option value="2" selected>2</option>
                                        <option value="3" selected>3</option>
                                        <option value="4" selected>4</option>
                                        <option value="5" selected>5</option>
                                        <option value="6" selected>6</option>
                                        <option value="7" selected>7</option>
                                        <option value="8" selected>8</option>
                                        <option value="9" selected>9</option>
                                        <option value="10" selected>10</option>
                                        <option value="11" selected>11</option>
                                        <option value="12" selected>12</option>
                                        <option value="13" selected>13</option>
                                        <option value="14" selected>14</option>
                                        <option value="15" selected>15</option>
                                        <option value="16" selected>16</option>
                                        <option value="17" selected>17</option>
                                        <option value="18" selected>18</option>
                                        <option value="19" selected>19</option>

                                    </select>

                                </div>

                                <div>

                                    @error('modelo_editar.distrito') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                </div>

                            </div>

                        @endif

                        @if($flags['flag_seccion'])

                            <div class="flex-auto">

                                <div>

                                    <Label>Sección</Label>
                                </div>

                                <div>

                                    <select class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.seccion">

                                        <option value="" selected>Seleccione una opción</option>

                                        @foreach ($secciones as $seccion)

                                            <option value="{{ $seccion }}">{{ $seccion }}</option>

                                        @endforeach

                                    </select>

                                </div>

                                <div>

                                    @error('modelo_editar.seccion') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                </div>

                            </div>

                        @endif

                        @if($flags['flag_tomo_gravamen'])

                            <div class="flex-auto">

                                <div>

                                    <Label>Tomo Gravamen</Label>

                                </div>

                                <div>

                                    <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.tomo_gravamen">

                                </div>

                                <div>

                                    @error('modelo_editar.tomo_gravamen') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                </div>

                            </div>

                        @endif

                        @if($flags['flag_registro_gravamen'])

                            <div class="flex-auto">

                                <div>

                                    <Label>Registro Gravamen</Label>

                                </div>

                                <div>

                                    <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.registro_gravamen">

                                </div>

                                <div>

                                    @error('modelo_editar.registro_gravamen') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                </div>

                            </div>

                        @endif

                        @if($flags['flag_numero_propiedad'])

                            <div class="flex-auto">

                                <div>

                                    <Label>Número de propiedad</Label>
                                </div>

                                <div>

                                    <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.numero_propiedad">

                                </div>

                                <div>

                                    @error('modelo_editar.numero_propiedad') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                </div>

                            </div>

                        @endif

                        @if($flags['flag_numero_escritura'])

                            <div class="flex-auto">

                                <div>

                                    <Label>Número de escritura</Label>
                                </div>

                                <div>

                                    <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.numero_escritura">

                                </div>

                                <div>

                                    @error('modelo_editar.numero_escritura') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                </div>

                            </div>

                        @endif

                        @if($flags['flag_numero_notaria'])

                            <div class="flex-auto">

                                <div>

                                    <Label>Número de Notaria</Label>
                                </div>

                                <div>

                                    <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.numero_notaria">

                                </div>

                                <div>

                                    @error('modelo_editar.numero_notaria') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                </div>

                            </div>

                        @endif

                        @if($flags['flag_valor_propiedad'])

                            <div class="flex-auto">

                                <div>

                                    <Label>Valor de propiedad</Label>
                                </div>

                                <div>

                                    <input type="number" class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.valor_propiedad">

                                </div>

                                <div>

                                    @error('modelo_editar.valor_propiedad') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                </div>

                            </div>

                        @endif

                        @if($flags['flag_numero_inmuebles'])

                            <div class="flex-auto ">

                                <div>

                                    <Label>Cantidad de inmuebles</Label>
                                </div>

                                <div>

                                    <input type="number" class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.numero_inmuebles">

                                </div>

                                <div>

                                    @error('modelo_editar.numero_inmuebles') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                </div>

                            </div>

                        @endif

                        @if($flags['flag_numero_paginas'])

                            <div class="flex-auto">

                                <div>

                                    <Label>Cantidad de páginas</Label>
                                </div>

                                <div>

                                    <input type="number" min="1" class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.numero_paginas">

                                </div>

                                <div>

                                    @error('modelo_editar.numero_paginas') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                </div>

                            </div>

                        @endif

                </div>

                <div class="flex flex-col md:flex-row justify-between md:space-x-3 mt-3">

                    <div class="flex-auto ">

                        <div>

                            <Label>Tipo de servicio</Label>
                        </div>

                        <div>

                            <select class="bg-white rounded text-sm w-full" wire:model="modelo_editar.tipo_servicio" @if($this->modelo_editar->solicitante == "Pensiones") disabled @endif>

                                <option value="" selected>Seleccione una opción</option>
                                <option value="Ordinario" selected>Ordinario</option>
                                <option value="Urgente" selected>Urgente</option>
                                <option value="Extra Urgente" selected>Extra Urgente</option>

                            </select>

                        </div>

                        <div>

                            @error('modelo_editar.tipo_servicio') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                    @if($flags['flag_foraneo'])

                        <div class="flex-auto">

                            <div>

                                <Label>Foraneo</Label>

                            </div>

                            <div>

                                <x-jet-checkbox wire:model.defer="modelo_editar.foraneo"></x-jet-checkbox>

                            </div>

                            <div>

                                @error('modelo_editar.foraneo') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                    @endif

                </div>

                <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" wire:loading.delay.longer>

                    <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

                </div>

            </div>

        </x-slot>

        <x-slot name="footer">

            <div class="">

                @if($modelo_editar->estado == 'nuevo')

                    <a
                        href="{{ route('tramites.orden', $selected_id) }}"
                        target="_blank"
                        class="bg-gray-400 text-white hover:shadow-lg font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-gray-700 flaot-left mr-1 focus:outline-none">

                        <img wire:loading wire:target="crear" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Imprimir recibo
                    </a>

                @endif

                @if($crear)

                    <button
                        wire:click="crear"
                        wire:loading.attr="disabled"
                        wire:target="crear"
                        class="bg-blue-400 text-white hover:shadow-lg font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-blue-700 flaot-left mr-1 focus:outline-none">

                        <img wire:loading wire:target="crear" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Guardar
                    </button>

                @elseif($editar)

                    <button
                        wire:click="actualizar"
                        wire:loading.attr="disabled"
                        wire:target="actualizar"
                        class="bg-blue-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-blue-700 flaot-left mr-1 focus:outline-none">

                        <img wire:loading wire:target="actualizar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Actualizar
                    </button>

                @endif

                <button
                    wire:click="resetearTodo"
                    wire:loading.attr="disabled"
                    wire:target="resetearTodo"
                    type="button"
                    class="bg-red-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-red-700 focus:outline-none w-min">
                    Cerrar
                </button>

            </div>

        </x-slot>

    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="modalBorrar">

        <x-slot name="title">
            Eliminar trámite
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar al trámite? No sera posible recuperar la información.
        </x-slot>

        <x-slot name="footer">

            <x-jet-secondary-button
                wire:click="$toggle('modalBorrar')"
                wire:loading.attr="disabled"
            >
                No
            </x-jet-secondary-button>

            <x-jet-danger-button
                class="ml-2"
                wire:click="borrar()"
                wire:loading.attr="disabled"
                wire:target="borrar"
            >
                Borrar
            </x-jet-danger-button>

        </x-slot>

    </x-jet-confirmation-modal>

    <script>

        document.addEventListener('select2', function(){

            $('.select2').select2({
                placeholder: "Número de control",
                width: '100%',
            })

            $('.select2').val(@this.modelo_editar.adiciona);
            $('.select2').trigger('change');

            $('.select2').on('change', function(){
                @this.set('modelo_editar.adiciona', $(this).val())
            })

            $('.select2').on("keyup", function(e) {
                if (e.keyCode === 13){
                    @this.set('modelo_editar.adiciona', $('.select2').val())
                }
            });

        });

    </script>

</div>

@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        window.addEventListener('imprimir_recibo', event => {

            const tramite = event.detail.tramite;

            var url_ticket = "{{ route('tramites.recibo', '')}}" + "/" + tramite;

            var url_orden = "{{ route('tramites.orden', '')}}" + "/" + tramite;

            window.open(url_orden, '_blank');

            window.open(url_ticket, '_blank');

            window.location.href = "{{ route('tramites')}}";

        });

    </script>

@endpush
