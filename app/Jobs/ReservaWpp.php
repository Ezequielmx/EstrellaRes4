<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mike4ip\ChatApi;
use App\Models\Reserva;



class ReservaWpp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $cel;
    public $mens;
    public $reserva_id;

    public function __construct($reserva_id, $cel, $mens)
    {
        $this->cel = $cel;
        $this->mens = $mens;
        $this->reserva_id = $reserva_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.wassenger.com/v1/messages",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\"phone\":\"". $this->cel. "\",\"message\":\"" . $this->mens . "\"}",
          CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Token: 066f35090cd6e1403c8c62cb8fdfbb2cec1afa37f8522d85200245997ad75130f889c44eeb732f4a"
          ],
        ]);
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
    
        curl_close($curl);


        /*
        $api = new ChatApi(
            'yb7lq7jpotu31kgq', 
            'https://api.chat-api.com/instance361534' ); 

        $api->sendPhoneMessage($this->cel, $this->mens);
        */

        $res = Reserva::find($this->reserva_id);
        $res->wppconf=1;
        $res->save();
    }
}
