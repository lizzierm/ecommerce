<x-app-layout>

    <div class="max-w-3xl mx-auto pt-12">
        <img class="w-full" src="img/gracias3.PNG" alt="Descripción de la imagen">

        @if (session('niubiz'))
            @php
                $response = session('niubiz')['response'];

            @endphp

            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-300 dark:text-green-600 mt-8" role="alert">
                {{-- eso muestra developer paiment --}}

                <p class="mt-4">
                    {{$response['dataMap']['ACTION_DESCRIPTION']}}
                </p>

                <P>
                    <b>Numero de pedido:</b>
                    {{$response['order']['purchaseNumber']}}
                </P>

                <p>
                    <b>Fecha y hora del pedido</b>
                    {{
                        now()->createFromFormat('ymdHis', $response['dataMap']['TRANSACTION_DATE'])->format('d-m-Y H:i:s')
                    }}
                </p>

                <p>
                    <b>Tarjeta:</b>
                    {{$response['dataMap']['CARD']}}({{$response['dataMap']['BRAND']}})
                </p>

                <P>
                    <b>Total:</b>
                 Bs. {{$response['order']['amount']}}  
                  {{-- {{$response['order']['currency']}}  --}}
                </P>

            </div>

        @endif
    </div>
    

</x-app-layout>
