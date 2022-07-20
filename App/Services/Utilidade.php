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

    /**
     * Função responsável por retornar as mensagens de erro que é apresentada ao usuário do sistema.
     * @param (int) $error_id
     * @param (string) $description
     * @return (json) de erro 
     */
    public function error_message($error_id, $description = ''){
        $mensagem = (string) '';

        $this->erro();
        
        if($error_id == 0){
            $mensagem = (string) 'Não foi passada nenhuma URL compatível com a API!';
        }else if($error_id == 1){
            $mensagem = (string) 'Chamada de API inválida!';
        }else if($error_id == 2){
            $mensagem == (string) 'URL não encontrada!';
        }else if($error_id == 3){
            $mensagem = (string) 'Não foi possível realizar a operação desejada!';
        }else if($error_id == 4){
            $mensagem = (string) 'É necessário possuir o parâmetro: '.$description;
        }else if($error_id == 5){
            $mensagem = (string) 'É necessário possuir um parâmetro de ordenação do tipo TRUE ou FALSE';
        }else if($error_id == 6){
            $mensagem = (string) 'ESTAMOS EM MANUTENÇÃO!';
        }else if($error_id == 7){
            $mensagem = (string) 'Erro de descriptografia, ou a informação não veio com a criptografia correta!';
        }
            
        echo json_encode(['status' => (string) 'error', 'data' => (string) $mensagem], JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Função responsável por descriptogradas as informações que vem pela api.
     * @param (string) $text com a informação criptografada
     * @return (string) $informação descriptografada.
     */
    public function descrypt($text){
        $resultado = (int) $this->calcular_para_criptografar();
        
        for($contador = 0; $contador <= $resultado; $contador++){
            $text = (string) base64_decode((string) $text);
        }
    
        return (string) $text;
    }

    /**
     * Função responsável por realizar a criptografia que é utilizada em todo o sistema.
     * @param (string) $text com a informação a ser criptografada.
     * @return (string) $informação criptografada.
     */
    public function encripty($text){
        $resultado = (int) $this->calcular_para_criptografar();

        for($contador = 0; $contador <= $resultado; $contador++){
            $text = (string) base64_encode((string) $text);
        }
        
        return (string) $text;
    }

    private function calcular_para_criptografar(){
        $dia = (int) date('d');
        $mes = (int) date('m');
        $ano = (int) date('Y');
    
        $dia_divisao = (float) $dia/3;
        $mes_divisao = (float) $mes/3;
        $ano_divisao = (float) $ano/1000;
        $somatorio = (float) (($dia_divisao+$mes_divisao)+$ano_divisao);
        $resultado = (int) intval(round($somatorio, 0, PHP_ROUND_HALF_UP), 10);

        return (int) $resultado;
    }

    /**
     * Função responsável por verificar a chave de um array e criptografar essa chave caso ela exista.
     * @param (array) $array que deverá ser verificado
     * @param (string/int) $key chave que deve ser analizada dentro do array
     * @return (string) retorno da criptografia 
     */
    public function encripty_array($array, $key){
        $text = (string) '';

        if(array_key_exists($key, $array)){
            $text = (string) $this->encripty((string) $array[$key]);
        }

        return (string) $text;
    }

    /**
     * Função responsável por exibir a mensagem de erro e retornar o validator.
     * @return (bool) false
     */
    public function error_log(){
        $this->error_message(7);
        return (bool) false;
    }

    /**
     * Função responsável por exibir a mensagem de erro e retornar o validador
     * @param (string) $mensagem a ser exibida
     * @return (bool) false
     */
    public function error_log_message($message){
        $this->error_message(4, $message);
        return (bool) false;
    }
}
?>