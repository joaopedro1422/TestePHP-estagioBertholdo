<?php
/**
 * Classe que armazena e manipula as informações sobre o endereçõ recuperado. Seria uma boa prática utilizar atributos * *locais como Rua, bairro e estado, que seriam definidos a partir de um construtor recebendo o Cep e atribuindo os *valores.
 * Dessa forma o método get_address seria responsavel apenas por retornar as informações já armazenadas no objeto.
 */
class Address{

    /**
     * Método responsável por retornar o xml com as informações do endereço recuperado pela requisição.
     * Recebe como parâmetro o Cep informado pelo usuário.
     */
    function get_address($cep){
        $cep = preg_replace("/[^0-9]/", "", $cep);
        $url = "http://viacep.com.br/ws/{$cep}/xml/";
        $xml = simplexml_load_file($url);
        return $xml;
    }
}

?>