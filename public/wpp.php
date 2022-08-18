<?php
$pers = [['Marcos', '5491165765572'], ['Juan', '5492964531971'], ['Charly', '5491157060104'], ['Facundo', '5491160208707']];
//$pers = [['Ezeqeuiel', '5491160208707'], ['Facundo', '5491160208707']];

$token = 'd9k99v4iedtz7p7k';
$instanceId = '343483';
$url = 'https://api.chat-api.com/instance'.$instanceId.'/message?token='.$token;
$name = '';
$cel = '';
foreach ($pers as $per) {
    $name = $per[0];
    $cel = $per[1];
    $mens= '';

    for ($i=1; $i<6  ; $i++) { 
        switch ($i) {
            case 1:
                $mens = 'Hola ' . $name . '!';
                break;
            case 5:
                $mens = '*A que hora pinta?*';
                break;
            default:
                $mens = 'Mensaje Test Nº ' . $i-1;
                break;
        }

        $data = [
            'phone' => $cel, // Receivers phone
            'body' => $mens, // Message
            ];
            $json = json_encode($data); // Encode data to JSON
            // URL for request POST /message


            // Make a POST request
            $options = stream_context_create(['http' => [
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $json
                ]
            ]);
        // Send a request
        $result = file_get_contents($url, false, $options);
        var_dump($result);
    }
}