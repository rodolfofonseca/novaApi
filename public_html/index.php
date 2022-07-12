<?php

use App\Services\Utilidade;
/*header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400'); */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, FETCH');
header("Access-Control-Allow-Headers: X-Requested-With");		
header('Content-Type: application/json');

require_once '../vendor/autoload.php';
    // api/users/1
try{
    $utilidade = new Utilidade();
    if(array_key_exists('url', $_GET)){
       $url = explode('/', $_GET['url']);
    
       if ($url[0] === 'api') {
            array_shift($url);
                
           if(array_key_exists(0, $url)){
               $service = 'App\Services\\'.ucfirst($url[0]).'Service';
                array_shift($url);
                $method = strtolower($_SERVER['REQUEST_METHOD']);
                http_response_code(200);
                $response = (array) [];
                $dados = $url;
                if($service == 'App\Services\MenuService'){
                    $menu = new $service;
                  echo $menu->controlador($dados);
                }
                else if($service == 'App\Services\SubmenuService'){
                    $categoria = new $service;
                    echo $categoria->controlador($dados);
                }else if($service == 'App\Services\ProdutoService'){
                    $produto = new $service;
                    echo $produto->controlador($dados);
                }else if($service == 'App\Services\PessoaService'){
                    $person = new $service;
                    echo $person->controlador($dados);
                }
            }
            else
            $utilidade->erro_de_sistema('Infelizmente não conseguimos completar a sua solicitação');

        }else
        $utilidade->erro_de_sistema('Não foi encontrado o prâmetro correto para realizar a pesquisa!');

    }else{
        $utilidade->erro_de_sistema('Não foi encontrado parâmetros suficientes para continuar com a operação!');
    }
    exit;
 }catch(\Exception $e) {
    http_response_code(404);
    echo json_encode(array('status' => 'error', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
     exit;
 }
