<div class="border p-1 mt-1">
    <livewire:buscar-pagos-vigentes />
    @if($pagosExcedentes->count())
        <div class="container mx-auto grid grid-cols-1 justify-center md:grid-cols-2 lg:grid-cols-3 gap-2 p-1">
            @foreach ($pagosExcedentes as $pagoExcedente)
                <div class="border border-gray-700 p-1 overflow-y-auto" style="max-height: 450px">
                    <p class="bg-indigo-600 mb-1 text-white uppercase py-1 text-center block">
                        {{$pagoExcedente->acuerdo->propuesta->deudorId->nombre}}
                    </p>
                    <!--Detalle de la Operación-->
                    <x-subtitulo-h-cuatro>
                        Detalle de la Operación:
                    </x-subtitulo-h-cuatro>
                    <div class="p-1">
                        <p class="mt-1">Cliente:
                            <span class="font-bold">
                                {{ $pagoExcedente->acuerdo->propuesta->operacionId->clienteId->nombre }}
                            </span>
                        </p>
                        <p>DNI Deudor:
                            <span class="font-bold">
                                {{ $pagoExcedente->acuerdo->propuesta->deudorId->nro_doc }}
                            </span>
                        </p>
                        <p>CUIL Deudor:
                            @if($pagoExcedente->acuerdo->propuesta->deudorId->cuil)
                                <span class="font-bold">
                                    {{ $pagoExcedente->acuerdo->propuesta->deudorId->cuil}}
                                </span>
                            @else
                                -
                            @endif
                        </p>
                        <p>Operación:
                            <span class="font-bold">
                                {{ $pagoExcedente->acuerdo->propuesta->operacionId->operacion }}
                            </span>
                        </p>
                        <p>Segmento:
                            <span class="font-bold">
                                @if ( $pagoExcedente->acuerdo->propuesta->operacionId->segmento )
                                    {{ $pagoExcedente->acuerdo->propuesta->operacionId->segmento }}
                                @else
                                    <span class="text-red-600 font-bold">
                                        Sin datos
                                    </span>
                                @endif
                            </span>
                        </p>
                        <p>Producto:
                            <span class="font-bold">
                                {{ $pagoExcedente->acuerdo->propuesta->operacionId->productoId->nombre }}
                            </span>
                        </p>
                    </div>
                    <!--Detalle del Pago-->
                    <x-subtitulo-h-cuatro>
                        Detalle de la Cuota:
                    </x-subtitulo-h-cuatro>
                    <div class="p-1">
                        <p>Responsable:
                            <span class="font-bold">
                                {{$pagoExcedente->acuerdo->propuesta->operacionId->usuarioAsignado->name}}
                                {{$pagoExcedente->acuerdo->propuesta->operacionId->usuarioAsignado->apellido}}
                            </span>
                        </p>
                        <p>$ de Cuota Acordado:
                            <span class="font-bold">
                                ${{ number_format($pagoExcedente->monto_acordado, 2, ',', '.') }}
                            </span>
                        </p>
                        <p>Vencimiento Cta: 
                            <span class="font-bold">
                                {{ \Carbon\Carbon::parse($pagoExcedente->vencimiento_cuota)->format('d/m/Y') }}
                            </span>
                        </p>
                        <p>Nro. Cuota: 
                            <span class="font-bold">
                                {{$pagoExcedente->nro_cuota}}
                            </span>
                        </p>
                    </div>
                    <!--botones-->
                    <div class="mt-1 grid grid-cols-2 justify-center gap-1 text-sm text-center text-white">
                        @if($pagoExcedente->concepto_cuota == 'Cancelación')
                            <p class="p-2 bg-blue-800">
                                <span class="font-bold">
                                    Cancelación
                                </span>
                            </p>
                        @elseif($pagoExcedente->concepto_cuota == 'Cuota')
                            <p class="p-2 bg-green-600">
                                <span class="font-bold">
                                    Cuotas Fijas
                                </span>
                            </p>
                        @elseif($pagoExcedente->concepto_cuota == 'Anticipo')
                            <p class="p-2 bg-orange-600">
                                <span class="font-bold">
                                    Anticipo
                                </span>
                            </p>
                        @else
                            <p class="p-2 bg-indigo-600">
                                <span class="font-bold">
                                    Excedente
                                </span>
                            </p>
                        @endif
                        @if($pagoExcedente->cuotasPreviasGestionadas())
                            <a href="{{ route('gestion.cuota', ['pago' => $pagoExcedente->id]) }}"
                                class="text-white block rounded bg-blue-800 py-2 hover:bg-blue-900">
                                Gestionar
                            </a>
                        @else
                            <p class="text-white block rounded bg-gray-500 py-2 cursor-not-allowed"
                                title="Hay una cuota previa para gestionar">
                                Gestionar
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="font-bold text-center pt-3">
            No hay Excedentes
        </p>
    @endif
    @if($pagosExcedentesTotales >= 30)
        <div class="p-2">
            {{$pagosVigentes->links('')}}
        </div>
    @endif
</div>