<?php
namespace App\Models;
use App\Services\Utilidade;
require_once 'Classes/bancoDeDados.php';
class Endereco implements ModelsInterface{
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

    public function get_table_name(){
        return (string) 'endereco';
    }
    
    public function get_model(){
        return (array) ['id_endereco' => (int) 0, 'id_pessoa' => (int) 0,'descricao' => (string) '', 'estado' => (string) '', 'cidade' => (string) '', 'bairro' => (string) '', 'complemento' => (string) '', 'observacoes_endereco' => (string) '', 'status' => (string) ''];
    }

    public function register(){
        $util = new Utilidade();
        $return = (string) insert($this->get_table_name(), ['id_pessoa' => (int) $this->id_pessoa, 'descricao' => (string) $this->descricao, 'estado' => (string) $this->estado, 'cidade' => (string) $this->cidade, 'bairro' => (string) $this->bairro, 'complemento' => (string) $this->complemento, 'observacoes_endereco' => (string) $this->observacoes_endereco, 'status' => (string) $this->status], $this->get_model(), 'id_endereco');

        return (array) ['id_pessoa' => $util->encripty($return['id_endereco'])];
    }

    public function change(){
         $return = (bool) update($this->get_table_name(), ['id_endereco', '===', (int) $this->id_endereco], ['id_pessoa' => (int) $this->id_pessoa, 'descricao' => (string) $this->descricao, 'estado' => (string) $this->estado, 'cidade' => (string) $this->cidade, 'bairro' => (string) $this->bairro, 'complemento' => (string) $this->complemento, 'observacoes_endereco' => (string) $this->observacoes_endereco, 'status' => (string) $this->status]);

         return (array) ['status_update' => (bool) $return];
    }

    public function search_a(){
        $array_return = (array) find_one($this->get_table_name(), ['id_endereco' => (int) $this->id_endereco]);

        if(empty($array_return) == false){
            return (array) $this->assemble_array($array_return);
        }else{
            return (array) [];
        }
    }

    public function search_all($order){
        $array_return = (array) find_all($this->get_table_name(), [], ['id_endereco' => (bool) check_ordering($order)]);
        $return = (array) [];

        if(empty($array_return) == false){
            foreach($array_return as $array){
                array_push($return, $this->assemble_array($array));
            }
        }

        return (array) $return;
    }

    public function assemble_array($array){
        $util = new Utilidade();
        $id_endereco = (string) $util->encripty_array($array, 'id_endereco');
        $id_pessoa = (string) $util->encripty_array($array, 'id_pessoa');
        $descricao = (string) $util->encripty_array($array, 'descricao');
        $estado = (string) $util->encripty_array($array, 'estado');
        $cidade = (string) $util->encripty_array($array, 'cidade');
        $bairro = (string) $util->encripty_array($array, 'bairro');
        $complemento = (string) $util->encripty_array($array, 'complemento');
        $observacoes_endereco = (string) $util->encripty_array($array, 'observacoes_endereco');
        $status = (string) $util->encripty_array($array, 'statys');

        return (array) ['id_endereco' => (string) $id_endereco, 'id_pessoa' => (string) $id_pessoa, 'descricao' => (string) $descricao, 'estado' => (string) $estado, 'cidade' => (string) $cidade, 'bairro' => (string) $bairro, 'complemento' => (string) $complemento, 'observacoes_endereco' => (String) $observacoes_endereco, 'status' => (string) $status];
    }

    public function execute_user_action($data)
    {
        $return = (array) [];

        if($data[0] == 'insert'){
            $return = (string) $this->register(); 
        }else if($data[0] == 'update'){
            $return = (bool) $this->change();
        }else if($data[0] == 'find_one'){
            $return = (array) $this->search_a();
        }else if($data[0] == 'find_all'){
            $return = (array) $this->search_all($data[1]);
        }

        return json_encode(['status' => (string) 'success', 'data' => (array) $return], JSON_UNESCAPED_UNICODE);
    }
}
?>