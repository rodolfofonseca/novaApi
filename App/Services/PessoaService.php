<?php
namespace App\Services;
use App\Models\Pessoa;

class PessoaService implements ServiceInterface{
    public function controlador($dados){
        $utilidade = new Utilidade();
        $person = new Pessoa();
        $validator = (bool) false;
        $texto = (string) '';

        if(array_key_exists(0, $dados)){
            if($dados[0] == 'insert' || $dados[0] == 'update'){
                if(array_key_exists(1, $dados)){
                    $texto = (string) $utilidade->descrypt($dados[1]);
                    
                    if($texto != ''){
                        $person->set_name((string) $texto);
                        $validator = (bool) true;
                    }else{
                        $validator = (bool) false;
                        $utilidade->error_message(7);
                    }
                    
                }else{
                    $utilidade->error_message(4, 'NOME');
                    $validator = (bool) false;
                }

                if(array_key_exists(2, $dados)){
                    $texto = (string) $utilidade->descrypt($dados[2]);

                    if($texto != ''){
                        $person->set_cpf((string) $texto);
                        $validator = (bool) true;
                    }else{
                        $utilidade->error_message(7);
                        $validator = (bool) false;
                    }
                    
                }else{
                    $utilidade->error_message(4, 'CPF');
                    $validator = (bool) false;
                }

                if(array_key_exists(3, $dados)){
                    $texto = (string) $utilidade->descrypt($dados[3]);

                    if($texto != ''){
                        $person->set_genre((string) $texto);
                        $validator = (bool) true;
                    }else{
                        $utilidade->error_message(7);
                        $validator = (bool) false;
                    }
                    
                }else{
                    $utilidade->error_message(4, 'GÊNERO');
                    $validator = (bool) false;
                }

                if($dados[0] == 'update'){
                    if(array_key_exists(4, $dados)){
                        $person->set_person_id((int) intval($dados[4], 10));
                        $validator = (bool) true;
                    }else{
                        $utilidade->error_message(4, 'ID');
                    }
                }
            }else if($dados[0] == 'find_one'){
                if(array_key_exists(1, $dados)){
                    $person->set_person_id((int) intval($dados[1], 10));
                    $validator = (bool) true;
                }else{
                    $utilidade->error_message(4, 'ID');
                    $validator = (bool) false;
                }
            }else if($dados[0] == 'find_all'){
                if(array_key_exists(1, $dados)){
                    $validator = (bool) true;
                }else{
                    $utilidade->error_message(4, 'ORDENAÇÃO');
                }
            }

            if($validator == true){
                return $person->execute_user_action($dados);
            }
        }else
            $utilidade->erro_de_sistema('Não foi possível realizar a operação desejada!');
    }
}
?>