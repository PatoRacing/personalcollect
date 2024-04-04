<div>
    @php
    $classesSpan = "font-bold text-black";
    $classesTitulo = "text-center bg-gray-200 text-black py-2 font-bold rounded uppercase";
    @endphp
    <h2 class="text-center rounded  bg-blue-400 font-bold text-white border-y-2 py-2 uppercase">Ctas. variables c/s anticipo</h2>
    @if($formulario)
        <form class="container p-2 rounded text-left ml-1" wire:submit.prevent='calcularCuotasVariables'>

            <!--Monto negociado -->
            <div>
                <x-input-label for="monto_ofrecido" :value="__('Monto ofrecido a pagar:')" />
                <x-text-input
                    id="monto_ofrecido"
                    placeholder="$ ofrecido a pagar"
                    class="block mt-1 w-full text-sm"
                    type="text"
                    wire:model="monto_ofrecido"
                    :value="old('monto_ofrecido')"
                    />
                <x-input-error :messages="$errors->get('monto_ofrecido')" class="mt-2" />
            </div>

            <!--Anticipo -->
            <div class="mt-2">
                <x-input-label for="anticipo" :value="__('$ anticipo:')" />
                <x-text-input
                    id="anticipo"
                    placeholder="Si no se ofrece = 0"
                    class="block mt-1 w-full text-sm"
                    type="text"
                    wire:model="anticipo"
                    :value="old('anticipo')"
                    />
                <x-input-error :messages="$errors->get('anticipo')" class="mt-2" />
            </div>

            <!--Cant Cuotas 1-->
            <div class="mt-2">
                <x-input-label for="cantidad_de_cuotas_dos" :value="__('Cant. Ctas (Grupo 1):')" />
                <x-text-input
                    id="cantidad_de_cuotas_uno"
                    placeholder="Cant. Ofrecida de ctas."
                    class="block mt-1 w-full text-sm"
                    type="text"
                    wire:model="cantidad_de_cuotas_uno"
                    :value="old('cantidad_de_cuotas_uno')"
                    />
                <x-input-error :messages="$errors->get('cantidad_de_cuotas_uno')" class="mt-2" />
            </div>

            <!--%  Cuotas 1 -->
            <div class="mt-2">
                <x-input-label for="porcentaje_grupo_uno" :value="__('Indica el % que deseas cubrir (Grupo 1)')" />
                <x-text-input
                    id="porcentaje_grupo_uno"
                    placeholder="% a cubrir"
                    class="block mt-1 w-full text-sm"
                    type="text"
                    wire:model="porcentaje_grupo_uno"
                    :value="old('porcentaje_grupo_uno')"
                    />
                <x-input-error :messages="$errors->get('porcentaje_grupo_uno')" class="mt-2" />
            </div>

            <!--Cant Cuotas 2-->
            <div class="mt-2">
                <x-input-label for="cantidad_de_cuotas_dos" :value="__('Cant. Ctas (Grupo 2):')" />
                <x-text-input
                    id="cantidad_de_cuotas_dos"
                    placeholder="Cant. Ofrecida de ctas."
                    class="block mt-1 w-full text-sm"
                    type="text"
                    wire:model="cantidad_de_cuotas_dos"
                    :value="old('cantidad_de_cuotas_dos')"
                    />
                <x-input-error :messages="$errors->get('cantidad_de_cuotas_dos')" class="mt-2" />
            </div>

            <!--%  Cuotas 2 -->
            <div class="mt-2">
                <x-input-label for="porcentaje_grupo_dos" :value="__('Indica el % que deseas cubrir (Grupo 2)')" />
                <x-text-input
                    id="porcentaje_grupo_dos"
                    placeholder="% a cubrir"
                    class="block mt-1 w-full text-sm"
                    type="text"
                    wire:model="porcentaje_grupo_dos"
                    :value="old('porcentaje_grupo_dos')"
                    />
                <x-input-error :messages="$errors->get('porcentaje_grupo_dos')" class="mt-2" />
            </div>

            <!--Cant Cuotas 3-->
            <div class="mt-2">
                <x-input-label for="cantidad_de_cuotas_tres" :value="__('Cant. Ctas (Grupo 3):')" />
                <x-text-input
                    id="cantidad_de_cuotas_tres"
                    placeholder="Cant. Ofrecida de ctas."
                    class="block mt-1 w-full text-sm"
                    type="text"
                    wire:model="cantidad_de_cuotas_tres"
                    :value="old('cantidad_de_cuotas_tres')"
                    />
                <x-input-error :messages="$errors->get('cantidad_de_cuotas_tres')" class="mt-2" />
            </div>

            <!--%  Cuotas 3 -->
            <div class="mt-2">
                <x-input-label for="porcentaje_grupo_tres" :value="__('Indica el % que deseas cubrir (Grupo 3)')" />
                <x-text-input
                    id="porcentaje_grupo_tres"
                    placeholder="% a cubrir"
                    class="block mt-1 w-full text-sm"
                    type="text"
                    wire:model="porcentaje_grupo_tres"
                    :value="old('porcentaje_grupo_tres')"
                    />
                <x-input-error :messages="$errors->get('porcentaje_grupo_tres')" class="mt-2" />
            </div>

            <!--Botones-->
            <div>
                <button class="p-2 mt-2 w-full justify-center bg-blue-800 hover:bg-blue-950 text-white" type="submit">
                    Calcular
                </button>
            </div>
        </form>
    @endif
    @if($montoNoPermitido)
        <h3 class="{{$classesTitulo}}">No se cumplen cumple con las políticas</h3>
        <p class="mt-2">El monto mínimo es
            <span class="{{$classesSpan}}">
                ${{number_format($this->minimoAPagar, 2, ',', '.')}}
            </span>
        </p>
        <button class="bg-red-600 mt-2 w-full text-white rounded hover:bg-red-700 p-2" wire:click="cancelarPropuesta">
            Recalcular
        </button>
    @endif
    @if($negociacionPermitida)
        <h3 class="{{$classesTitulo}}">Detalle de la Propuesta:</h3>
        <p class="mt-2">Monto a Pagar:
            <span class="{{$classesSpan}}">
                ${{number_format($this->monto_ofrecido, 2, ',', '.')}}
            </span>
        </p>
        @if($this->anticipo > 0)
            <p>Anticipo:
                <span class="{{$classesSpan}}">
                    ${{number_format($this->anticipo, 2, ',', '.')}}
                </span>
            </p>
        @endif
        <p>Cant. Ctas. (Grupo 1):
            <span class="{{$classesSpan}}">
                {{$this->cantidad_de_cuotas_uno}} cuotas
            </span>
        </p>
        <p>$ de Cts (Grupo 1):
            <span class="{{$classesSpan}}">
                ${{number_format($this->monto_de_cuotas_uno, 2, ',', '.')}}
            </span>
        </p>
        <p>Cant. Ctas. (Grupo 2):
            <span class="{{$classesSpan}}">
                {{$this->cantidad_de_cuotas_dos}} cuotas
            </span>
        </p>
        <p>$ de Cts (Grupo 2):
            <span class="{{$classesSpan}}">
                ${{number_format($this->monto_de_cuotas_dos, 2, ',', '.')}}
            </span>
        </p>
        @if($this->cantidad_de_cuotas_tres)
            <p>Cant. Ctas. (Grupo 3):
                <span class="{{$classesSpan}}">
                    {{$this->cantidad_de_cuotas_tres}} cuotas
                </span>
            </p>
            <p>$ de Cts (Grupo 3):
                <span class="{{$classesSpan}}">
                    ${{number_format($this->monto_de_cuotas_tres, 2, ',', '.')}}
                </span>
            </p>
        @endif
        <div class="flex gap-1 justify-center mt-2">
            <button class="bg-green-700 p-2 text-white rounded hover:bg-green-800 w-full" wire:click="propuesta">
                Propuesta
            </button>
            <button class="bg-red-600 p-2 text-white rounded hover:bg-red-700 w-full" wire:click="cancelarPropuesta">
                Recalcular
            </button>
        </div>
    @endif
    @if($propuesta)
        <form class="container p-2 rounded text-left ml-1" wire:submit.prevent='guardarPropuesta'>
            <h2 class="{{$classesTitulo}}">Confirmar Propuesta</h2>

            <!--Accion realizada-->
            <div class="mt-2">
                <x-input-label for="accion" :value="__('Acción realizada')" />
                <select
                    id="accion"
                    class="block mt-1 w-full rounded-md border-gray-300"
                    wire:model="accion"
                >
                    <option value="">Seleccionar</option>
                    <option value="Llamada Entrante TP (Fijo)">Llamada Entrante TP (Fijo)</option>
                    <option value="Llamada Saliente TP (Fijo)">Llamada Saliente TP (Fijo)</option>
                    <option value="Llamada Entrante TP (Celular)">Llamada Entrante TP (Celular)</option>
                    <option value="Llamada Saliente TP (Celular)">Llamada Saliente TP (Celular)</option>
                    <option value="Llamada Entrante WP (Celular)">Llamada Entrante WP (Celular)</option>
                    <option value="Llamada Saliente WP (Celular)">Llamada Saliente WP (Celular)</option>
                    <option value="Chat WP (Celular)">Chat WP (Celular)</option>
                    <option value="Mensaje SMS (Celular)">Mensaje SMS (Celular)</option>   

                </select>
                <x-input-error :messages="$errors->get('accion')" class="mt-2" />
            </div>

            <!--Fecha Pago Anticipo-->
            @if($this->anticipo != 0)
                <div class="mt-2">
                    <x-input-label for="fecha_pago_anticipo" :value="__('Fecha de Pago Anticipo:')" />
                        <x-text-input
                            id="fecha_pago_anticipo"
                            class="block mt-1 w-full text-sm"
                            type="date"
                            wire:model="fecha_pago_anticipo"
                            :value="old('fecha_pago_anticipo')"
                            min="{{ now()->toDateString() }}"
                            />
                    <x-input-error :messages="$errors->get('fecha_pago_anticipo')" class="mt-2" />
                </div>
            @endif

            <!--Fecha de Pago-->
            <div class="mt-2">
                <x-input-label for="fecha_pago_cuota" :value="__('Fecha de Pago Cuota:')" />
                    <x-text-input
                        id="fecha_pago_cuota"
                        class="block mt-1 w-full text-sm"
                        type="date"
                        wire:model="fecha_pago_cuota"
                        :value="old('fecha_pago_cuota')"
                        min="{{ now()->toDateString() }}"
                        />
                <x-input-error :messages="$errors->get('fecha_pago_cuota')" class="mt-2" />
            </div>

            <!-- Listado de usuario -->
            <div class="mt-2">
                <x-input-label for="usuario_ultima_modificacion_id" :value="__('Agente asignado')" />
                <select
                    id="usuario_ultima_modificacion_id"
                    class="block mt-1 w-full rounded-md border-gray-300"
                    wire:model="usuario_ultima_modificacion_id">
                    <option value="">Seleccionar</option>
                    @foreach ($usuarios as $usuario)
                        @if ($usuario->id !== 100)
                            <option value="{{$usuario->id}}">{{$usuario->name}} {{$usuario->apellido}}</option>
                        @endif
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('usuario_ultima_modificacion_id')" class="mt-2" />
            </div>

            <!-- Observacion -->
            <div class="mt-2">
                <x-input-label for="observaciones" :value="__('Observaciones')" />
                <textarea
                    wire:model="observaciones"
                    id="observaciones"
                    class="block mt-1 w-full border-gray-300 rounded"
                    type="text"
                    placeholder="Describe brevemente la acción"
                    ></textarea>
                <div class="mt-2 text-sm text-gray-600">
                    Caracteres restantes: {{ 255 - strlen($observaciones) }}
                </div>
                <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
            </div>

            <!--Botones-->
            <div class="flex gap-2 justify-center mt-2">
                <button class="bg-green-700 p-2 text-white rounded hover:bg-green-800 w-full" type="submit">
                    Guardar
                </button>
            </div>
        </form>
    @endif
</div>
