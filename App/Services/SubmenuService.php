<?php
namespace App\Services;
use App\Models\Categoria;
class SubmenuService implements ServiceInterface{

    public function controlador($dados)
    {
        $utilidade = new Utilidade;
        $categoria = new Categoria;
        $validator = (bool) false;

        if(array_key_exists(0, $dados)){
           if($dados[0] == 'find'){
            if(array_key_exists(1, $dados)){
                $categoria->set_id_categoria((int) intval($dados[1], 10));
                $validator = (bool) true;
            }else{
                $utilidade->error_message(4, 'ID');
            }

           }else if($dados[0] == 'find_all'){
            if(array_key_exists(1, $dados)){
                $validator = (bool) true;
            }else{
                $utilidade->error_message(4, 'ORDENAÇÃO');
            }
        }

           if($validator == true){
            return json_encode($categoria->execute_user_action($dados), JSON_UNESCAPED_UNICODE);
           }
        }else{
            $utilidade->erro_de_sistema('Não foi possível realizar a operacação desejada');
        }
    }
}
?>