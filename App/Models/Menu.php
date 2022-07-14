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
        return (int) next_id($this->get_nome_tabela(), 'id_menu');
    }

    public function cadastrar(){
        $this->id_menu = (int) $this->proximo_codigo();
        return (bool) insert($this->get_nome_tabela(), converte($this->get_modelo(), ['descricao' => (string) $this->get_descricao(), 'status' => (string) $this->get_status(), 'id_menu' => (int) $this->id_menu]));
    }

    public function alterar(){
        return (bool) update($this->get_nome_tabela(), ['id_menu', '===', (int) $this->get_id_menu()], converte($this->get_modelo(), ['id_menu' => (int) $this->get_id_menu(), 'descricao' => (string) $this->get_descricao(), 'status' => (string) $this->get_status()]));
    }

    public function pesquisar_menu_todos($ordenacao){
        if($ordenacao == 'true')
            return (array) find_all($this->get_nome_tabela(), [], ['id_menu' => (bool) true]);
        else if($ordenacao == 'false')
            return (array) find_all($this->get_nome_tabela(), [], ['id_menu' => (bool) false]);
        
    }

    public function pesquisar_menu(){
        return (array) find_one($this->get_nome_tabela(), ['id_menu', '===', (int) $this->get_id_menu()]);
    }
}
?>