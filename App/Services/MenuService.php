<?php
namespace App\Services;
use App\Models\Menu;
class MenuService{
    public function controlador($dados){
        $utilidade = new Utilidade();
        $menu = new Menu();
        if(array_key_exists(0, $dados)){
            if($dados[0] == 'proximo_codigo')
                return json_encode((array) ['status' => (string) 'sucesso', 'id_categoria' => (int) $menu->proximo_codigo()], JSON_UNESCAPED_UNICODE);
        
            if($dados[0] == 'cadastrar' || $dados[0] == 'alterar'){
                if(array_key_exists(1, $dados))
                    $menu->set_id_menu((int) $dados[1]);
                
                if(array_key_exists(2, $dados))
                    $menu->set_descricao((string) $dados[2]);
                
                if(array_key_exists(3, $dados))
                    $menu->set_status($dados[3]);
            
                if($dados[0] == 'cadastrar')
                    return json_encode((array) ['status' => (string) 'sucesso', 'retorno_cadastro' => (bool) $menu->cadastrar()], JSON_UNESCAPED_UNICODE);
                else
                    return json_encode((array) ['status' => (string) 'sucesso', 'retorno_alteracao' => (bool) $menu->alterar()], JSON_UNESCAPED_UNICODE);
            }
        
            if($dados[0] == 'pesquisar_todos')
                return json_encode((array) ['status' => (string) 'sucesso', 'dados' => (array) $menu->pesquisar_menu_todos($dados[1])], JSON_UNESCAPED_UNICODE);
        
            if($dados[0] == 'pesquisar'){
                $menu->set_id_menu((int) $dados[1]);
                return json_encode((array) ['status' => (string) 'sucesso', 'dados' => (array) $menu->pesquisar_menu()], JSON_UNESCAPED_UNICODE);
            }
        }else{
            $utilidade->erro_de_sistema('Não foi possível realizar a operação desejada!');
        }
    } 
}
?>