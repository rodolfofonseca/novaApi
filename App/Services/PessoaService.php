<?php
namespace App\Services;
use App\Models\Pessoa;

class PessoaService implements ServiceInterface{
    public function controlador($dados){
        $utilidade = new Utilidade();
        $person = new Pessoa();

        if(array_key_exists(0, $dados)){
            if($dados[0] == 'find_all'){
                if(array_key_exists(1, $dados))
                    return json_encode((array) ['status' => 'success', ['dados' => (array) $person->find_all($dados[1])]], JSON_UNESCAPED_UNICODE);
                else
                    $utilidade->erro_de_sistema('Parâmetro de ordenação não foi encontrado!');
            }else if($dados[0] == 'find'){
                if(array_key_exists(1, $dados)){
                    $person->set_person_id((int) intval($dados[1], 10));
                    return json_encode((array) ['status', 'success', 'dados' => (array) $person->find()]);
                }
            }else if($dados[0] == 'insert' || $dados[0] == 'update'){
                if(array_key_exists(1, $dados))
                    $person->set_name((string) $dados[1]);
                else
                    $utilidade->erro_de_sistema('É necessário informar o nome do cliente');
                
                if(array_key_exists(2, $dados))
                    $person->set_cpf((string) $dados[2]);
                else
                $utilidade->erro_de_sistema('É necessário informar o CPF do cliente');
                
                if(array_key_exists(3, $dados))
                    $person->set_genre((string) $dados[3]);
                else
                $utilidade->erro_de_sistema('É necessário informar o gênero do cliente');

                if(array_key_exists(4, $dados))
                    $person->set_person_id((int) intval($dados[4], 10));
                else
                    $utilidade->erro_de_sistema('É necessário informar o ID do cliente');
                
                if($dados[0] == 'insert' && $dados[4] == 0)
                    return json_encode((array) ['status' => (string) 'success', 'person_id' => (int) $person->insert()], JSON_UNESCAPED_UNICODE);
                else if($dados[0] == 'update' && $dados[4] != 0)
                    return json_encode((array) ['status' => (string) 'success', 'dados' => (bool) $person->update()], JSON_UNESCAPED_UNICODE);
                else
                    $utilidade->erro_de_sistema('Algum dos parâmetros necessário para realizar a operação não está preenxido conforme documentação necessária!');
            }
        }else
            $utilidade->erro_de_sistema('Não foi possível realizar a operação desejada!');
    }
}
?>