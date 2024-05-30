<?php 
    $login = $_POST['txtLoginadm'];
    $senha = $_POST['txtSenhaadm'];

    if($login == 'adm' && $senha == '123'){
        header('Location: admin/index.php');
        session_start();

        $_SESSION['login-session'] = $login;
        $_SESSION['senha-session'] = $senha;

        $_SESSION['load'] = '
        <script>    
            setTimeout(carregar, 300);
            function carregar(){
                document.getElementById("overlayLoad").style.animation="load 0.2s forwards";
            }     
        </script>
        
        <div id="overlayLoad">
        <img class="position-absolute top-50 start-50 translate-middle" src="../images/loading.gif">
    </div>';
    }else {
        header('Location: index.php');
    }
?>