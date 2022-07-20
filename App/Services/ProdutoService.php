<?php
namespace App\Services;
use App\Models\Produto;
class ProdutoService{
    public function controlador($dados){
        $utilidade = new Utilidade();
        $produto = new produto();
        $validator = (bool) false;
        if(array_key_exists(0, $dados)){
            if($dados[0] == 'find_one'){
                if(array_key_exists(1, $dados)){
                    $produto->set_id_produto((int) intval($dados[1], 10));
                    $validator = (bool) true;
                }else{
                    $utilidade->error_message(4, 'ID');
                }
            }else if($dados[0] == 'find_all'){
                if(array_key_exists(1, $dados)){
                    $validator = (bool) true;
                }else{
                    $utilidade->error_message(4, 'ORDENAÇÃO');
                    $validator = (bool) false;
                }
            }else if($dados[0] == 'find_all_category'){
                if(array_key_exists(1, $dados)){
                    $validator = (bool) true;
                }else{
                    $utilidade->error_message(4, 'ORDENAÇÃO');
                    $validator = (bool) false;
                }

                if(array_key_exists(2, $dados)){
                    $validator = (bool) true;
                }else{
                    $utilidade->error_message(4, 'CATEGORIA ID');
                    $validator = (bool) false;
                }
            }else{
                $utilidade->error_message(3);
            }

            if($validator == true){
                return $produto->execute_user_action($dados);
            }
        }else{
            $utilidade->error_message(3);
        }
    }
}
?>