<?php
require_once "../includes/connection.php";
require_once "includes/logged.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if($_POST["category"] !== "") {
        try {
            require_once "includes/addimage.php";

            $date = $_POST["date"];
            $title = $_POST["title"];
            $content = $_POST["content"];
            $author = $_POST["author"];
            $active = isset($_POST["active"])? 1 : 0;
            $featured = isset($_POST["featured"])? 1 : 0;
            $breaking = isset($_POST["breaking"])? 1 : 0;
            $cat_id = $_POST["category"];


            $sql = "INSERT INTO `news_db`.`news`(`date`, `title`, `content`, `author`, `active`, `image`, `featured`, `breaking`, `cat_id`) VALUES (?, ?, ?, ? ,?, ?, ?, ? , ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$date, $title, $content, $author, $active, $image_name, $featured, $breaking, $cat_id]);

//            echo "Inserted Successfully";
            header("Location: News.php") or die();
        } catch (PDOException $e) {
            echo "Error in post handling addNews.php: " . $e->getMessage();
        }
    }

}
try {
    $sql = "SELECT * FROM `news_db`.`category`";
    $stmtCat = $conn->prepare($sql);
    $stmtCat->execute();
} catch (PDOException $e) {
    echo "Error in addNews.php: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>News Admin | Add News</title>

	<!-- Bootstrap -->
	<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- bootstrap-wysiwyg -->
	<link href="vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
	<!-- Select2 -->
	<link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet">
	<!-- Switchery -->
	<link href="vendors/switchery/dist/switchery.min.css" rel="stylesheet">
	<!-- starrr -->
	<link href="vendors/starrr/dist/starrr.css" rel="stylesheet">
	<!-- bootstrap-daterangepicker -->
	<link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="/index.php" class="site_title"><i class="fa fa-newspaper-o"></i> <span>News Admin</span></a>
					</div>

					<div class="clearfix"></div>

                    <?php
                    include_once "includes/menu_profile_quick_info.php"
                    ?>

                    <br />

                    <?php
                    include_once "includes/sidebar_menu.php";
                    ?>

                    <?php
                    include_once "includes/menu_footer.php";
                    ?>
                </div>
            </div>

            <?php
            include_once "includes/top_navigation.php";
            ?>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Manage News</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Add News</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a class="dropdown-item" href="#">Settings 1</a>
                                                </li>
                                                <li><a class="dropdown-item" href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="POST" enctype="multipart/form-data">
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="News-date">News Date <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="date" id="News-date" required="required" class="form-control " name="date">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="title" required="required" class="form-control " name="title">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="content">Content <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <textarea id="content" name="content" required="required" class="form-control">Contents</textarea>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="author" class="col-form-label col-md-3 col-sm-3 label-align">Author <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="author" class="form-control" type="text" name="author" required="required">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="flat" name="active">
                                                </label>
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Image <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="file" id="image" name="image" required="required" class="form-control">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="cat">Category <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <select class="form-control" name="category" id="cat">
                                                    <option value="">Select Category</option>
                                                    <?php
                                                    foreach ($stmtCat->fetchAll() as $category):
                                                    ?>
                                                    <option value="<?= $category["id"] ?>"><?= $category["category"] ?></option>
                                                    <?php
                                                    endforeach;
                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Featured News</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="flat" name="featured">
                                                </label>
                                            </div>
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Breaking News</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="flat" name="breaking">
                                                </label>
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 offset-md-3">
                                                <button class="btn btn-primary" type="button" onclick="window.location='News.php';">Cancel</button>
                                                <button type="submit" class="btn btn-success">Add</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

</body></html>
