<?php
namespace App\Models;

use MongoDB\Operation\Find;

require_once 'Classes/bancoDeDados.php';

class Produto implements ModelsInterface{
    private $id_produto;
    private $id_menu;
    private $id_sub_menu;
    private $nome_produto;
    private $marca;
    private $descricao_curta;
    private $descricao_longa;
    private $quantidade_estoque;
    private $quantidade_minima_estoque;
    private $quantidade_separada_venda;
    private $link_produto;
    private $status;
    private $codigo_barras;
    private $preco_normal;
    private $preco_com_desconto;
    public function get_table_name(){
        return (string) 'produtos';
    }
    public function get_model(){
        return (array) ['id_produto' => (int) 0, 'id_menu' => (int) 0, 'id_sub_menu' => (int) 0,'nome_produto' => (string) '', 'marca' => (string) '', 'descricao_curta' => (string) '', 'descricao_longa' => (string) '', 'quantidade_estoque' => (float) 0, 'quantidade_minima_estoque' => (float) 0, 'quantidade_separada_venda' => (float)0, 'link_produto' => (string) '', 'status' => (string) '', 'codigo_barras' => (string) '', 'preco_normal' => (float) 0, 'preco_com_desconto' => (float) 0];
    }

    public function set_preco_normal($preco_normal){
        $this->preco_normal = (float) $preco_normal;
    }

    public function set_preco_com_desconto($preco_com_desconto){
        $this->preco_com_desconto = (float) $preco_com_desconto;
    }

    public function set_id_produto($id_produto){
        $this->id_produto = (int) $id_produto;
    }

    public function set_id_menu($id_menu){
        $this->id_menu = (int) $id_menu;
    }

    public function set_id_sub_menu($id_sub_menu){
        $this->id_sub_menu = (int) $id_sub_menu;
    }

    public function set_nome_produto($nome_produto){
        $this->nome_produto = (string) $nome_produto;
    }

    public function set_marca($marca){
        $this->marca = (string) $marca;
    }

    public function set_descricao_curta($descricao_curta){
        $this->descricao_curta = (string) $descricao_curta;
    }

    public function set_descricao_longa($descricao_longa){
        $this->descricao_longa = (string) $descricao_longa;
    }

    public function set_quantidade_estoque($quantidade_estoque){
        $this->quantidade_estoque = (float) $quantidade_estoque;
    }

    public function set_quantidade_minima_estoque($quantidade_minima_estoque){
        $this->quantidade_minima_estoque = (float) $quantidade_minima_estoque;
    }

    public function set_quantidade_separada_estoque($quantidade_separada_venda){
        $this->quantidade_separada_venda = (float) $quantidade_separada_venda;
    }

    public function get_quantidade_separada_estoque(){
        return $this->quantidade_separada_venda;
    }

    public function set_link_do_produto($link_produto){
        $this->link_produto = (string) $link_produto;
    }

    public function set_status($status){
        $this->status = (string) $status;
    }

    public function set_codigo_barras($codigo_barras){
        $this->codigo_barras = (string) $codigo_barras;
    }

    public function register(){}
    public function change(){}

    public function search_a()
    {
        $array_produto =  (array) find_one($this->get_table_name(), ['id_produto', '===', (int) $this->id_produto]);
        $array_produto['imagens'] = (array) find_all('imagens', ['id_produto', '===', (int) $this->id_produto], ['id_imagem' => (bool) false]);
        return (array) $array_produto;
    }

    public function search_all($order, $category = 0)
    {
        $return_produtos = (array) [];
        $category_filtros = (array) [];

        if($category != 0){
            array_push($category_filtros, ['id_menu' ,'===', (int) $category]);
        }

        if(empty($category_filtros) == false){
            $return_produtos = (array) find_all($this->get_table_name(), [$category_filtros], ['id_produto' => (bool) check_ordering($order)]);
        }else{
            $return_produtos = (array) find_all($this->get_table_name(), [], ['id_produto' => (bool) check_ordering($order)]);
        }
        
        $return_ordenado = (array) [];
        if(empty($return_produtos) == false){
            foreach($return_produtos as $produto){
                $array = (array) $produto;
                if(array_key_exists('id_produto', $produto)){
                    $array['imagens'] = (array) find_all('imagens', ['id_produto', '===', (int) $produto['id_produto']], ['id_imagem' => (bool) false]);
                }
                array_push($return_ordenado, $array);
            }
        }
        return (array) $return_ordenado;
    }

    public function execute_user_action($data)
    {
        $return = (array) [];
        if($data[0] == 'find_one'){
            $this->id_produto = (int) intval($data[1], 10);
            $return = (array) $this->search_a();
        }else if($data[0] == 'find_all'){
            $return = (array) $this->search_all($data[1], 0);
        }else if($data[0] == 'find_all_category'){
            $return = (array) $this->search_all($data[1], $data[2]);
        }
        return json_encode(['status' => (string) 'success', 'dados' => (array) $return], JSON_UNESCAPED_UNICODE);
    }

}
?>