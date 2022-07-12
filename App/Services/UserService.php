<?php
    namespace App\Services;

    use App\Models\User;

    class UserService
    {
        public function get($id = null) 
        {
            if ($id) {
                return (array) ['id' => (int) 0, 'nome' => (string) 'Rodolfo Angelo Vieira Fonseca'];
                //return User::select($id);
            } else {
                //return User::selectAll();
                return (array) ['id' => (int) 0, 'nome' => (string) 'Rodolfo Angelo Vieira Fonseca'];
            }
        }

        public function post() 
        {
            $data = $_POST;

            return User::insert($data);
        }

        public function update() 
        {
            
        }

        public function delete() 
        {
            
        }
    }