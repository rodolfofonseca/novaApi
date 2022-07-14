<?php
namespace App\Services;

use App\Models\Endereco;

class EnderecoService implements ServiceInterface{
    
    public function controlador($dados){
        $utilidade = new Utilidade();

        if(array_key_exists(0, $dados)){
            $endereco = new Endereco();

            if($dados[0] == 'insert' || $dados[0] == 'update'){
                if(array_key_exists(1, $dados))
                    $endereco->set_description((string) $dados[1]);
                else
                    $utilidade->error_message(4, 'DESCRIÇÃO');
                
                if(array_key_exists(2, $dados))
                    $endereco->set_state((string) $dados[2]);
                else
                    $utilidade->error_message(4, 'ESTADO');
                
                if(array_key_exists(3, $dados))
                    $endereco->set_city($dados[3]);
                else
                    $utilidade->error_message(4, 'CIDADE');
                
                if(array_key_exists(4, $dados))
                    $endereco->set_district((string) $dados[4]);
                else
                    $utilidade->error_message(4, 'BAIRRO');
                
                if(array_key_exists(5, $dados))
                    $endereco->set_complement((string) $dados[5]);
                else
                    $utilidade->error_message(4, 'RUA / NÚMERO');
                
                if(array_key_exists(6, $dados))
                    $endereco->set_comments((string) $dados[6]);
                else
                    $utilidade->error_message(4, 'COMPLEMENTO');
                
                if(array_key_exists(7, $dados))
                    $endereco->set_status((string) $dados[7]);
                else
                    $utilidade->error_message(4, 'STATUS');

                if($dados[0] == 'update'){
                    if(array_key_exists(8, $dados))
                        $endereco->set_ender_id((int) intval($dados[8], 10));
                    else
                        $utilidade->error_message(4, 'ID');

                    return $endereco->execute_user_action($dados[0]);
                }else if($dados[0] == 'insert')
                    return $endereco->execute_user_action($dados[0]);

            }else if($dados[0] == 'find'){
                if(array_key_exists(1, $dados))
                    $endereco->set_ender_id((int) intval($dados[1], 10));
                else
                    $utilidade->error_message(4, 'ID');
                
                return $endereco->execute_user_action($dados[0]);
            }else if($dados[0] == 'find_all'){
                if(array_key_exists(1, $dados))
                    return $endereco->execute_user_action($dados[0], $dados[1]);
                else
                    $utilidade->error_message(5);
            }

        }else{
            $utilidade->error_message(3, '');
        }
    }
}
?>)