<?php
namespace App\Models;

use App\Services\Utilidade;
require_once 'Classes\bancoDeDados.php';

class Pessoa implements ModelsInterface{
    private $persor_id;
    private $name;
    private $cpf;
    private $genre;

    public function set_person_id($persor_id){
        $this->persor_id = (int) $persor_id;
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

    public function register()
    {

        return (array) insert($this->get_table_name(), ['nome_pessoa' => (string) $this->name, 'cpf' => (string) $this->cpf, 'gerero' => (string) $this->genre], $this->get_table_name(), 'id_pessoa');
    }

    public function change()
    {
        return (bool) update($this->get_table_name(), ['id_pessoa', '===', (int) $this->persor_id], ['nome_pessoa' => (string) $this->name, 'cpf' => (string) $this->cpf, 'genero' => (string) $this->genre]);
    }

    public function search_a()
    {
        $people_array = (array) find_one($this->get_table_name(), ['id_pessoa', '===', (int) $this->persor_id]);
        
        if(array_key_exists('id_pessoa', $people_array)){
            $this->persor_id = (int) intval($people_array['id_pessoa'], 10);
        }

        if(array_key_exists('nome', $people_array)){
            $this->name = (string) $people_array['nome'];
        }

        if(array_key_exists('cpf', $people_array)){
            $this->cpf = (string) $people_array['cpf'];
        }

        if(array_key_exists('genero', $people_array)){
            $this->genre = (string) $people_array['genero'];
        }

        $util = new Utilidade();
        $id_pessoa = (string) $util->encripty($this->persor_id);
        $this->name = (string) $util->encripty($this->name);
        $this->cpf = (string) $util->encripty($this->cpf);
        $this->genre = (string) $util->encripty($this->genre);

        return (array) ['id_pessoa' => (string) $id_pessoa, 'nome' => (string) $this->name, 'cpf' => (string) $this->cpf, 'genero' => (string) $this->genre];
    }

    public function search_all($order)
    {
        $util = new Utilidade();
        $people_array = (array) [];
        $array_cripty = (array) [];
        $people_array =  (array) find_all($this->get_table_name(), [], ['id_pessoa' => check_ordering($order)]);

        if(empty($people_array) == false){
            foreach($people_array as $array){
                $id_pessoa = (string) '';
                $nome_pessoa = (string) '';
                $cpf = (string) '';
                $genero = (string) '';

                if(array_key_exists('id_pessoa', $array)){
                    $id_pessoa = (string) $util->encripty($array['id_pessoa']);
                }

                if(array_key_exists('nome', $array)){
                    $nome_pessoa = (string) $util->encripty($array['nome']);
                }

                if(array_key_exists('cpf', $array)){
                    $cpf = (string) $util->encripty($array['cpf']);
                }

                if(array_key_exists('genero', $array)){
                    $genero = (string) $util->encripty($array['genero']);
                }

                array_push($array_cripty, ['id_pessoa' => (string) $id_pessoa, 'nome' => (string) $nome_pessoa, 'cpf' => (string) $cpf, 'genero' => (string) $genero]);
            }
        }
        return (array) $array_cripty;
    }

    public function execute_user_action($data)
    {
        $return = (array) [];
        if($data[0] == 'insert'){
            $return = (array) $this->register();
        }else if($data[0] == 'update'){
            $return = (array) ['insert_status' => (bool) $this->change()];
        }else if($data[0] == 'find_one'){
            $return = (array) $this->search_a($data[1]);
        }else if($data[0] == 'find_all'){
            $return = (array) $this->search_all($data[1]);
        }

        return json_encode(['status' => (bool) true, 'data' => (array) $return], JSON_UNESCAPED_UNICODE);
    }
}
?>