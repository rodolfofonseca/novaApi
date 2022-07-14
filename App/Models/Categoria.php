<?php
namespace App\Models;
require_once 'Classes/bancoDeDados.php';

class Categoria implements ModelsInterface{ 
    private $id_categoria;
    private $id_menu;
    private $descricao;
    private $aparece_menu;
    public function get_nome_tabela(){
        return (string) 'categoria';
    }
    public function get_modelo(){
        return (array) ['id_categoria' => (int) 0, 'id_menu' => (int) 0, 'descricao' => (string) '', 'aparece_menu' => (string) ''];
    }
    public function get_id_categoria(){
        return (int) $this->id_categoria;
    }
    public function get_id_menu(){
        return (int) $this->id_menu;
    }
    public function get_descricao(){
        return (string) $this->descricao;
    }
    public function get_apareceu_menu(){
        if($this->aparece_menu == 'N')
            return (string) 'INATIVO';
        else
            return (string) 'ATIVO';
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
        if($aparece_menu == 'ATIVO')
            $this->aparece_menu = (string) 'S';
        else
            $this->aparece_menu = (string) 'N';
    }

    public function proximo_codigo(){
        return (int) next_id($this->get_nome_tabela(), 'id_categoria');
    }

    public function cadastrar(){
        return (bool) insert($this->get_nome_tabela(), converte($this->get_modelo(), ['id_categoria' => (int) $this->get_id_categoria(), 'id_menu' => (int) $this->get_id_menu(), 'descricao' => (string) $this->get_descricao(), 'aparece_menu' => (string) $this->get_apareceu_menu()]));
    }

    public function alterar(){
        return (bool) update($this->get_nome_tabela(), ['id_categoria', '===', (int) $this->id_categoria], converte($this->get_modelo(), ['id_categoria' => (int) $this->get_id_categoria(), 'id_menu' => (int) $this->get_id_menu(), 'descricao' => (string) $this->get_descricao(), 'aparece_menu' => (string) $this->get_apareceu_menu()]));
    }

    public function pesquisar_todas($ordenacao){
        $retorno_categorias = (array) find_all($this->get_nome_tabela(), [], ['id_categoria' => true]);
        $menu = new Menu();
        $retorno_menu = (array) [];
        $retorno = (array) [];

        if($ordenacao == 'true')
            $retorno_menu = (array) find_all($menu->get_nome_tabela(), [], ['id_categoria' => true]);
        else
            $retorno_menu = (array) find_all($menu->get_nome_tabela(), [], ['id_categoria' => false]);

        if(empty($retorno_categorias) == false){
            foreach($retorno_categorias as $categoria){
                
                if(empty($retorno_menu) == false){
                    foreach($retorno_menu as $menu){
                        if($categoria['id_menu'] == $menu['id_menu'])
                        $categoria['nome_categoria'] = (string) $menu['descricao'];
                    }
                }

                array_push($retorno, $categoria);
            }
        }
        return (array) $retorno;
    }

    public  function pesquisar(){
        return (array) find_one($this->get_nome_tabela(), ['id_categoria', '===', (int) $this->get_id_categoria()]);
    }
    
    public function execute_user_action($action, $order = ''){

    }
}
?>