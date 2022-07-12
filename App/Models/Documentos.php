<?php
class Documentos{
    public function get_nome_tabela(){
        return (string) 'documentos';
    }
    public function get_modelo(){
        return (array) ['id_documentos' => (int) 0, 'id_pessoa' => (int) 0, 'nome_documento' => (string) '', 'tipo_documento' => (string) ''];
    }
}
?>