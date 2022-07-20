<?php
namespace App\Services;

use App\Models\Endereco;

class EnderecoService implements ServiceInterface{
    
    public function controlador($dados){
        $util = new Utilidade();
        $endereco = new Endereco();
        $validator = (bool) false;
        $texto = (string) '';
        if(array_key_exists(0, $dados)){
            if($dados[0] == 'insert' || $dados[0] == 'update'){
                if(array_key_exists(1, $dados)){
                    $texto = (string) $util->descrypt($dados[1]);

                    if($texto != ''){
                        $endereco->set_person_id((int) intval($texto, 10));
                        $validator = (bool) true;
                    }else{
                        $validator = (bool) $this->error_log($util);
                    }
                }else{
                    $validator = (bool) $this->error_log_message($util, 'ID PESSOA');                    
                }

                if(array_key_exists(2, $dados)){
                    $texto = (string) $util->descrypt($dados[2]);

                    if($texto != ''){
                        $endereco->set_description($texto);
                        $validator = (bool) true;
                    }else{
                        $validator = (bool) $this->error_log($util);
                    }
                }else{
                    $validator = (bool) $this->error_log_message($util, 'DESCRIÇÃO');
                }

                if(array_key_exists(3, $dados)){
                    $texto = (string) $util->descrypt($dados[3]);

                    if($texto != ''){
                        $endereco->set_state($texto);
                        $validator = (bool) true;
                    }else{
                        $validator = (bool) $this->error_log($util);
                    }
                }else{
                    $validator = (bool) $this->error_log_message($util, 'ESTADO');
                }

                if(array_key_exists(4, $dados)){
                    $texto = (string) $util->descrypt($dados[4]);

                    if($texto != ''){
                        $endereco->set_city($texto);
                        $validator = (bool) true;
                    }else{
                        $validator = (bool) $this->error_log($util);
                    }
                }else{
                    $validator = (bool) $this->error_log_message($util, 'CIDADE');
                }

                if(array_key_exists(5, $dados)){
                    $texto = (string) $util->descrypt($dados[5]);

                    if($texto != ''){
                        $endereco->set_district($texto);
                        $validator = (bool) true;
                    }else{
                        $validator = (bool) $this->error_log($util);
                    }
                }else{
                    $validator = (bool) $this->error_log_message($util, 'BAIRRO');
                }
                
                if(array_key_exists(6, $dados)){
                    $texto = (string) $util->descrypt($dados[6]);

                    if($texto != ''){
                        $endereco->set_complement($texto);
                        $validator = (bool) true;
                    }else{
                        $validator = (bool) $this->error_log($util);
                    }
                }else{
                    $validator = (bool) $this->error_log_message($util, 'COMPLEMENTO');
                }

                if(array_key_exists(7, $dados)){
                    $texto = (string) $util->descrypt($dados[7]);

                    if($texto != ''){
                        $endereco->set_comments($texto);
                        $validator = (bool) true;
                    }else{
                        $validator = (bool) $this->error_log($util);
                    }
                }else{
                    $validator = (bool) $this->error_log_message($util, 'DESCRIÇÃO COMPLEMENTO');
                }
                
                if(array_key_exists(8, $dados)){
                    $texto = (string) $util->descrypt($dados[8]);

                    if($texto != ''){
                        $endereco->set_status($texto);
                        $validator = (bool) true;
                    }else{
                        $validator = (bool) $this->error_log($util);
                    }
                }else{
                    $validator = (bool) $this->error_log_message($util, 'STATUS');
                }

                if($dados[0] == 'update'){
                    if(array_key_exists(9, $dados)){
                        $texto = (string) $util->descrypt($dados[9]);
                        
                        if($texto != ''){
                            $endereco->set_ender_id((int) intval($texto, 10));
                            $validator = (bool) true;
                        }else{
                            $validator = (bool) $this->error_log($util);
                        }
                    }else{
                        $validator = (bool) $this->error_log_message($util, 'ID ENDEREÇO');
                    }
                }
            }else if($dados[0] == 'find_one'){
                if(array_key_exists(1, $dados)){
                    $texto = (string) $util->descrypt($dados[1]);

                    if($texto != ''){
                        $endereco->set_ender_id((int) intval($texto, 10));
                        $validator = (bool) true;
                    }else{
                        $validator = (bool) $this->error_log($util);
                    }
                }else{
                    $validator = (bool) $this->error_log_message($util, 'ID');
                }

            }else if($dados[0] == 'find_all'){
                if(array_key_exists(1, $dados)){
                    $validator = (bool) true;
                }else{
                    $validator = (bool) $this->error_log_message($util, 'ORDENAÇÃO');
                }
            }

            if($validator == true){
                return $endereco->execute_user_action($dados);
            }
        }else{
            $util->error_message(3);
        }
    }

    public function error_log($util){
        $util->error_message(7);
        return (bool) false;
    }

    public function error_log_message($util, $message){
        $util->error_message(4, $message);
        return (bool) false;
    }
}
?>)