<?php

namespace App\Jobs;

use App\View\Components\alert1;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mike4ip\ChatApi;

class AvisoFuncion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $cel;
    public $mens;

    public function __construct($cel, $mens)
    {
        $this->cel = $cel;
        $this->mens = $mens;
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

        $api->sendPhoneMessage($this->cel, $this->mens);*/
    }
}
