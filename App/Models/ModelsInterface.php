<?php
namespace App\Models;

interface ModelsInterface{
    public function get_nome_tabela();
    public function get_modelo();
    public function proximo_codigo();
    public function cadastrar();
    public function alterar();
    public function pesquisar();
    public function pesquisar_todas($ordenacao);
    public function execute_user_action($action, $order = '');
}
?>