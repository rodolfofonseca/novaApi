<?php
namespace App\Services;
class Utilidade{
    public function erro_de_sistema($mensagem){
        http_response_code(404);
        echo json_encode(['status' => 'error', 'data' => (string) $mensagem], JSON_UNESCAPED_UNICODE);
        exit;
    }
}
?>