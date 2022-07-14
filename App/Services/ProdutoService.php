<?php
namespace App\Services;
use App\Models\Produto;
class ProdutoService{
    public function controlador($dados){
        $utilidade = new Utilidade();
        $produto = new produto();
        if(array_key_exists(0, $dados)){
            if($dados[0] == 'next_codigo')
                return json_encode((array) ['status' => (string) 'sucesso', 'id_produto' => (int) $produto->next_id()]);
        
            // if($dados[0] == 'cadastrar' || $dados[0] == 'alterar'){
            //     if(array_key_exists(1, $dados))
            //         $menu->set_id_menu((int) $dados[1]);
                
            //     if(array_key_exists(2, $dados))
            //         $menu->set_descricao((string) $dados[2]);
                
            //     if(array_key_exists(3, $dados))
            //         $menu->set_status($dados[3]);
            
            //     if($dados[0] == 'cadastrar')
            //         return json_encode((array) ['status' => (string) 'sucesso', 'retorno_cadastro' => (bool) $menu->cadastrar()], JSON_UNESCAPED_UNICODE);
            //     else
            //         return json_encode((array) ['status' => (string) 'sucesso', 'retorno_alteracao' => (bool) $menu->alterar()], JSON_UNESCAPED_UNICODE);
            // }
        
            if($dados[0] == 'find_all')
                if(array_key_exists(1, $dados))
                    return json_encode((array) ['status' => (string) 'sucesso', 'dados' => (array) $produto->find_all($dados[1])], JSON_UNESCAPED_UNICODE);
                else
                    $utilidade->erro_de_sistema('É necessário possuir o prâmetro de ordenação');
        
            if($dados[0] == 'find'){
                if(array_key_exists(1, $dados)){
                    $produto->set_id_produto((int) $dados[1]);
                    return json_encode((array) ['status' => (string) 'sucesso', 'dados' => (array) $produto->find()], JSON_UNESCAPED_UNICODE);
                }else{
                    $utilidade->erro_de_sistema('É necessário possuir o parâmetro ID');
                }
            }
        }else{
            $utilidade->erro_de_sistema('Não foi possível realizar a operação desejada!');
        }
    } 
}
?>