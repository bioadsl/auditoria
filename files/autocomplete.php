<!--  Vou passar para vc um exemplo básico em PHP que retorna os dados em JSON, esse dados serão convertidos em array com JQUERY na página do input.
// Será utilizado um plugin JQUERY mais precisamente o AutoComplete do JQUERY UI.

// 1 - baixe o JQUERY UI nesse link: [url]http://jqueryui.com/[/url]

// 2 - Escreva um arquivo em PHP, nesse exemplo vou retornar clientes do banco.

// retornaCliente.php -->

<?php
    $pdo = new PDO("mysql:host=localhost; dbname=db_sac; charset=utf8;", "root", "011224", $opcoes);
    $dados = $pdo->prepare("SELECT * FROM cliente");
    $dados->execute();
    echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>


<!-- 3 - Na página onde será usado o input com AutoComplete vc link o CSS, JQUERY e JQUERYUI. Escreve a instrução JQUERY que vai convertes os dados em array.

// Cliente.php -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Auto Complete</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="javascript/jquery-1.8.3.js"></script>
<script src="javascript/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
         
        // Captura o retorno do retornaCliente.php
        $.getJSON('retornaCliente.php', function(data){
            var cliente = [];
             
            // Armazena na array capturando somente o nome do cliente
            $(data).each(function(key, value) {
                cliente.push(value.cliente);
            });
             
            // Chamo o Auto complete do JQuery ui setando o id do input, array com os dados e o mínimo de caracteres para disparar o AutoComplete
            $('#txtCliente').autocomplete({ source: cliente, minLength: 3});
        });
    });
</script>
</head>
<body>
    <label>Cliente:</label>
    <input type="text" id="txtCliente" name="txtCliente" size="60"/>
</body>
</html>