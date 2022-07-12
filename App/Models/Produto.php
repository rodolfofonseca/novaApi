<?php
namespace App\Models;

require_once 'Classes/bancoDeDados.php';

class Produto{
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

    public function get_preco_normal(){
        return (float) $this->preco_normal;
    }

    public function set_preco_com_desconto($preco_com_desconto){
        $this->preco_com_desconto = (float) $preco_com_desconto;
    }

    public function get_preco_com_desconto(){
        return (float) $this->preco_com_desconto;
    }

    public function set_id_produto($id_produto){
        $this->id_produto = (int) $id_produto;
    }

    public function get_id_produto(){
        return $this->id_produto;
    }

    public function set_id_menu($id_menu){
        $this->id_menu = (int) $id_menu;
    }

    public function get_id_menu(){
        return $this->id_menu;
    }

    public function set_id_sub_menu($id_sub_menu){
        $this->id_sub_menu = (int) $id_sub_menu;
    }

    public function get_id_sub_menu(){
        return $this->id_sub_menu;
    }

    public function set_nome_produto($nome_produto){
        $this->nome_produto = (string) $nome_produto;
    }

    public function get_nome_produto(){
        return $this->nome_produto;
    }

    public function set_marca($marca){
        $this->marca = (string) $marca;
    }

    public function get_marca(){
        return $this->marca;
    }

    public function set_descricao_curta($descricao_curta){
        $this->descricao_curta = (string) $descricao_curta;
    }

    public function get_descricao_curta(){
        return $this->descricao_curta;
    }

    public function set_descricao_longa($descricao_longa){
        $this->descricao_longa = (string) $descricao_longa;
    }

    public function get_descricao_longa(){
        return $this->descricao_longa;
    }

    public function set_quantidade_estoque($quantidade_estoque){
        $this->quantidade_estoque = (float) $quantidade_estoque;
    }

    public function get_quantidade_estoque(){
        return $this->quantidade_estoque;
    }

    public function set_quantidade_minima_estoque($quantidade_minima_estoque){
        $this->quantidade_minima_estoque = (float) $quantidade_minima_estoque;
    }

    public function get_quantidade_minima_estoque(){
        return $this->quantidade_minima_estoque;
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

    public function get_link_do_produto(){
        return $this->link_produto;
    }

    public function set_status($status){
        $this->status = (string) $status;
    }

    public function get_status(){
        return $this->status;
    }

    public function set_codigo_barras($codigo_barras){
        $this->codigo_barras = (string) $codigo_barras;
    }

    public function get_codigo_barras(){
        return $this->codigo_barras;
    }

    public function next_id(){
        return (int) next_id($this->get_table_name(), 'id_produto');
    }

    public function insert(){
        return (bool) insert($this->get_table_name(), converte($this->get_model(), ['id_produto' => (int) $this->get_id_produto(), 'id_menu' => (int) $this->get_id_menu(), 'id_sub_menu' => (int) $this->get_id_sub_menu(), 'nome_produto' => (string) $this->get_nome_produto(), 'marca' => (string) $this->get_marca(), 'descricao_curta' => (string) $this->get_descricao_curta(), 'descricao_longa' => (string) $this->get_descricao_longa(), 'quantidade_estoque' => (float) $this->get_quantidade_estoque(), 'quantidade_minima_estoque' => (float) $this->get_quantidade_minima_estoque(), 'quantidade_separada_venda' => (float) $this->get_quantidade_separada_estoque(), 'link_produto' => (string) $this->get_link_do_produto(), 'status' => (string) $this->get_status(), 'preco_normal' => (float) $this->get_preco_normal(), 'preco_com_desconto' => (float) $this->get_preco_com_desconto()]));
    }

    public function update(){
        return (bool) update($this->get_table_name(), ['id_produto', '===', (int) $this->get_id_produto()], converte($this->get_model(), ['id_produto' => (int) $this->get_id_produto(), 'id_menu' => (int) $this->get_id_menu(), 'id_sub_menu' => (int) $this->get_id_sub_menu(), 'nome_produto' => (string) $this->get_nome_produto(), 'marca' => (string) $this->get_marca(), 'descricao_curta' => (string) $this->get_descricao_curta(), 'descricao_longa' => (string) $this->get_descricao_longa(), 'quantidade_estoque' => (float) $this->get_quantidade_estoque(), 'quantidade_minima_estoque' => (float) $this->get_quantidade_minima_estoque(), 'quantidade_separada_venda' => (float) $this->get_quantidade_separada_estoque(), 'link_produto' => (string) $this->get_link_do_produto(), 'status' => (string) $this->get_status(), 'preco_normal' => (float) $this->get_preco_normal(), 'preco_com_desconto' => (float) $this->get_preco_com_desconto()]));
    }

    public function find(){
        return (array) find_all($this->get_table_name(), ['id_produto', '===', (int) $this->get_id_produto()]);
    }

    public function find_all($order){
        if($order == 'true')
            return (array) find_all($this->get_table_name(), [], ['id_produto' => (bool) true]);
        else
            return (array) find_all($this->get_table_name(), [], ['id_produto' => (bool) false]);
    }
}
?>