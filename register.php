<?php
    include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Register Pemesanan Tiket</h3></div>
                                    <div class="card-body">
                                            <?php
                                                if(isset($_POST['register'])) {
                                                    $id_user = $_POST['id_user'];
                                                    $nama = $_POST['nama'];
                                                    $email = $_POST['email'];
                                                    $password = md5($_POST['password']);
                                                    $role = $_POST['role'];
                                                    
                                                   

                                                    $insert = mysqli_query($conn, "INSERT INTO user(id_user,nama,email,password,role) VALUES('$id_user','$nama','$email','$password','$role')");
                                                    if($insert){
                                                        echo '<script>alert("Selamat, register berhasil. sialhkan login"); location.href="login.php"</script>';
                                                    }else{
                                                        
                                                        echo '<script>alert("Register gagal, silahkan ulangi kembali.");</script>';
                                                    }
                                                }
                                            ?>
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="small mb-1">UserID</label>
                                                <input class="form-control" type="text" required name="id_user" placeholder="Masukan UserID" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1">Nama</label>
                                                <input class="form-control" type="text" required name="nama" placeholder="Masukan Nama Lengkap" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1">Email</label>
                                                <input class="form-control" type="text" required name="email" placeholder="Masukan Email" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1">No. Telepon</label>
                                                <input class="form-control" type="text" required name="no_telepon" placeholder="Masukan No. Telepon" />                                               
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1">Alamat</label>
                                                <textarea name="alamat" rows="5" required class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1">Username</label>
                                                <input class="form-control" type="text" required name="username" placeholder="Masukan Username" /> 
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword">Password</label>
                                                <input class="form-control" required name="password" type="password" placeholder="Masukan Password" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1">Level</label>
                                                <select name="role" required class="form-select">
                                                    <option value="user">User</option>
                                                </select>                                               
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" type="submit" name="register" value="register">Register</button>
                                                <a class="btn btn-danger" href="login.php">Login</a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small">
                                            &copy; 2025 Ticket Kereta Api
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
