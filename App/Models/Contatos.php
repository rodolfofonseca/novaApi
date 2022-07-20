<?php
require_once 'Classes/bancoDeDados.php';
require_once 'InterfaceModelos.php';
class Contatos{
    private $id_contato;
    private $id_pessoa;
    private $contato;
    private $tipo;

    public function set_id_contact($id_contact){
        $this->id_contato = (int) intval($id_contact, 10);
    }

    public function set_id_person($id_person){
        $this->id_pessoa = (int) intval($id_person, 10);
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

    public function proximo_codigo(){
        return (int) next_id($this->get_table_name(), 'id_contato');
    }
    public function insert(){
        /*$this->id_contato = (int) $this->proximo_codigo();
        $return_banco = (bool) insert($this->get_table_name(), converte($this->get_model(), ['id_pessoa' => (int) $this->id_pessoa, 'contato' => (string) $this->contato, 'tipo' => (string) $this->tipo, 'id_contato' => (int) $this->id_contato]));
        if($return_banco == true){
            return (int) $this->id_contato;
        }else{
            return (int) 0;
        }*/
    }
    public function update(){
        return 
    }
    public function find(){

    }
    public function assemble_array($array){}
    public function find_all($order){
        if($this->id_pessoa != 0)
            return (array) find_one($this->get_table_name(), ['id_pessoa', '===', (int) $this->id_pessoa]);
        else{
            if($order == 'true')
                return (array) find_all($this->get_table_name(), [], ['id_contato' => (bool) true]);
            else
                return (array) find_all($this->get_table_name(), [], ['id_contato' => (bool) false]);
        }
    }
}
?>