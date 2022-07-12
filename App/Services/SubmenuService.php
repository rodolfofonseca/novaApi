<?php
namespace App\Services;
use App\Models\Categoria;
class SubmenuService implements ServiceInterface{

    public function controlador($dados)
    {
        $utilidade = new Utilidade;
        $categoria = new Categoria;

        if(array_key_exists(0, $dados)){
            if($dados[0] == 'proximo_codigo'){
                return json_encode((array) ['status' => (string) 'sucesso', 'id_subcategoria' => $categoria->proximo_codigo()], JSON_UNESCAPED_UNICODE);
            }else if($dados[0] == 'cadastrar' || $dados[0] == 'alterar'){
                if(array_key_exists(1, $dados))
                    $categoria->set_id_categoria((int) $dados[1]);
                if(array_key_exists(2, $dados))
                    $categoria->set_id_menu((int) $dados[2]);
                if(array_key_exists(3, $dados))
                    $categoria->set_descricao((string) $dados[3]);
                if(array_key_exists(4, $dados))
                    $categoria->set_aparece_menu((string) $dados[4]);

                if($dados[0] == 'cadastrar')
                    return json_encode((array)['status' => (string) 'sucesso', 'retorno_cadastro' => (bool) $categoria->cadastrar()], JSON_UNESCAPED_UNICODE);
                else
                return json_encode((array)['status' => (string) 'sucesso', 'retorno_alteracao' => (bool) $categoria->alterar()], JSON_UNESCAPED_UNICODE);
            }else if($dados[0] == 'pesquisar_todos'){
                if(array_key_exists(1, $dados)){
                    return json_encode((array) ['status' => (string) 'sucesso', 'dados' => (array) $categoria->pesquisar_todas($dados[1])], JSON_UNESCAPED_UNICODE);
                }
            }else if($dados[0] == 'pesquisar'){
                if(array_key_exists(1, $dados)){
                    $categoria->set_id_categoria((int) $dados[1]);
                    return json_encode((array) ['status' => (string) 'sucesso', 'dados' => (array) $categoria->pesquisar()], JSON_UNESCAPED_UNICODE);
                }
            }
        }else{
            $utilidade->erro_de_sistema('Não foi possível realizar a operacação desejada');
        }
    }
}
?>