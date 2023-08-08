<div class="">

    <div class="mb-6">

        <h1 class="text-3xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-thin mb-6  bg-white">Consultas</h1>

        <div class="flex justify-between">

            <div class="flex">

                <input type="number" placeholder="Número de control" min="1" class="bg-white rounded-l text-sm w-full focus:ring-0" wire:model.defer="search">

                <button
                    wire:click="consultar"
                    wire:loading.attr="disabled"
                    wire:target="consultar"
                    type="button"
                    class="bg-blue-400 hover:shadow-lg text-white font-bold px-4 rounded-r text-sm hover:bg-blue-700 focus:outline-none ">

                    <img wire:loading wire:target="consultar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>

                </button>

            </div>

        </div>

    </div>

    @if($tramite)

        <div class="relative overflow-x-auto rounded-lg shadow-xl border-t-2 border-t-gray-500">

            <table class="rounded-lg w-full">

                <thead class="border-b border-gray-300 bg-gray-50">

                    <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Número de Control

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Estado

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Servicio

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Solicitante

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Folio Real

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Tomo / Bis

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Registro / Bis

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Tipo de Servicio

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Registro

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Actualizado

                        </th>

                        @if(auth()->user()->hasRole('Validación'))

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Acciones

                            </th>

                        @endif

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">


                    <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Número de control</span>

                            {{ $tramite->numero_control }}

                        </td>

                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center  lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Estado</span>

                            <span class="bg-{{ $tramite->estado_color }} py-1 px-2 rounded-full text-white text-xs">{{ ucfirst($tramite->estado) }}</span>

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

                            {{ $tramite->folio_real ?? 'N/A' }}

                        </td>

                        <td class="px-3 py-3 w-full lg:w-auto capitalize p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden  absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tomo / Bis</span>

                            {{ $tramite->tomo  ?? 'N/A' }} {{ $tramite->tomo_bis ? '/ Bis' : ''}}

                        </td>

                        <td class="px-3 py-3 w-full lg:w-auto capitalize p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden  absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registro / Bis</span>

                            {{ $tramite->registro  ?? 'N/A' }} {{ $tramite->registro_bis ? '/ Bis' : ''}}

                        </td>

                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo de servicio</span>

                            {{ $tramite->tipo_servicio }}

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

                            <button
                                wire:click="abrirModalEditar({{$tramite->id}})"
                                wire:loading.attr="disabled"
                                wire:target="abiriModalEditar({{$tramite->id}})"
                                class="w-1/3 lg:w-full bg-green-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-1 items-center rounded-full hover:bg-green-700 flex justify-center focus:outline-none"
                            >

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>

                                Ver

                            </button>

                        </td>

                    </tr>

                </tbody>

                <tfoot class="border-gray-300 bg-gray-50">

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

            <h1 class="text-lg tracking-widest rounded-xl border-gray-500 text-center mb-5">Trámite</h1>

        </x-slot>

        <x-slot name="content">

            <div class="">

                @if ($modelo_editar->id)

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Número de control:</strong> {{ $modelo_editar->numero_control }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Estado:</strong> {{ Str::ucfirst($modelo_editar->estado) }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Categoría:</strong> {{ $modelo_editar->servicio->categoria->nombre }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Servicio:</strong> {{ $modelo_editar->servicio->nombre }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Tipo de servicio:</strong> {{ Str::ucfirst($modelo_editar->tipo_servicio) }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Solicitante:</strong>{{ $modelo_editar->solicitante }} / {{ $modelo_editar->nombre_solicitante }}</p>

                        </div>

                        @if ($modelo_editar->folio_real)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Folio real:</strong> {{ $modelo_editar->folio_real }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->tomo)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Tomo:</strong> {{ $modelo_editar->tomo }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->registro)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Registro:</strong> {{ $modelo_editar->registro }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->distrito)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Distrito:</strong> {{ App\Http\Constantes::DISTRITOS[$modelo_editar->distrito] }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->seccion)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Sección:</strong> {{ $modelo_editar->seccion }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->tomo_gravamen)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Tomo gravamen:</strong> {{ $modelo_editar->tomo_gravamen }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->registro_gravamen)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Registro gravamen:</strong> {{ $modelo_editar->registro_gravamen }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->numero_oficio)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Número de oficio:</strong> {{ $modelo_editar->numero_oficio }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->numero_propiedad)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Número de propiedad:</strong> {{ $modelo_editar->numero_propiedad }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->numero_escritura)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Número de escritura:</strong> {{ $modelo_editar->numero_escritura }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->numero_notaria)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Número de notaría:</strong> {{ $modelo_editar->numero_notaria }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->nombre_notario)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Nombre del notarío:</strong> {{ $modelo_editar->nombre_notario }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->valor_propiedad)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Número de escritura:</strong> {{ $modelo_editar->numero_escritura }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->numero_paginas)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Número de páginas:</strong> {{ $modelo_editar->numero_paginas }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->numero_inmuebles)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Número de inmuebles:</strong> {{ $modelo_editar->numero_inmuebles }}</p>

                            </div>

                        @endif

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Monto:</strong> ${{ number_format($modelo_editar->monto, 2) }}</p>

                        </div>

                        @if ($modelo_editar->fecha_entrega)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p class="text-red-500"><strong class="text-black">Fecha de entrega:</strong> {{ $modelo_editar->fecha_entrega->format('d-m-Y') }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->fecha_pago)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Fecha de pago:</strong> {{ $modelo_editar->fecha_pago }}</p>

                            </div>

                        @endif

                        @if ($modelo_editar->limite_de_pago)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Límite de pago:</strong> {{ $modelo_editar->limite_de_pago }}</p>

                            </div>

                        @endif

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Orden de pago:</strong> {{ $modelo_editar->orden_de_pago }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Linea de captura:</strong> {{ $modelo_editar->linea_de_captura }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Registrado por:</strong> {{ $modelo_editar->creadoPor->name }} el {{ $modelo_editar->created_at }}</p>

                        </div>

                    </div>

                    @if ($modelo_editar->observaciones)

                        <div class="rounded-lg bg-gray-100 py-1 px-2 my-3">

                            <strong>Observaciones:</strong>

                            <p>{{ $modelo_editar->observaciones }}</p>

                        </div>

                    @endif

                    @if($modelo_editar->adicionadoPor->count())

                        <div class="rounded-lg bg-gray-100 py-1 px-2 my-3">

                            <p>Adicionado por:</p>

                            <div class="flex space-x-2 flex-row">

                                @foreach ($modelo_editar->adicionadoPor as $item)

                                    <p><strong>NC:</strong>{{ $item->numero_control }}</p>

                                @endforeach

                            </div>

                        </div>

                    @endif

                    @if($modelo_editar->adicionaAlTramite->count())

                        <div class="rounded-lg bg-gray-100 py-1 px-2 my-3">

                            <p>Adiciona a:</p>

                            <div class="flex space-x-2 flex-row">

                                <p><strong>NC:</strong>{{ $modelo_editar->adicionaAlTramite->numero_control }}</p>

                            </div>

                        </div>

                    @endif

                @endif

            </div>

        </x-slot>

        <x-slot name="footer">

            <div class="">

                @if($modelo_editar->estado == 'nuevo')

                    <button
                        wire:click="reimprimir"
                        wire:loading.attr="disabled"
                        wire:target="reimprimir"
                        class="bg-gray-400 text-white hover:shadow-lg font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-gray-700 flaot-left mr-1 focus:outline-none">

                        <img wire:loading wire:target="reimprimir" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Imprimir recibo
                    </button>

                @endif

                @if(!$modelo_editar->fecha_pago)

                    @can('Validar pago')

                        <button
                            wire:click="validarPago"
                            wire:loading.attr="disabled"
                            wire:target="validarPago"
                            type="button"
                            class="bg-red-400 text-white hover:shadow-lg font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-red-700 flaot-left mr-1 focus:outline-none">
                            <img wire:loading wire:target="validarPago" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                            Validar
                        </button>

                    @endcan

                @endif

            </div>

        </x-slot>

    </x-jet-dialog-modal>

    <script>

        window.addEventListener('imprimir_recibo', event => {

            const tramite = event.detail.tramite;

            var url_orden = "{{ route('tramites.orden', '')}}" + "/" + tramite;

            window.open(url_orden, '_blank');

            var url_ticket = "{{ route('tramites.recibo', '')}}" + "/" + tramite;

            window.open(url_ticket, '_blank');

        });

    </script>

</div>
