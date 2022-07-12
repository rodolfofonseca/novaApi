<?php
namespace App\Models;

require_once 'Classes/bancoDeDados.php';

class Menu{
    private $id_menu;
    private $descricao;
    private $status;
    public function get_nome_tabela(){
        return (string) 'menu';
    }
    public function get_modelo(){
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

    public function proximo_codigo(){
        return (int) model_next($this->get_nome_tabela(), 'id_menu');
    }

    public function cadastrar(){
        return (bool) model_insert($this->get_nome_tabela(), model_parse($this->get_modelo(), ['id_menu' => (int) $this->get_id_menu(), 'descricao' => (string) $this->get_descricao(), 'status' => (string) $this->get_status()]));
    }

    public function alterar(){
        return (bool) model_update($this->get_nome_tabela(), ['id_menu', '===', (int) $this->get_id_menu()], model_parse($this->get_modelo(), ['id_menu' => (int) $this->get_id_menu(), 'descricao' => (string) $this->get_descricao(), 'status' => (string) $this->get_status()]));
    }

    public function pesquisar_menu_todos($ordenacao){
        if($ordenacao == 'true')
            return (array) model_all($this->get_nome_tabela(), [], ['id_menu' => (bool) true]);
        else if($ordenacao == 'false')
            return (array) model_all($this->get_nome_tabela(), [], ['id_menu' => (bool) false]);
        
    }

    public function pesquisar_menu(){
        return (array) model_one($this->get_nome_tabela(), ['id_menu', '===', (int) $this->get_id_menu()]);
    }
}
?>