<?php

//cria as vários com dados do banco
$nomeb = null;
$userb = null;
$senhab = null;
$tipob = null;
$idb = null;

//pega os dados do banco
$consulta = $conexao->query("SELECT id_usuario, nome, email, senha, tipo_usuario FROM usuario where email = '" . $user . "'");
while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) {
    // dados vindos do banco, por isso o "b"
    $idb = $linha->id_usuario;
    $nomeb = $linha->nome;
    $userb = $linha->email;
    $senhab = $linha->senha;
    $tipob = $linha->tipo_usuario;
}

if ($user == $userb AND $senha == $senhab AND $tipob == "u") {// verifica se usuário, senha estão corretos e se ele é administrador
    if (count($consulta) > 0) {
        $_SESSION['email'] = $user;
        $_SESSION['nome'] = strtoupper($nomeb);
        $_SESSION['tipo'] = 'user';

        setcookie('email', $user, time() + 3600);

        $user_conf = $conexao->prepare("UPDATE usuario SET usuario_ativo = true WHERE id_usuario = :id_usuario");
        $user_conf->bindValue(":id_usuario", $idb, PDO::PARAM_INT);
        $user_conf->execute();

        header("location:index.php");
    }
    else {
        header("location:index.php");
    }
}
else {
    header("location: index.php");
}