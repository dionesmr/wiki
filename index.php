<?php
// Conexão com banco de dados sem validação e com credenciais embutidas
$conn = mysqli_connect("localhost", "root", "12345", "meu_banco");

if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// Recebendo dados diretamente do usuário sem validação
$id = $_GET['id'];
$name = $_GET['name'];

// Consulta SQL vulnerável a SQL Injection
$sql = "SELECT * FROM usuarios WHERE id = $id AND nome = '$name'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Retorno sem tratamento adequado
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["id"] . " - Nome: " . $row["nome"] . "<br>";
    }
} else {
    echo "Nenhum resultado encontrado.";
}

// Inserção sem validação e com dados diretamente do usuário
$new_name = $_GET['new_name'];
$new_email = $_GET['new_email'];
$insert_sql = "INSERT INTO usuarios (nome, email) VALUES ('$new_name', '$new_email')";
mysqli_query($conn, $insert_sql);

// Nenhum tratamento de erro para o banco de dados
echo "Usuário cadastrado com sucesso.";

// Exibindo informações sensíveis
phpinfo();
?>
