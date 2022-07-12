<?php
require_once 'Classes/bancoDeDados.php';
require_once 'InterfaceModelos.php';
class Endereco implements InterfaceModelos{
    private $id_endereco;
    private $id_pessoa;
    private $descricao;
    private $estado;
    private $cidade;
    private $bairro;
    private $complemento;
    private $observacoes_endereco;

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

    public function get_table_name(){
        return (string) 'endereco';
    }
    public function get_model(){
        return (array) ['id_endereco' => (int) 0, 'id_pessoa' => (int) 0,'descricao' => (string) '', 'estado' => (string) '', 'cidade' => (string) '', 'bairro' => (string) '', 'complemento' => (string) '', 'observacoes_endereco' => (string) ''];
    }

    public function next_id(){

    }

    public function insert(){

    }

    public function update(){

    }

    public function find(){

    }

    public function find_all($order){
        if($this->id_pessoa != 0)
            return (array) model_all($this->get_table_name(), ['id_pessoa', '===', (int) $this->id_pessoa]);
        else{
            if($order == 'true')
                return (array) model_all($this->get_table_name(), [], ['id_endereco' => (bool) true]);
            else
            return (array) model_all($this->get_table_name(), [], ['id_endereco' => (bool) false]);
        }
    }
}
?>