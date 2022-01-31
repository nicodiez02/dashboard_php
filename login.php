<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    <!--SweetAlert-->
    <script src="sweetalert2.all.min.js"></script>

    <!--JQuery-->
    <script src="jquery-3.3.1.min.js"></script>

</head>

<?php

require 'mysql_connector.php';

session_start();

if ($_POST) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $SQL = "SELECT UserID, Usuario, Clave, Tipo FROM users WHERE Usuario = '$email'";


    $res = $mysqli->query($SQL);
    $num = $res->num_rows;

    if ($num > 0) {
        $row = $res->fetch_assoc();
        $password_bd = $row['Clave'];
        $password_c = sha1($password);

        if ($password_bd == $password_c) {

            $_SESSION['nombre'] = $row['Usuario'];
            $_SESSION['id'] = $row['UserID'];
            $_SESSION['type'] = $row['Tipo'];

            header("Location: index.php");
        } else {
            echo '
            <script type="text/javascript">

            $(document).ready(function(){

            swal({
                position: "top-end",
                type: "success",
                title: "Wrong Password",
                showConfirmButton: false,
                timer: 1500
            })
            });

            </script>
            ';
        }
    } else {
        echo '
            <script type="text/javascript">

            $(document).ready(function(){

            swal({
                position: "top-end",
                type: "success",
                title: "User doesnt exist",
                showConfirmButton: false,
                timer: 1500
            })
            });

            </script>
            ';
    }
}
?>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <div class="form-floating mb-3">
                                            <input name="email" class="form-control" id="inputEmail" type="text" placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input name="password" class="form-control" id="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Forgot Password?</a>
                                            <button typen="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>