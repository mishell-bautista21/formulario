<?php
session_start();
if(isset($_SESSION['admin_name'])){
    header("location:home.php");

}
$connet= mysqli_connect("localhost", "root","", "login");
if(isset($_POST["login"])){
    if(!empty($_POST['member_name']) && !empty($_POST['member_password'])){
        $name=mysqli_real_escape_string($connet,$_POST['member_name']);
        $pass=mysqli_real_escape_string($connet,$_POST['member_password']);
        $sql="SELECT * FROM usuarios WHERE usuario='".$name."' AND password='".$pass."'";
        $result = mysqli_query($connet,$sql);
        $user = mysqli_fetch_array($result);

        if($user){
           if(!empty($_POST['remember'])){
            setcookie("member_login",$name, time()+(10 * 365 * 24 * 60 * 60));
            setcookie("member_password",$pass, time()+(10 * 365 * 24 * 60 * 60));
            $_SESSION['admin_name']=$name;
            }else{
                if(isset($_COOKIE['member_login'])){
                    setcookie("member_login",""); 
                    $_SESSION['admin_name']=$name;
                 

                }
                if(isset($_COOKIE['member_password'])){
                    setcookie("member_password",""); 
                    $_SESSION['admin_name']=$name;
                 

                }
            }
            header("location:home.php"); 
            $_SESSION['admin_name']=$name;
        }else{
            $mensaje="Ingreso Invalido";
        }

    }
    else{
        $mensaje="Ambos campos son obligatorios";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
    
</head>
<body>
  <div class="theme-layout">
      <div class="container-fluid pdng0">
          <div class="row merged">
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                  <div class="login-reg-bg">
                      <div class="log-reg-area sing">
                      <h2 class="log-title" style="text-align:center;">Iniciar Sesion</h2>
                      <p>Todavia no usas web? <a href="#">Haz el Recorrido o unete ahora</a></p>

                      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                          <div class="form-group">
                        <?php
                         if(isset($mensaje)){
                             echo $mensaje;

                         }
                        ?>
                          </div>

                          <div class="form-group">
                              <input type="email" name="member_name" id="input" value="<?php if(isset($_COOKIE['member_login'])){
                                  echo $_COOKIE['member_login'];
                              } ?>" required>
                              <label for="input" class="control-label">Nombre de usuario</label><i class="mtrl-select"></i>
                          </div>

                          <div class="form-group">
                              <input type="password" name="member_password" id="inputp" value="<?php if(isset($_COOKIE['member_password'])){
                                  echo $_COOKIE['member_password'];
                              } ?>" required>
                              <label for="inputp" class="control-label">Contraseña</label><i class="mtrl-select"></i>
                          </div>

                          <div class="checkbox">
                              <label>
                              <input type="checkbox" name="remember" <?php if(isset($_COOKIE['member_login'])){
                                 ?>
                                  checked
                                 <?php
                                
                              } ?>><i class="check-box"></i> Recuerda siempre.
                              </label>
                          </div>

                          <a href="#" class="forgot-pwd"> ¿Se te olvido tu contraseña?</a>

                        <center>
                        <div class="submit-btns">
                              <button class="mtr-btn signip" name="login" type="submit"> <span>Iniciar Sesion</span> </button>
                              <button class="mtr-btn signup" type="submit"> <span>Registro</span> </button>
                          </div>
                        </center>  



                      </form>


                     

                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>  
</body>


</html>
