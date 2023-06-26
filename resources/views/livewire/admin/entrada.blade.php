@push('styles')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush

<div class="">

    <h1 class="text-3xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-thin mb-6  bg-white">Entrada</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

        {{-- Campos --}}
        <div>

            {{-- Categoria - Servicio --}}
            <div class="flex-row lg:flex lg:space-x-3">

                <div class="flex-auto bg-white p-3 rounded-lg mb-3 shadow-md">

                    <div class="mb-2">

                        <Label class="text-lg tracking-widest rounded-xl border-gray-500">Categoría</Label>

                    </div>

                    <div>

                        <select class="bg-white rounded text-sm w-full" wire:model="categoria_selected">

                            <option selected value="">Selecciona una opción</option>

                            @foreach ($categorias as $item)

                                <option value="{{ $item }}">{{ $item->nombre }}</option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('categoria_selected') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                @if($this->categoria != '')

                    <div class="bg-white p-3 rounded-lg space-y-2 mb-3 shadow-md">

                        <div class="">

                            <div class="mb-2">

                            <Label class="text-lg tracking-widest rounded-xl border-gray-500">Servicio</Label>

                            </div>

                            <div>

                                <select class="bg-white rounded text-sm w-full" wire:model="servicio_selected">

                                    <option selected value="">Selecciona una opción</option>

                                    @foreach ($servicios as $item)

                                        <option value="{{ $item }}">{{ $item->nombre }}</option>

                                    @endforeach

                                </select>

                            </div>

                            <div>

                                @error('servicio_selected') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                    </div>

                @endif

            </div>

            @if ($flags['adiciona'])

                <div class="flex space-x-3 bg-white p-4 rounded-lg mb-3 shadow-md">

                    <div class="flex space-x-4 items-center">

                        <Label>¿Adiciona a otro trámite?</Label>

                        <x-jet-checkbox wire:model="adicionaTramite"></x-jet-checkbox>

                    </div>

                    @if($adicionaTramite)

                        <div class="flex-auto mr-1 ">

                            <div class="flex space-x-4 items-center">

                                <Label>Seleccione el trámite</Label>

                            </div>

                            <div class="" wire:ignore>

                                <select class="select2 bg-white rounded text-sm w-full  z-50" wire:model="modelo_editar.adiciona">

                                    @foreach ($tramitesAdiciona as $item)

                                        <option value="{{ $item->id }}">{{ $item->numero_control }}</option>

                                    @endforeach

                                </select>

                            </div>

                            <div>

                                @error('modelo_editar.adiciona') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                    @endif

                </div>

            @endif

            {{-- Solicitante - Nombre del solicitante --}}
            @if ($flags['solicitante'])

                <div class="flex-row lg:flex lg:space-x-3">

                    <div class="flex-auto bg-white p-3 rounded-lg mb-3 shadow-md">

                        <div class="flex-auto ">

                            <div class="mb-2">

                                <Label class="text-lg tracking-widest rounded-xl border-gray-500">Solicitante</Label>

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

                    </div>

                    @if ($flags['nombre_solicitante'])

                        <div class="flex-auto bg-white p-3 rounded-lg mb-3 shadow-md">

                            <div class="mb-2">

                                <Label class="text-lg tracking-widest rounded-xl border-gray-500">Nombre del solicitante</Label>

                            </div>

                            <div>

                                <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="modelo_editar.nombre_solicitante">

                            </div>

                            <div>

                                @error('modelo_editar.nombre_solicitante') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                    @endif

                    @if ($flags['dependencias'])

                        <div class="flex-auto bg-white p-3 rounded-lg mb-3 shadow-md">

                            <div class="mb-2">

                                <Label class="text-lg tracking-widest rounded-xl border-gray-500">Dependencia</Label>

                            </div>

                            <div>

                                <select class="bg-white rounded text-sm w-full" wire:model="modelo_editar.nombre_solicitante">

                                    <option value="" selected>Seleccione una opción</option>

                                    @foreach ($dependencias as $item)

                                        <option value="{{ $item->nombre }}">{{ $item->nombre }}</option>

                                    @endforeach

                                </select>

                            </div>

                            <div>

                                @error('modelo_editar.nombre_solicitante') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                    @endif

                    @if ($flags['notarias'])

                        <div class="flex-auto bg-white p-3 rounded-lg mb-3 shadow-md">

                            <div class="mb-2">

                                <Label class="text-lg tracking-widest rounded-xl border-gray-500">Notaria</Label>

                            </div>

                            <div>

                                <select class="bg-white rounded text-sm w-full" wire:model="notaria">

                                    <option value="" selected>Seleccione una opción</option>

                                    @foreach ($notarias as $item)

                                        <option value="{{ $item }}">{{ $item->numero }} - {{ $item->notario }}</option>

                                    @endforeach

                                </select>

                            </div>

                            <div>

                                @error('notaria') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                    @endif

                </div>

            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                @if ($flags['folio_real'])

                    <div class="flex-auto bg-white p-4 rounded-lg mb-3 shadow-md">

                        <div class="mb-2">

                            <Label class="text-lg tracking-widest rounded-xl border-gray-500">Folio real</Label>

                        </div>

                        <div>

                            <input type="number" class="bg-white rounded text-sm w-full" wire:model.lazy="modelo_editar.folio_real">

                        </div>

                        <div>

                            @error('modelo_editar.folio_real') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

                @if($flags['tomo'])

                    <div class="flex space-x-3 bg-white p-4 rounded-lg mb-3 shadow-md">

                        <div class="flex-auto">

                            <div class="mb-2">

                                <Label class="text-lg tracking-widest rounded-xl border-gray-500">Tomo</Label>

                            </div>

                            <div>

                                <input type="number" class="bg-white rounded text-sm w-full" wire:model.lazy="modelo_editar.tomo">

                            </div>

                            <div>

                                @error('modelo_editar.tomo') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                        <div class="flex-auto">

                            <div class="mb-2">

                                <Label class="text-lg tracking-widest rounded-xl border-gray-500">Bis</Label>

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

                @if($flags['registro'])

                    <div class="flex space-x-3 bg-white p-4 rounded-lg mb-3 shadow-md">

                        <div class="flex-auto">

                            <div class="mb-2">

                                <Label class="text-lg tracking-widest rounded-xl border-gray-500">Registro</Label>

                            </div>

                            <div>

                                <input type="number" class="bg-white rounded text-sm w-full" wire:model.lazy="modelo_editar.registro">

                            </div>

                            <div>

                                @error('modelo_editar.registro') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                            </div>

                        </div>

                        <div class="flex-auto" >

                            <div class="mb-2">

                                <Label class="text-lg tracking-widest rounded-xl border-gray-500">Bis</Label>

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

                @if($flags['distrito'])

                    <div class="flex-auto bg-white p-4 rounded-lg mb-3 shadow-md">

                        <div class="mb-2">

                            <Label class="text-lg tracking-widest rounded-xl border-gray-500">Distrito</Label>
                        </div>

                        <div>

                            <select class="bg-white rounded text-sm w-full" wire:model.lazy="modelo_editar.distrito">

                                <option value="" selected>Seleccione una opción</option>

                                @foreach ($distritos as $key => $item)

                                    <option value="{{  $key }}">{{  $item }}</option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            @error('modelo_editar.distrito') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

                @if($flags['seccion'])

                    <div class="flex-auto bg-white p-4 rounded-lg mb-3 shadow-md">

                        <div class="mb-2">

                            <Label class="text-lg tracking-widest rounded-xl border-gray-500">Sección</Label>

                        </div>

                        <div>

                            <select class="bg-white rounded text-sm w-full" wire:model.lazy="modelo_editar.seccion">

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

                @if($flags['tomo_gravamen'])

                    <div class="flex-auto bg-white p-4 rounded-lg mb-3 shadow-md">

                        <div class="mb-2">

                            <Label class="text-lg tracking-widest rounded-xl border-gray-500">Tomo Gravamen</Label>

                        </div>

                        <div>

                            <input type="text" class="bg-white rounded text-sm w-full" wire:model.lazy="modelo_editar.tomo_gravamen">

                        </div>

                        <div>

                            @error('modelo_editar.tomo_gravamen') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

                @if($flags['registro_gravamen'])

                    <div class="flex-auto bg-white p-4 rounded-lg mb-3 shadow-md">

                        <div class="mb-2">

                            <Label class="text-lg tracking-widest rounded-xl border-gray-500">Registro Gravamen</Label>

                        </div>

                        <div>

                            <input type="text" class="bg-white rounded text-sm w-full" wire:model.lazy="modelo_editar.registro_gravamen">

                        </div>

                        <div>

                            @error('modelo_editar.registro_gravamen') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

                @if($flags['numero_propiedad'])

                    <div class="flex-auto bg-white p-4 rounded-lg mb-3 shadow-md">

                        <div class="mb-2">

                            <Label class="text-lg tracking-widest rounded-xl border-gray-500">Número de propiedad</Label>
                        </div>

                        <div>

                            <input type="text" class="bg-white rounded text-sm w-full" wire:model.lazy="modelo_editar.numero_propiedad">

                        </div>

                        <div>

                            @error('modelo_editar.numero_propiedad') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

                @if($flags['numero_escritura'])

                    <div class="flex-auto bg-white p-4 rounded-lg mb-3 shadow-md">

                        <div class="mb-2">

                            <Label class="text-lg tracking-widest rounded-xl border-gray-500">Número de escritura</Label>
                        </div>

                        <div>

                            <input type="text" class="bg-white rounded text-sm w-full" wire:model.lazy="modelo_editar.numero_escritura">

                        </div>

                        <div>

                            @error('modelo_editar.numero_escritura') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

                @if($flags['valor_propiedad'])

                    <div class="flex-auto bg-white p-4 rounded-lg mb-3 shadow-md">

                        <div class="mb-2">

                            <Label class="text-lg tracking-widest rounded-xl border-gray-500">Valor de propiedad</Label>
                        </div>

                        <div>

                            <input type="number" class="bg-white rounded text-sm w-full" wire:model.lazy="modelo_editar.valor_propiedad">

                        </div>

                        <div>

                            @error('modelo_editar.valor_propiedad') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

                @if($flags['numero_inmuebles'])

                    <div class="flex-auto bg-white p-4 rounded-lg mb-3 shadow-md">

                        <div class="mb-2">

                            <Label class="text-lg tracking-widest rounded-xl border-gray-500">Cantidad de inmuebles</Label>
                        </div>

                        <div>

                            <input type="number" class="bg-white rounded text-sm w-full" wire:model.lazy="modelo_editar.numero_inmuebles">

                        </div>

                        <div>

                            @error('modelo_editar.numero_inmuebles') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

                @if($flags['numero_paginas'])

                    <div class="flex-auto bg-white p-4 rounded-lg mb-3 shadow-md">

                        <div class="mb-2">

                            <Label class="text-lg tracking-widest rounded-xl border-gray-500">Número de páginas</Label>
                        </div>

                        <div>

                            <input type="number" min="1" class="bg-white rounded text-sm w-full" wire:model.lazy="modelo_editar.numero_paginas">

                        </div>

                        <div>

                            @error('modelo_editar.numero_paginas') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

                @if($flags['tipo_servicio'])

                    <div class="flex-auto bg-white p-4 rounded-lg mb-3 shadow-md">

                        <div class="mb-2">

                            <Label class="text-lg tracking-widest rounded-xl border-gray-500">Tipo de servicio</Label>
                        </div>

                        <div>

                            <select class="bg-white rounded text-sm w-full" wire:model="modelo_editar.tipo_servicio">

                                <option value="" selected>Seleccione una opción</option>
                                <option value="ordinario" selected>Ordinario</option>
                                <option value="urgente" selected>Urgente</option>
                                <option value="extra_urgente" selected>Extra Urgente</option>

                            </select>

                        </div>

                        <div>

                            @error('modelo_editar.tipo_servicio') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

            </div>

            @if ($flags['observaciones'])

                <div class="flex-auto bg-white p-4 rounded-lg mb-3 shadow-md">

                    <div class="mb-2">

                        <Label class="text-lg tracking-widest rounded-xl border-gray-500">Observaciones</Label>

                    </div>

                    <div>

                        <textarea rows="3" wire:model.lazy="modelo_editar.observaciones" class="bg-white rounded text-sm w-full"></textarea>

                    </div>

                    <div>

                        @error('modelo_editar.observaciones') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            @endif

        </div>

        {{-- Tramtie --}}
        <div>

            {{-- Buscador --}}
            <div class="bg-white p-3 rounded-lg text-center shadow-md mb-3">

                <div class="mb-2">

                    <Label class="text-lg tracking-widest rounded-xl border-gray-500">Buscar trámite</Label>

                </div>

                <div class="flex lg:w-1/2 mx-auto">

                    <input type="number" placeholder="Número de control" min="1" class="bg-white rounded-l text-sm w-full focus:ring-0" wire:model.defer="numero_de_control">

                    <button
                        wire:click="buscarTramite"
                        wire:loading.attr="disabled"
                        wire:target="buscarTramite"
                        type="button"
                        class="bg-blue-400 hover:shadow-lg text-white font-bold px-4 rounded-r text-sm hover:bg-blue-700 focus:outline-none ">

                        <img wire:loading wire:target="buscarTramite" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                        <svg wire:loading.remove wire:target="buscarTramite" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>

                </div>

            </div>

            {{-- Tramite nuevo --}}
            @if($modelo_editar->id_servicio)

                <div class="bg-white p-3 rounded-lg  shadow-md">

                    <h1 class="text-lg tracking-widest rounded-xl border-gray-500 text-center mb-5">Trámite Nuevo</h1>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Categoría:</strong> {{ $this->categoria['nombre'] }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Servicio:</strong> {{ $servicio['nombre'] }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Tipo de servicio:</strong> {{ Str::ucfirst($modelo_editar->tipo_servicio) }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Monto:</strong> {{ $modelo_editar->monto }}</p>

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

                                <p><strong>Distrito:</strong> {{ $modelo_editar->distrito }}</p>

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

                    </div>

                    @if ($modelo_editar->observaciones)

                        <div class="rounded-lg bg-gray-100 py-1 px-2 my-3">

                            <strong>Observaciones:</strong>

                            <p>{{ $modelo_editar->observaciones }}</p>

                        </div>

                    @endif

                    <div class="mt-4 text-right">

                        @if ($editar)

                            <button
                                wire:click="actualizar"
                                wire:loading.attr="disabled"
                                wire:target="actualizar"
                                type="button"
                                class="bg-blue-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded text-sm hover:bg-blue-700 focus:outline-none ">
                                <img wire:loading wire:target="actualizar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                                Actualizar trámite
                            </button>

                        @else

                            <button
                                wire:click="crear"
                                wire:loading.attr="disabled"
                                wire:target="crear"
                                type="button"
                                class="bg-blue-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded text-sm hover:bg-blue-700 focus:outline-none ">
                                <img wire:loading wire:target="crear" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                                Crear nuevo trámite
                            </button>

                        @endif

                    </div>

                </div>

            @endif

            {{-- Tramite encontrado --}}
            @if($tramite)

                <div class="bg-white p-3 rounded-lg  shadow-md">

                    <h1 class="text-lg tracking-widest rounded-xl border-gray-500 text-center mb-5">Trámite</h1>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Número de control:</strong> {{ $tramite->numero_control }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Estado:</strong> {{ Str::ucfirst($tramite->estado) }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Categoría:</strong> {{ $tramite->servicio->categoria->nombre }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Servicio:</strong> {{ $tramite->servicio->nombre }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Tipo de servicio:</strong> {{ Str::ucfirst($tramite->tipo_servicio) }}</p>

                        </div>

                        @if ($tramite->folio_real)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Folio real:</strong> {{ $tramite->folio_real }}</p>

                            </div>

                        @endif

                        @if ($tramite->tomo)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Tomo:</strong> {{ $tramite->tomo }}</p>

                            </div>

                        @endif

                        @if ($tramite->registro)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Registro:</strong> {{ $tramite->registro }}</p>

                            </div>

                        @endif

                        @if ($tramite->distrito)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Distrito:</strong> {{ $tramite->distrito }}</p>

                            </div>

                        @endif

                        @if ($tramite->seccion)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Sección:</strong> {{ $tramite->seccion }}</p>

                            </div>

                        @endif

                        @if ($tramite->tomo_gravamen)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Tomo gravamen:</strong> {{ $tramite->tomo_gravamen }}</p>

                            </div>

                        @endif

                        @if ($tramite->registro_gravamen)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Registro gravamen:</strong> {{ $tramite->registro_gravamen }}</p>

                            </div>

                        @endif

                        @if ($tramite->numero_oficio)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Número de oficio:</strong> {{ $tramite->numero_oficio }}</p>

                            </div>

                        @endif

                        @if ($tramite->numero_propiedad)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Número de propiedad:</strong> {{ $tramite->numero_propiedad }}</p>

                            </div>

                        @endif

                        @if ($tramite->numero_escritura)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Número de escritura:</strong> {{ $tramite->numero_escritura }}</p>

                            </div>

                        @endif

                        @if ($tramite->numero_notaria)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Número de notaría:</strong> {{ $tramite->numero_notaria }}</p>

                            </div>

                        @endif

                        @if ($tramite->nombre_notario)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Nombre del notarío:</strong> {{ $tramite->nombre_notario }}</p>

                            </div>

                        @endif

                        @if ($tramite->valor_propiedad)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Número de escritura:</strong> {{ $tramite->numero_escritura }}</p>

                            </div>

                        @endif

                        @if ($tramite->numero_paginas)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Número de páginas:</strong> {{ $tramite->numero_paginas }}</p>

                            </div>

                        @endif

                        @if ($tramite->numero_inmuebles)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Número de inmuebles:</strong> {{ $tramite->numero_inmuebles }}</p>

                            </div>

                        @endif

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Solicitante:</strong>{{ $tramite->solicitante }} / {{ $tramite->nombre_solicitante }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Monto:</strong> ${{ number_format($tramite->monto, 2) }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Fecha de entrega:</strong> {{ $tramite->fecha_entrega->format('d-m-Y') }}</p>

                        </div>

                        @if ($tramite->limite_de_pago)

                            <div class="rounded-lg bg-gray-100 py-1 px-2">

                                <p><strong>Límite de pago:</strong> {{ $tramite->limite_de_pago }}</p>

                            </div>

                        @endif

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Orden de pago:</strong> {{ $tramite->orden_de_pago }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Linea de captura:</strong> {{ $tramite->linea_de_captura }}</p>

                        </div>

                        <div class="rounded-lg bg-gray-100 py-1 px-2">

                            <p><strong>Registrado por:</strong> {{ $tramite->creadoPor->name }} el {{ $tramite->created_at }}</p>

                        </div>

                    </div>

                    @if ($tramite->observaciones)

                        <div class="rounded-lg bg-gray-100 py-1 px-2 my-3">

                            <strong>Observaciones:</strong>

                            <p>{{ $tramite->observaciones }}</p>

                        </div>

                    @endif

                    <div class="mt-4 text-right">

                        @if ($tramite->estado == 'nuevo')

                            <button
                                wire:click="editar"
                                wire:loading.attr="disabled"
                                wire:target="editar"
                                type="button"
                                class="bg-green-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded text-sm hover:bg-green-700 focus:outline-none ">
                                <img wire:loading wire:target="editar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                                Editar
                            </button>

                            <button
                                wire:click="reimprimir"
                                wire:loading.attr="disabled"
                                wire:target="reimprimir"
                                type="button"
                                class="bg-blue-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded text-sm hover:bg-blue-700 focus:outline-none ">
                                <img wire:loading wire:target="reimprimir" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                                Reimprimir
                            </button>

                            <button
                                wire:click="validarPago"
                                wire:loading.attr="disabled"
                                wire:target="validarPago"
                                type="button"
                                class="bg-red-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded text-sm hover:bg-red-700 focus:outline-none ">
                                <img wire:loading wire:target="validarPago" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                                Validar
                            </button>

                        @endif

                    </div>

                </div>

            @endif

        </div>

    </div>

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

            var url_orden = "{{ route('tramites.orden', '')}}" + "/" + tramite;

            window.open(url_orden, '_blank');

            var url_ticket = "{{ route('tramites.recibo', '')}}" + "/" + tramite;

            window.open(url_ticket, '_blank');

            window.location.reload();

        });

    </script>

@endpush
