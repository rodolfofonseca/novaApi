<?php
namespace App\Models;
require_once 'Classes\bancoDeDados.php';

class Pessoa {
    private $persor_id;
    private $name;
    private $cpf;
    private $genre;

    public function set_person_id($persor_id){
        $this->persor_id = (int) $persor_id;
    }

    public function get_person_id(){
        return (int) $this->persor_id;
    }

    public function set_name($name){
        $this->name = (string) $name;
    }

    public function set_cpf($cpf){
        $this->cpf = (string) $cpf;
    }

    public function set_genre($genre){
        $this->genre = (String) $genre;
    }

    public function get_table_name()
    {
        return (string) 'pessoa';   
    }

    public function get_model(){
        return (array) ['id_pessoa' => (int) 0, 'nome' => (string) '', 'cpf' => (string) '', 'genero' => (string) ''];
    }

    public function next_id(){
        return (int) next_id($this->get_table_name(), 'id_pessoa');
    }

    public function insert(){
        return (bool) insert($this->get_table_name(), converte($this->get_model(), ['id_pessoa' => (int) $this->persor_id, 'nome' => (string) $this->name, 'cpf' => (string) $this->cpf, 'genero' => (string) $this->genre]));
    }

    public function update(){
        return (bool) update($this->get_table_name(), ['id_pessoa', '===', (int) $this->persor_id], next_id($this->get_model(), ['id_pessoa' => (int) $this->persor_id, 'nome' => (string) $this->name, 'cpf' => (string) $this->cpf, 'genero' => (string) $this->genre]));
    }

    public function find(){
        return (array) find_one($this->get_table_name(), ['id_pessoa', '===', (int) $this->persor_id]);
    }

    public function find_all($order){
        if($order == 'true')
            return (array) find_all($this->get_table_name(), [], ['id_pessoa' => true]);
        else
            return (array) find_all($this->get_table_name(), [], ['id_pessoa' => false]);
    }
}
?>