<?php
if($_POST)
{
    include("connect.php");
    $con = $GLOBALS['connection'];

    $result['redirect'] = false;

    if(CheckFriendEmail($_POST['email']))
    {
        if(CheckFriendLogin($_POST['username']))
        {
            if(RegisterFriend($_POST['name'], $_POST['fone'], $_POST['email'], $_POST['username'], $_POST['password']))
            {
                $result['message'] = "Usuário cadastrado com sucesso! Faça login para continuar.";
                $result['redirect'] = true;
            }
            else
                $result['message'] = "Erro ao cadastrar usuário.";
        }
        else
            $result['message'] = "Nome de Usuário já está em uso.";
    }
    else
        $result['message'] = "Email já está em uso.";

    echo json_encode($result);
}
?>