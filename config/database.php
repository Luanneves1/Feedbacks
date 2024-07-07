<?php
// Constantes de configuração da conexão com o banco de dados
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('BANCO', 'php_dev');

// Estabelecendo conexão
$conexao = new mysqli(SERVIDOR, USUARIO, SENHA, BANCO);

// Verificando a conexão
if ($conexao->connect_error) {
    die('Erro ao conectar ao banco de dados: ' . $conexao->connect_error);
}
?>
