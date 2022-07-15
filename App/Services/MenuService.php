<?php
namespace App\Services;
use App\Models\Menu;
class MenuService{
    public function controlador($dados){
        $utilidade = new Utilidade();
        $menu = new Menu();
        $validator = (bool) false;
        if(array_key_exists(0, $dados)){
            if($dados[0] == 'find'){
                if(array_key_exists(1, $dados)){
                    $menu->set_id_menu((int) intval($dados[1], 10));
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
                return json_encode($menu->execute_user_action($dados), JSON_UNESCAPED_UNICODE);
            }
        }else{
            $utilidade->error_message(3);
        }
    } 
}
?>