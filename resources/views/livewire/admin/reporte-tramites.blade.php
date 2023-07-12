<div>

    <div class="md:flex md:flex-row flex-col md:space-x-4 items-end bg-white rounded-xl mb-5 p-4">

        <div>

            <div>

                <Label>Fecha inicial</Label>

            </div>

            <div>

                <input type="date" class="bg-white rounded text-sm " wire:model="fecha1">

            </div>

            <div>

                @error('fecha1') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="mt-2 md:mt-0">

            <div>

                <Label>Fecha final</Label>

            </div>

            <div>

                <input type="date" class="bg-white rounded text-sm " wire:model="fecha2">

            </div>

            <div>

                @error('fecha2') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

    </div>

    <div class="md:flex flex-col md:flex-row justify-between md:space-x-3 items-center bg-white rounded-xl mb-5 p-4">

        <div class="flex-auto ">

            <div>

                <Label>Estado</Label>
            </div>

            <div>

                <select class="rounded text-sm w-full" wire:model="estado">

                    <option value="" selected>Seleccione una opción</option>
                    <option value="nuevo">Nuevo</option>
                    <option value="pagado">Pagado</option>
                    <option value="inactivo">Inactivo</option>
                    <option value="concluido">Concluido</option>
                    <option value="rechazado">Rechazado</option>
                    <option value="expirado">Expirado</option>
                    <option value="procesando">Procesando</option>
                    <option value="revision">Revision</option>
                    <option value="recibido">Recibido</option>
                    <option value="finalizado">Finalizado</option>

                </select>

            </div>

            <div>

                @error('estado') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="flex-auto ">

            <div>

                <Label>Usuario</Label>
            </div>

            <div>

                <select class="rounded text-sm w-full" wire:model="usuario_id">

                    <option value="" selected>Seleccione una opción</option>

                    @foreach ($usuarios as $usuario)

                        <option value="{{$usuario->id}}" >{{$usuario->name}}</option>

                    @endforeach

                </select>

            </div>

            <div>

                @error('usuario_id') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="flex-auto ">

            <div>

                <Label>Servicio</Label>
            </div>

            <div>

                <select class="rounded text-sm w-full" wire:model="servicio_id">

                    <option value="" selected>Seleccione una opción</option>

                    @foreach ($servicios as $servicio)

                        <option value="{{$servicio->id}}" >{{$servicio->nombre}}</option>

                    @endforeach

                </select>

            </div>

            <div>

                @error('servicio_id') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="flex-auto ">

            <div>

                <Label>Tipo de servicio</Label>
            </div>

            <div>

                <select class="rounded text-sm w-full" wire:model="tipo_servicio">

                    <option value="" selected>Seleccione una opción</option>
                    <option value="ordinario" selected>Ordinario</option>
                    <option value="urgente" selected>Urgente</option>
                    <option value="extra_urgente" selected>Extra urgente</option>

                </select>

            </div>

            <div>

                @error('tipo_servicio') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

        <div class="flex-auto ">

            <div>

                <Label>Solicitante</Label>
            </div>

            <div>

                <select class="rounded text-sm w-full" wire:model="solicitante">

                    <option value="" selected>Seleccione una opción</option>

                    @foreach ($solicitantes as $solicitante)

                        <option value="{{$solicitante}}" >{{$solicitante}}</option>

                    @endforeach

                </select>

            </div>

            <div>

                @error('solicitante') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

    </div>

    @if(count($tramites))

        <div class="rounded-lg shadow-xl mb-5 p-4 font-thin md:flex items-center justify-between bg-white">

            <p class="text-xl font-extralight">Se encontraron: {{ number_format($tramites->total()) }} registros con los filtros seleccionados.</p>

            <button wire:click="descargarExcel" class="text-white flex items-center border rounded-full px-4 py-2 bg-green-500 hover:bg-green-700 mt-2 md:mt-0 w-full md:w-auto justify-center">

                <img wire:loading wire:target="descargarExcel" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>

                Exportar a Excel

            </button>

        </div>

        <div class="relative overflow-x-auto rounded-lg shadow-xl">

            <table class="rounded-lg w-full">

                <thead class="border-b border-gray-300 bg-gray-50">

                    <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Número de control

                        </th>

                        <th  class="px-3 py-3 hidden lg:table-cell">

                            Estado

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Servicio

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Solicitante

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Folio real

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Tomo

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Registro

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Monto

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Tipo de servicio

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Número de oficio

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Tomo gravamen

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Registro gravamen

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Distrito

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Sección

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Número de paginas

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Número de inmuebles

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Número de escritura

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Notaria

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Valor de la propiedad

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Fecha de entrega

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Fecha de pago

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Documento de pago

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Linea de captura

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Movimiento registral

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Observaciones

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Registro

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Actualizado

                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none">

                    @foreach($tramites as $tramite)

                        <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0 text-center">

                            <td class="w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Folio</span>

                                {{ $tramite->numero_control }}

                            </td>

                            <td class="w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Número de control</span>

                                <span class="bg-{{ $tramite->estado_color }} py-1 px-2 rounded-full text-white text-xs">{{ ucfirst($tramite->estado) }}</span>

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Servicio</span>

                                {{ $tramite->servicio->nombre }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

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

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Número de oficio</span>

                                {{ $tramite->numero_oficio ?? 'N/A' }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tomo gravamen</span>

                                {{ $tramite->tomo_gravamen ?? 'N/A' }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registro gravamen</span>

                                {{ $tramite->registro_gravamen ?? 'N/A' }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Distrito</span>

                                {{ $tramite->distrito }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Sección</span>

                                {{ $tramite->seccion }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Número de páginas</span>

                                {{ $tramite->numero_paginas ?? 'N/A' }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Número de inmuebles</span>

                                {{ $tramite->numero_inmuebles ?? 'N/A' }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Número de escritura</span>

                                {{ $tramite->numero_escritura ?? 'N/A' }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Notaria</span>

                                {{ $tramite->numero_notaria ?? 'N/A' }} {{ $tramite->nombre_notario ?? '' }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Valor de la propiedad</span>

                                {{ $tramite->valor_propiedad ?? 'N/A' }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Fecha de entrega</span>

                                {{ $tramite->fecha_entrega?->format('d-m-Y') }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Fecha de pago</span>

                                {{ $tramite->fecha_pago?->format('d-m-Y') }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Documento de pago</span>

                                {{ $tramite->documento_de_pago ?? 'N/A' }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Linea de captura</span>

                                {{ $tramite->linea_de_captura ?? 'N/A' }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Movimeinto registral</span>

                                {{ $tramite->movimiento_registral ?? 'N/A' }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Observaciones</span>

                                {{ $tramite->observaciones ?? 'N/A' }}

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

                        </tr>

                    @endforeach

                </tbody>

                <tfoot class="border-gray-300 bg-gray-50">

                    <tr>

                        <td colspan="1" class="py-2 px-5">

                            <select class="bg-white rounded-full text-sm" wire:model="pagination">

                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>

                            </select>

                        </td>

                        <td colspan="26" class="py-2 px-5">
                            {{ $tramites->links()}}
                        </td>

                    </tr>

                </tfoot>

            </table>

            <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading>

                <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

            </div>

        </div>

    @else

        <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

            No hay resultados.

        </div>

    @endif

</div>
