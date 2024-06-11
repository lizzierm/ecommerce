<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Orde;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{

    public function index(){
        $access_token = $this->generateAccessToken();
        $session_token = $this->generateSessionToken($access_token);
        
        // return   $session_token ;

        return view('checkout.index', compact('session_token'));
    }

    public function generateAccessToken(){
        $url_api = config('services.niubiz.url_api').'/api.security/v1/security';
        $user = config('services.niubiz.user');
        $password = config('services.niubiz.password');
        
        $auth = base64_encode($user . ':' . $password);

        return Http::withHeaders([
            'Authorization' => 'Basic ' . $auth,
        ])->get($url_api)
            ->body();
    }

    public function generateSessionToken($access_token){
        $merchant_id = config('services.niubiz.merchant_id');
        // $url_api = config('services.niubiz.url_api')."/api.ecommerce/v2/ecommerce/token/session/{{$merchant_id}}";
        $url_api = config('services.niubiz.url_api') . "/api.ecommerce/v2/ecommerce/token/session/" . $merchant_id;


        $response= Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json',
          
        ])  
        ->post($url_api, [
            'channel' => 'web',
            'amount'=> Cart::instance('shopping')->subtotal() +5,
            'antifraud' => [
                'client_ip' => request()->ip(),
                'merchantDefineData' => [
                    'MDD15' => 'value15',
                    'MDD20' => 'value20',
                    'MDD33' => 'value33',
                ]
            ]
        ])
        ->json();

        return $response['sessionKey'];
    }
    public function paid(Request $request)
    {
        // Generar el token de acceso
        $access_token = $this->generateAccessToken();
        
        // Obtener el ID del comerciante desde la configuración
        $merchant_id = config('services.niubiz.merchant_id');
        
        // Construir la URL de la API de autorización
        $url_api = config('services.niubiz.url_api') . "/api.authorization/v3/authorization/ecommerce/" . $merchant_id;

        // Realizar la solicitud a la API de autorización
        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json',
        ])->post($url_api, [
            'channel' => 'web',
            'captureType' => 'manual',
            'countable' => true,
            'order' => [
                'tokenId' => $request->transactionToken,
                'purchaseNumber' => $request->purchaseNumber,
                'amount' => $request->amount,
                'currency' => 'PEN',
            ],
        ])->json();
            

        // Imprimir la respuesta para verificar su contenido
        // dd($response);
        // return $response;
        
            session()->flash('niubiz',[
                'response' => $response, 
                'purchaseNumber' => $request->purchaseNumber,

            ]);

        // Verificar si la acción fue exitosa y redirigir según corresponda
        if (isset($response['dataMap']) && $response['dataMap']['ACTION_CODE'] == '000') {
            
            $address = Address::where('user_id', auth()->id())
                ->where('default', true)
                ->first();

            Orde::create([
                'user_id' => auth()->id(),
                'content' => Cart::instance('shopping')->content(),
                'address' => $address,
                'payment_id' => $response['dataMap']['TRANSACTION_ID'],
                'total' => Cart::subtotal(),

            ]);

            Cart::destroy();

            return redirect()->route('gracias');
        }
        return redirect()->route('checkout.index');
        // Retornar la respuesta de la API si no fue exitosa
        // return $response;

    }

}
