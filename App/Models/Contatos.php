<?php
require_once 'Classes/bancoDeDados.php';
require_once 'InterfaceModelos.php';
class Contatos implements InterfaceModelos{
    private $id_contato;
    private $id_pessoa;
    private $contato;
    private $tipo;

    public function set_id_contact($id_contact){
        $this->id_contato = (int) intval($id_contact, 10);
    }

    public function get_id_contact(){
        return $this->id_contato;
    }

    public function set_id_person($id_person){
        $this->id_pessoa = (int) intval($id_person, 10);
    }

    public function get_id_person(){
        return $this->id_pessoa;
    }

    public function set_contact($contact){
        $this->contato = (string) $contact;
    }

    public function set_type($type){
        $this->tipo = (string) $type;
    }

    public function get_table_name(){
        return (string) 'contatos';
    }
    public function get_model(){
        return (array) ['id_contato' => (int) 0, 'id_pessoa' => (int) 0, 'contato' => (string) '', 'tipo' => (string) ''];
    }

    public function next_id(){
        return (int) model_next($this->get_table_name(), 'id_contato');
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
                return (array) model_all($this->get_table_name(), [], ['id_contato' => (bool) true]);
            else
                return (array) model_all($this->get_table_name(), [], ['id_contato' => (bool) false]);
        }
    }
}
?>