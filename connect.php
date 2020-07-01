<?php 
    $servidor = "localhost";
    $usuario = "root";
    $senha = "usbw";
    $db = "meajudabaixada";
    $connection = new mysqli($servidor, $usuario, $senha, $db);

    if(!$connection)    
    {
        echo '<script>alert("Erro de conexão! '.$connection->error.'!")</script>';
        return;
    }

    function CheckFriendEmail($email)
    {
        if(!$email || !strlen($email))
            return false;

        $bRet = false;
        $con = $GLOBALS['connection'];
        if($con)
        {
            if($stmt = $con->prepare("SELECT COUNT(*) FROM tb_amigo WHERE nm_email=?"))
            {
                $cnt = 0;
                $stmt->bind_param("s", $email);
                $stmt->bind_result($cnt);
                if($stmt->execute() && $stmt->fetch())
                {
                    if(!$cnt)
                        $bRet = true;
                }
            }
        }

        return $bRet;
    }

    function CheckFriendLogin($login)
    {
        if(!$login || !strlen($login))
            return false;

        $bRet = false;
        $con = $GLOBALS['connection'];
        if($con)
        {
            if($stmt = $con->prepare("SELECT COUNT(*) FROM tb_amigo WHERE nm_login=?"))
            {
                $cnt = 0;
                $stmt->bind_param("s", $login);
                $stmt->bind_result($cnt);
                if($stmt->execute() && $stmt->fetch())
                {
                    if(!$cnt)
                        $bRet = true;
                }
            }
        }

        return $bRet;
    }

    function RegisterFriend($name, $fone, $email, $login, $pass)
    {
        $bRet = false;
        $con = $GLOBALS['connection'];
        if($con)
        {
            if($stmt = $con->prepare("INSERT INTO tb_amigo VALUES (null, ?, ?, ?, ?, ?)"))
            {
                $stmt->bind_param("sssss", $name, $fone, $email, $login, $pass);
                if($stmt->execute())
                    $bRet = true;
            }
        }

        return $bRet;
    }

    function CheckRequesterEmail($email)
    {
        if(!$email || !strlen($email))
            return false;

        $bRet = false;
        $con = $GLOBALS['connection'];
        if($con)
        {
            if($stmt = $con->prepare("SELECT COUNT(*) FROM tb_solicitante WHERE nm_email=?"))
            {
                $cnt = 0;
                $stmt->bind_param("s", $email);
                $stmt->bind_result($cnt);
                if($stmt->execute() && $stmt->fetch())
                {
                    if(!$cnt)
                        $bRet = true;
                }
            }
        }

        return $bRet;
    }

    function CheckRequesterCpf($cpf)
    {
        if(!$cpf || !strlen($cpf)) // implement cpf validation later (?)
            return false;

        $bRet = false;
        $con = $GLOBALS['connection'];
        if($con)
        {
            if($stmt = $con->prepare("SELECT COUNT(*) FROM tb_solicitante WHERE cd_cpf=?"))
            {
                $cnt = 0;
                $stmt->bind_param("s", $cpf);
                $stmt->bind_result($cnt);
                if($stmt->execute() && $stmt->fetch())
                {
                    if(!$cnt)
                        $bRet = true;
                }
            }
        }

        return $bRet;
    }

    function RegisterRequester($name, $cpf, $birthdate, $email, $fone, $address, $district, $city, $pass, $friend_info)
    {
        $bRet = false;
        $con = $GLOBALS['connection'];
        if($con)
        {
            if($stmt = $con->prepare("INSERT INTO tb_solicitante VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, (SELECT cd_amigo FROM tb_amigo WHERE nm_email=?), NOW())"))
            {
                $stmt->bind_param("sssssssssd", $name, $cpf, $birthdate, $pass, $address, $district, $city, $email, $fone, $friend_info);
                if($stmt->execute())
                    $bRet = true;
                else
                    echo $stmt->error;
            }
            else
                echo "Prepare error";
        }

        return $bRet;
    }
?>