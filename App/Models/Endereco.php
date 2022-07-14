<?php
namespace App\Models;
require_once 'Classes/bancoDeDados.php';
class Endereco {
    private $id_endereco;
    private $id_pessoa;
    private $descricao;
    private $estado;
    private $cidade;
    private $bairro;
    private $complemento;
    private $observacoes_endereco;
    private $status;

    public function set_ender_id($ender_id){
        $this->id_endereco = (int) intval($ender_id);
    }

    public function set_person_id($person_id){
        $this->id_pessoa = (int) intval($person_id);
    }

    public function set_description($description){
        $this->descricao = (string) $description;
    }

    public function set_state($state){
        $this->estado = (string) $state;
    }

    public function set_city($city){
        $this->cidade = (string) $city;
    }

    public function set_district($district){
        $this->bairro = (string) $district;
    }

    public function set_complement($complement){
        $this->complemento = (string) $complement;
    }

    public function set_comments($comments){
        $this->observacoes_endereco = (string) $comments;
    }

    public function set_status($status){
        $this->status = (string) $status;
    }

    private function get_table_name(){
        return (string) 'endereco';
    }
    private function get_model(){
        return (array) ['id_endereco' => (int) 0, 'id_pessoa' => (int) 0,'descricao' => (string) '', 'estado' => (string) '', 'cidade' => (string) '', 'bairro' => (string) '', 'complemento' => (string) '', 'observacoes_endereco' => (string) '', 'status' => (string) ''];
    }

    private function next_id_ende(){
        return next_id($this->get_table_name(), 'id_endereco');
    }

    public function insert_ende(){
        $this->id_endereco = (int) $this->next_id_ende();
        $return_insert = (bool) insert($this->get_table_name(), [converte($this->get_model(), ['id_endereco' => (int) $this->id_endereco, 'descricao' => (string) $this->descricao, 'estado' => (string) $this->estado, 'cidade' => (string) $this->cidade, 'bairro' => (string) $this->bairro, 'complemento' => (string) $this->complemento, 'status' => (string) $this->status])]);
        
        if($return_insert == true)
            return $this->id_endereco;
        else
            return 0;
    }

    public function update_ende(){
        return (bool) update($this->get_table_name(), ['id_endereco', '===', (int) $this->id_endereco], [converte($this->get_table_name(), ['id_endereco' => (int) $this->id_endereco, 'descricao' => (string) $this->descricao, 'estado' => (string) $this->estado, 'cidade' => (string) $this->cidade, 'bairro' => (string) $this->bairro, 'complemento' => (string) $this->complemento, 'status' => (string) $this->status])]);
    }

    public function find(){
        return (array) find_one($this->get_table_name(), ['id_endereco', '===', (int) $this->id_endereco]);
    }

    public function find_all($order){
        if($order == 'true')
            return (array) find_all($this->get_table_name(), [], ['id_endereco' => (bool) true]);
         else
            return (array) find_all($this->get_table_name(), [], ['id_endereco' => (bool) false]);
    }

    public function search_by_user($person_id){
        return (array) find_one($this->get_table_name(), ['id_pessoa', '===', (int) $person_id]);
    }

    public function execute_user_action($action, $order = ''){
        if($action == 'insert')
            return json_encode(['status' => (string) 'success', 'data' => (int) $this->insert_ende()], JSON_UNESCAPED_UNICODE);
        else if($action == 'update')
            return json_encode(['status' => (string) 'success', 'data' => (bool) $this->update_ende()], JSON_UNESCAPED_UNICODE);
        else if($action == 'find')
            return json_encode(['status' => (string) 'success', 'data' => (array) $this->find()], JSON_UNESCAPED_UNICODE);
        else if($action == 'find_all')
            return json_encode(['status' => (string) 'sucess', 'data' => (array) $this->find_all($order)], JSON_UNESCAPED_UNICODE);
    }
}
?>