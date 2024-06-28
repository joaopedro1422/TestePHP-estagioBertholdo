<?php
    /**
     * Corpo PHP responsável por recuperar o CEP informado pelo usuário, realizar as validações e enviar a requisição para a API do Viacep.
     */
    // Atributos de exibição, que serão preenchidos conforme as validações permitam
    $cepValidado = '';
    $logradouro = '';
    $bairro = '';
    $uf = '';
    $error_message = '';

    require_once 'Address.php'; // Incluindo o arquivo da classe
    if (!empty($_POST['cep'])) {
        $cep = $_POST['cep'];
        $cep = str_replace("-", "", $cep);
        // Adicionei mais uma verificação para que o formato do cep seja validado. O cep será considerado apenas possuir tamanho igual a 8 e apenas dígitos em sua composição.
        if (strlen($cep) != 8 || !ctype_digit($cep)) {
            $error_message = "Formato inválido";
        } else {
            $addressObj = new Address(); // Criação de uma nova instância Address
            $address = $addressObj->get_address($cep);

            // Verificação da resposta da requisição, caso esteja vazia, uma mensagem de feedback será exibida ao usuário.
            if ($address && isset($address->logradouro)) {
                $logradouro= "<strong>Rua: </strong>".$address->logradouro; //Definindo a exibição de cada dado
                $bairro = "<strong>Bairro: </strong>".$address->bairro;
                $uf = "<strong>Estado: </strong>".$address->uf;
                $cepValidado = "<strong>CEP Informado: </strong>".$cep;
            } else {
                $error_message = "CEP não encontrado";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>MEU CEP</title>
    <link rel="stylesheet" type="text/css" href="StyleForm.css"> <!-- Link para o arquivo CSS -->
</head>
<body> 
    <div class="container-form">
        <form class="main-form" action="index.php" method="post">
            <label> Insira o CEP: </label>
            <input class="input <?php echo !empty($error_message) ? 'error-input' : ''; ?>" type="text" name="cep" value="<?php echo $error_message ?>"> <!-- Expressão condicional que verifica a existência de mensagem de erro, caso existe, o nome da classe é alterada para error-input, definida no arquivo css com um fundo vermelho -->
            </head>
            <input class="btn-send" type="submit" value="Enviar">
        </form>
        <p> <?php echo $cepValidado ?></p> <!-- Exibição das informações -->
        <p> <?php echo $logradouro ?></p>
        <p> <?php echo $bairro ?></p>
        <p> <?php echo $uf ?></p>
    </div>
</body>
</html>



