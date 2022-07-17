<?php
namespace App\Models;
require_once 'Classes/bancoDeDados.php';

class Categoria implements ModelsInterface{ 
    private $id_categoria;
    private $id_menu;
    private $descricao;
    private $aparece_menu;
    public function get_table_name(){
        return (string) 'categoria';
    }
    public function get_model(){
        return (array) ['id_categoria' => (int) 0, 'id_menu' => (int) 0, 'descricao' => (string) '', 'aparece_menu' => (string) ''];
    }
    public function set_id_categoria($id_categoria){
        $this->id_categoria = (int) $id_categoria;
    }
    public function set_id_menu($id_menu){
        $this->id_menu = (int) $id_menu;
    }
    public function set_descricao($descricao){
        $this->descricao = (string) $descricao;
    }
    public function set_aparece_menu($aparece_menu){
      $this->aparece_menu = (string) $aparece_menu;
    }

    public function register()
    {
        
    }

    public function change()
    {
        
    }

    public function search_a()
    {
        return (array) find_one($this->get_table_name(), ['id_categoria', '===', (int) $this->id_categoria]);
    }

    public function search_all($order)
    {
        return (array) find_all($this->get_table_name(), [], ['id_categoria' => (bool) check_ordering($order)]);
    }
    
    public function execute_user_action($dados){
        $return = (array) [];

        if($dados[0] == 'find'){
            $return = (array) $this->search_a();
        }else if($dados[0] == 'find_all'){
            $return = (array) $this->search_all($dados[1]);
        }
        return (array) ['status' => (bool) true, 'dados' => (array) $return];
    }
}
?>