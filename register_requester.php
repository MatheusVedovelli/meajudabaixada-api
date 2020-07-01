<?php
if($_POST)
{
    include("connect.php");
    $con = $GLOBALS['connection'];

    $result['redirect'] = false;

    if(CheckRequesterEmail($_POST['email']))
    {
        if(CheckRequesterCpf($_POST['cpf']))
        {
            $friend_email = isset($_POST['friend_email']) ? $_POST['friend_email'] : "";
            if(!CheckFriendEmail($friend_email))
            {
                if(RegisterRequester($_POST['name'], $_POST['cpf'], $_POST['birthdate'], $_POST['email'], $_POST['fone'], $_POST['address'], 
                                     $_POST['district'], $_POST['city'], $_POST['password'], $friend_email))
                {
                    $result['message'] = 'Usuário cadastrado com sucesso! Faça login para continuar.';
                    $result['redirect'] = true;
                }
                else
                    $result['message'] = 'Erro ao cadastrar usuário';
            }
            else
                $result['message'] = 'Identificação de amigo inválida.';
        }
        else
            $result['message'] = 'Cpf já cadastrado.';
    }
    else
        $result['message'] = 'Email já está em uso.';

    echo json_encode($result);
}
?>