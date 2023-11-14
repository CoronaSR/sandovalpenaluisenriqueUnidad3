<?php
//Token de acceso (generado en la plataforma de OpenAI)
const API_KEY = "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";

if (!empty($_POST['Peticion'])){
    $prompt = $_POST['Peticion']; //mensaje ingresado

    function getCompletion($prompt) {
        $url = "https://api.openai.com/v1/chat/completions"; //url del web service
        $data = [
            "model" => "gpt-3.5-turbo", // modelo de IA que utilizaremos
            "messages" => [["role" => "user", "content" => $prompt]] //arreglo con datos del mensaje
        ];
        
        //configuracion de de opciones para la solicitud HTTP
        $options = [
            "http" => [
                "header" => "Content-type: application/json\r\n" .
                    "Authorization: Bearer " . API_KEY,
                    "method" => "POST",
                    "content" => json_encode($data)
                    ]
                ];
                
                // Creacion del contexto de flujo con las opciones de configuración
                $context = stream_context_create($options);
                // Se realiza la solicitud HTTP POST utilizando file_get_contents
                $result = file_get_contents($url, false, $context);
                
                if ($result === FALSE) {
                    return false; // Manejo del error
                }
                // Decodificar el resultado JSON en un array asociativo
                return json_decode($result, true);
            }
            
            $response = getCompletion($prompt); //respuesta
            echo json_encode($response);
} else {
    echo 1;
}
?>
