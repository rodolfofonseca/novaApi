<?php
namespace App\Services;
class Utilidade{
    public function erro_de_sistema($mensagem){
        http_response_code(404);
        echo json_encode(['status' => 'error', 'data' => (string) $mensagem], JSON_UNESCAPED_UNICODE);
        exit;
    }

    private function erro(){
        http_response_code(404);
    }

    public function error_message($error_id, $description = ''){
        $mensagem = (string) '';

        $this->erro();
        
        if($error_id == 0)
            $mensagem = (string) 'Não foi passada nenhuma URL compatível com a API!';
        else if($error_id == 1)
            $mensagem = (string) 'Chamada de API inválida!';
        else if($error_id == 2)
            $mensagem == (string) 'URL não encontrada!';
        else if($error_id == 3)
            $mensagem = (string) 'Não foi possível realizar a operação desejada!';
        else if($error_id == 4)
            $mensagem = (string) 'É necessário possuir o parâmetro: '.$description;
        else if($error_id == 5)
            $mensagem = (string) 'É necessário possuir um parâmetro de ordenação do tipo TRUE ou FALSE';
        else if($error_id == 6)
            $mensagem = (string) 'ESTAMOS EM MANUTENÇÃO!';
        
        echo json_encode(['status' => (string) 'error', 'data' => (string) $mensagem], JSON_UNESCAPED_UNICODE);
        exit;
    }
}
?>