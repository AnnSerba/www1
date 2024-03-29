<?php
session_start();
    if (isset($_SESSION["type"])){
        if ($_SESSION["type"] != "admin"){
            echo "<script>location.href='../index.php'</script>";
        }
    } else {
        echo "<script>location.href='../index.php'</script>";
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">SB Admin</a>
            </div>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li >
                        <a href="index.php"> Редактор блога </a>
                    </li>
                    <li class="active">
                        <a href="guest.php"> Файл гостевой книги </a>
                    </li>
                    <li>
                        <a href="visitings.php?begin=0"> Посещения </a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
                <form  method=post enctype=multipart/form-data action = "guest.php">
                    <input type=file name="uploadfile">
                    <input type=submit value=Загрузить name = "submit">
                </form>
                <?php
                include_once("../php/dedugan.php");
                $pd = connectDB();
                if (isset($_FILES['uploadfile'])) {
                    $f = file_get_contents($_FILES['uploadfile']['tmp_name']);
                    unset($_FILES['uploadfile']);
                    $comments = explode(";", $f);
                    $i = 0;
                    foreach ($comments as $val) {
                        $comment = explode(",", $val);
                        if (count($comment) != 4)
                            continue;
                        else {
                            $i++;
                            $comm = new CommentRecord("comments", $comment[0], $comment[1], $comment[2], $comment[3]);
                            $comm->save($pd);
                        }
                    }
                    echo "Было добавлено ".$i." записей. ";
                }
                ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
