<?php 
    error_reporting(0);
    include("common/config.php");
    if($_GET['kode'] != "IanFelixJS"){
        header('location:../index.html');
    }else{
        if(isset($_POST['submit'])){
            $nama_project =  $_POST['nama'];
            $tanggal = $_POST['tanggal'];
            $webURL = $_POST['website'];
            $github = $_POST['github'];
            $thumbnailFiles = $_FILES["thumbnail"]["name"];
            $mobileFiles = $_FILES["mobile"]["name"];
            $websiteFiles = $_FILES["website"]["name"];
            $short = $_POST['deskripsi'];
            $goal = $_POST['goal'];
            move_uploaded_file($_FILES["thumbnail"]["tmp_name"],"../dokumen/".$_FILES["thumbnail"]["name"]);
            move_uploaded_file($_FILES["mobile"]["tmp_name"],"../dokumen/".$_FILES["mobile"]["name"]);
            move_uploaded_file($_FILES["website"]["tmp_name"],"../dokumen/".$_FILES["website"]["name"]);
            $queryInsert = "INSERT INTO projects 
                (project_name, project_date, project_thumbnail, project_mobile, project_website,project_explanation, project_goal, project_url, project_github) VALUES
                ('".$nama_project."','".$tanggal."','".$thumbnailFiles."', '".$mobileFiles."', '".$websiteFiles."', '".$short."', '".$goal."', '".$webURL."', '".$github."')";
            $insertProject = mysqli_query($con, $queryInsert);
            if($insertProject){
                $row = mysqli_fetch_array($insertProject);
                $last_id = mysqli_insert_id($con);
                $checkbox = $_POST['tags'];
                for ($i=0; $i<sizeof ($checkbox);$i++) {  
                    // echo $checkbox[$i];
                    $queryTags="INSERT INTO projecttags (id_project, id_tag) VALUES ('".$last_id."','".$checkbox[$i]. "')";
                    $insertTags = mysqli_query($con, $queryTags);
                    if($insertTags){
                        $msg = "Project berhasil dimasukkan";
                    }
                }  
            }else{
                $error = "Gagal Memasukkan Project";
            }
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin IRITS</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/inputPorto.css">

</head>

<body id="page-top">
    <div id="wrapper">
        <?php require 'common/sidebar.php' ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php require 'common/navbar.php' ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Portofolio</h1>
                    </div>
                </div>
                <?php if($msg){ ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Selamat </strong><?php echo htmlentities($msg)?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <?php if($error){ ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Maaf </strong><?php echo htmlentities($error)?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                <?php } ?>
                <div class="container-fluid">
                    <div class="card shadow h-100 py-3 px-3 text-dark">
                        <form method="post" enctype="multipart/form-data" name="porto">
                            <div class="row align-self-center py-1">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 inputTitle py-2">
                                            <strong>Nama Project</strong>
                                        </div>
                                        <div class="col-md-12 ">
                                            <input required type="text" name="nama" class="inputTugas py-3 px-2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 inputTitle py-2">
                                            <strong>Tanggal</strong>
                                        </div>
                                        <div class="col-md-12 ">
                                            <input  type="date" name="tanggal" value="<?php echo date('Y-m-d'); ?>"placeholder="Pilih Tanggal" class="inputTugas py-3 px-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-3">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 inputTitle py-2">
                                            <strong>Live Website</strong>
                                        </div>
                                        <div class="col-md-12">
                                            <input required name="website" type="text" placeholder="Masukkan Live Website" class="inputTugas py-3 px-2">
                                        </div>
                                    </div>
                                    <div class="row py-3">
                                        <div class="col-md-12 inputTitle py-2">
                                            <strong>Github Source Code</strong>
                                        </div>
                                        <div class="col-md-12 ">
                                            <input name="github" type="text" placeholder="Masukkan link github" class="inputTugas py-3 px-2">
                                        </div>
                                    </div>
                                    <div class="row py-3">
                                        <div class="col-md-12 inputTitle py-2">
                                            <strong>Thumbnail</strong>
                                        </div>
                                        <div class="col-md-12 ">
                                            <input required name="thumbnail" type="file" placeholder="Masukkan Thumbnail" class="inputTugas py-3 px-2">
                                        </div>
                                    </div>
                                    <div class="row py-3">
                                        <div class="col-md-12 inputTitle py-2">
                                            <strong>Gambar Mobile</strong>
                                        </div>
                                        <div class="col-md-12 ">
                                            <input required name="mobile" type="file" placeholder="Masukkan Mobile" class="inputTugas py-3 px-2">
                                        </div>
                                    </div>
                                    <div class="row py-3">
                                        <div class="col-md-12 inputTitle py-2">
                                            <strong>Gambar Website</strong>
                                        </div>
                                        <div class="col-md-12 ">
                                            <input required name="website" type="file" placeholder="Masukkan Website" class="inputTugas py-3 px-2">
                                        </div>
                                    </div>
                                    <div class="row py-3">
                                        <div class="col-md-12 inputTitle py-2">
                                            <strong>Tags</strong>
                                        </div>
                                        <div class="col-md-12 ">
                                            <div class="row">
                                                <?php 
                                                    $query = "SELECT * FROM tags";
                                                    $ret = mysqli_query($con, $query);
                                                    while($tags = mysqli_fetch_array($ret)){ ?>
                                                        <div class="col-md-3">
                                                            <input type="checkbox" id="vehicle1" name="tags[]" value="<?php echo htmlentities($tags['id_tag']) ?>">
                                                            <label for="vehicle1"> <?php echo htmlentities($tags['tag_name']); ?></label>
                                                        </div>
                                                <?php   } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 inputTitle py-2">
                                            <strong>Deskripsi Pendek</strong>
                                        </div>
                                        <div class="col-md-12" >
                                            <textarea required name="deskripsi" class="inputTugas py-3 px-2" name="" id="" cols="30" rows="11"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 inputTitle py-2">
                                            <strong>Project Goal</strong>
                                        </div>
                                        <div class="col-md-12" >
                                            <textarea required name="goal" class="inputTugas py-3 px-2" name="" id="" cols="30" rows="11"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-auto">
                                <input class="btn btn-primary" name="submit" type="submit">
                            </div>
                        </form>
                    </div>          
                </div>

            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; ianfelix.my.id 2020</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<?php    } ?>