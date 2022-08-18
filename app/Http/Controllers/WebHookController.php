<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebHookController extends Controller
{
    public function handle(Request $request)
  {     
    $cel = $request->data['fromNumber'];
        
    $mens = "Hola!  \\n\\n";
    $mens.= "comunicarte por:\\n\\n";
    $mens.= "*Facebook* \\n";
    $mens.= "👉  https://m.me/EstrellaDelPlataPlanetarioMovil\\n\\n";
    $mens.= "*Instagram* \\n";
    $mens.= "👉  https://www.instagram.com/estrelladelplata\\n";
    $mens.= "➖➖➖➖➖➖➖\\n";
    $mens.= "Gracias";

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.wassenger.com/v1/messages",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"phone\":\"". $cel. "\",\"message\":\"" . $mens . "\"}",
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Token: 066f35090cd6e1403c8c62cb8fdfbb2cec1afa37f8522d85200245997ad75130f889c44eeb732f4a"
    ],
    ]);

    $response = curl_exec($curl);

  }
}
