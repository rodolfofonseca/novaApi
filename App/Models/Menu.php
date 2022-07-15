<?php
namespace App\Models;

require_once 'Classes/bancoDeDados.php';

class Menu implements ModelsInterface{
    private $id_menu;
    private $descricao;
    private $status;
    public function get_table_name(){
        return (string) 'menu';
    }
    public function get_model(){
        return (array) ['id_menu' => (int) 0, 'descricao' => (string) '', 'status' => (string) ''];
    }
    public function get_id_menu(){
        return (int) $this->id_menu;
    }
    public function get_descricao(){
        return (string) $this->descricao;
    }
    public function get_status(){
        if($this->status == 'S')
            return (string) 'ATIVO';
        else
            return (string) 'INATIVO';
    }
    public function set_id_menu($id_menu){
        $this->id_menu = (int) $id_menu;
    }
    public function set_descricao($descricao){
        $this->descricao = (string) $descricao;
    }
    public function set_status($status){
        if($status == 'ATIVO')
            $this->status = (string) 'S';
        else 
            $this->status = (string) 'N';
    }

    public function register()
    {
        
    }

    public function change()
    {
        
    }

    public function search_a()
    {
        return (array) find_one($this->get_table_name(), ['id_menu', '===', (int) $this->id_menu]);
    }

    public function search_all($order)
    {
        return (array) find_all($this->get_table_name(), [], ['id_menu' => (bool) check_ordering($order)]);
    }

    public function execute_user_action($data)
    {
        $return_array = (array) [];
        if($data[0] == 'find'){
            $return_array = (array) $this->search_a();
        }else if($data[0] == 'find_all'){
            $return_array = (array) $this->search_all($data[1]);
        }
        return (array) ['status' => (bool) true, 'dados' => (array) $return_array];
    }
}
?>