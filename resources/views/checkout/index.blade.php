<x-app-layout>

    <div class="-mb-16 text-gray-700" x-data="{
    pago: 1
   }">

        <div class="grid grid-cols-1 lg:grid-cols-2">

            <div class="col-span-1 bg-white">
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pr-8 sm:pl-6 lg:pl-8 ml-auto">
                    <p>
                    <h1 class="text-2xl font-semibold mb-2">
                        Pagos
                    </h1>

                    <div class="shadow rounded-lg overflow-hidden border border-gray-400 ">
                        <ul class="divide-y divide-gray-400">
                            <li>
                                <label class="p-4 flex items-center ">
                                    <!-- Modificado aquí -->
                                    <input type="radio" x-model="pago" value="1">

                                    <span class="ml-2">
                                        Targeta de débito / crédito
                                        <!-- Modificado aquí -->
                                    </span>

                                    <img class="h-6 ml-auto" src="https://codersfree.com/img/payments/credit-cards.png"
                                        alt="">
                                </label>

                                <div class="p-4 bg-gray-100 text-center border-t border-gray-400" x-show="pago == 1">
                                    <i class="fa-regular fa-credit-card text-9xl"></i>

                                    <p class="mt-2">
                                        Luego de hacer click al "Pagar ahora", se abrirá una nueva ventana para
                                        completar tu compra de forma segura.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <label class="p-4 flex items-center">
                                    <input type="radio" x-model="pago" value="2">

                                    <span class="ml-2">
                                        Deposito Bancario o Yape
                                    </span>

                                    <img class="h-6 ml-auto" src="{{ asset('img/yape1.png') }}" alt="">

                                </label>

                                <div class="p-4 bg-gray-100 flex justify-center border-t border-gray-400 " x-cloak
                                    x-show="pago == 2">

                                    <div>
                                        <p>1. Pago por deposito o trasnferencia bancaria</p>
                                        <p>- Banco Unión :100000-0154220-21</p>
                                        <p>- Razon social: Tienda Online Bella_Butique</p>
                                        <p>- RUC: 201588424585</p>
                                        <p>2. Pago por Yape</p>
                                        <p>- Yape al número 69283498 (Bella_Butique S.R.L)</p>
                                        <p>Enviar el comprobante de pago a 69283498</p>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>


                    </p>
                </div>
            </div>

            <div class="col-span-1">
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pl-8 sm:pr-6 lg:pr-8 mr-auto">
                    <ul class="space-y-4 mb-4">

                        @foreach (Cart::instance('shopping')->content() as $item)

                        <li class="flex items-center space-x-4">

                            <div class="flex-shrink-0 relative">
                                <img class="h-16 aspect-square" src="{{$item->options->image}}" alt="">

                                <div
                                    class=" flex justify-center items-center h-6 w-6 bg-gray-900 bg-opacity-70 rounded-full absolute -right-2 -top-2">
                                    <span class="text-white font-semibold">
                                        {{$item->qty}}
                                    </span>
                                </div>
                            </div>

                            <div class="flex-1">
                                <p>
                                    {{$item->name}}
                                </p>
                            </div>

                            <div class="flex-shrink-0 ">
                                <p>
                                    Bs. {{$item->price}}
                                </p>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <div class="flex justify-between">
                        <p>
                            Subtotal:
                        </p>

                        <p>
                            Bs. {{Cart::instance('shopping')->subtotal()}}
                        </p>

                    </div>

                    <div class="flex justify-between">
                        <p>
                            Precio de envío:
                            <i class="fas fa-info-circle" title="El precio de envio es de 5 Bs."></i>
                        </p>

                        <p>
                            Bs. 5.00
                        </p>
                    </div>

                    <hr class="my-3">

                    <div class="flex justify-between mb-4" <p class="text-lg font-semibold">
                        <strong>Total</strong>
                        </p>

                        <strong>Bs. {{Cart::instance('shopping')->subtotal() + 5}}</strong>

                    </div>

                    <div>
                        <button onclick="VisanetCheckout.open()" class=" btn btn-purple w-full">
                            Finalizar pedido <i class="fa-solid fa-truck-fast"></i>
                        </button>
                    </div>
                    @if (session('niubiz'))
                        @php
                            $niubiz = session('niubiz');

                            $response = $niubiz['response'];
                            $purchaseNumber = $niubiz['purchaseNumber'];

                        @endphp

                        @isset($response["data"])
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-pink-300 dark:text-red-400 mt-8" 
                                role="alert">
                               
                                <P class="mb-4">
                                    {{$response['data']['ACTION_DESCRIPTION']}}
                                </p>

                                <P class="mb-4">
                                    <b>
                                        Numero de pedido
                                        {{$purchaseNumber}}
                                    </b>
                                    
                                </P>

                                <p>
                                    <b>
                                        Fecha y hora de pedido
                                        {{ now()->createFromFormat('ymdHis', $response['data']['TRANSACTION_DATE'])->format('d-m-Y H:i:s')}}
                                    </b>
                                </p>
                                    @isset($response['data']['CARD'])
                                        <P>
                                            <b>Tarjeta:</b>
                                            {{$response['data']['CARD']}}({{$response['data']['BRAND']}})
                                        </p>
                                    @endisset
                                
                            </div>
                        @endisset
                    @endif

                </div>
            </div>

        </div>
    </div>

    @push('js')
            <script type="text/javascript" src="{{config('services.niubiz.url_js')}}">
            </script>

            <script type="text/javascript">

                    document.addEventListener('DOMContentLoaded', function(){
                         
                        let purchasenumber = Math.floor(Math.random() *100000);
                        let  amount = {{Cart::instance('shopping')->subtotal() +5}};

                        VisanetCheckout.configure({
                            sessiontoken: '{{$session_token}}',
                            channel: 'web',
                            merchantid: "{{config('services.niubiz.merchant_id')}}", // Corregido aquí
                            // numero de orden
                            purchasenumber: purchasenumber,
                            amount: amount,
                            expirationminutes: '20',
                            timeouturl: 'about:blank',
                            // cambiamos el logotipo de la empresa
                            merchantlogo: 'img/comercio.png',
                            // color del formulario
                            formbuttoncolor: '#000000',
                            // redirige después del pago
                            action: "{{route('checkout.paid')}}?amount=" + amount + "&purchaseNumber=" + purchasenumber,
                            complete: function(params) {
                                alert(JSON.stringify(params));
                            }
                        });
                    });

                //     function openForm() {
                   
                //     VisanetCheckout.open();
                // }
            </script>

    @endpush

</x-app-layout>