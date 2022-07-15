<?php
namespace App\Models;

interface ModelsInterface{
    public function get_table_name();
    public function get_model();
    public function register();
    public function change();
    public function search_a();
    public function search_all($order);
    public function execute_user_action($data);
}
?>