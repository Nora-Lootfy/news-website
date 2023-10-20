<?php
require_once "../includes/connection.php";
require_once "includes/logged.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $params = [];
        $sql = "UPDATE `news_db`.`users` SET ";
        if($_SESSION["user"]["supervisor"]) {
            $fullname = $_POST["fullname"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $active = isset($_POST["active"])? 1: 0;

            if ($_POST["password"] != "**********") {
                $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $params = [$fullname, $username, $email, $active, $password];
                $sql = "UPDATE `news_db`.`users` SET `fullname`=?,`username`=?,`email`=?,`active`=?,`password`=?";
            } else {
                $params = [$fullname, $username, $email, $active];
                $sql = "UPDATE `news_db`.`users` SET `fullname`=?,`username`=?,`email`=?,`active`=?";
            }

        } elseif ($_POST["id"] == $_SESSION["user"]["id"]){ //owner
            $fields = ["fullname", "username", "email", "password"];
            foreach ($fields as $field) {
                if (isset($_POST[$field])) {
                    if($field == "password" and $_POST[$field] == "**********") {
                        continue;
                    } elseif($field == "password")  {
                        $params[] = password_hash($_POST[$field], PASSWORD_DEFAULT);
                    } elseif ($field == "active"){
                        $params[] = 1;
                    } else {
                        $params[] = $_POST[$field];
                    }

                    $sql .= "`$field`=?, ";
                }
            }
            $sql = rtrim($sql, ', ');

        } else {
            $active = isset($_POST["active"])? 1: 0;
            $sql .= "`active`=?";
            $params[] = $active;
        }

        $sql .= " WHERE id=?";
        $params[] = $_POST["id"];

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

//        echo "updated successfully";
        header("Location: users.php") or die();

    } catch (PDOException $e) {
        echo "Error in post handling edituser.php: " . $e->getMessage();
    }

} elseif (isset($_SERVER["HTTP_REFERER"]) and isset($_GET["id"])) {
    $is_supervisor = $_SESSION["user"]["supervisor"];
    $is_owner = $_SESSION["user"]["id"] == $_GET["id"];

    try {
        $id = $_GET["id"];

        $sql = "SELECT * FROM `news_db`.`users` WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        $user = $stmt->fetch();

        $supervisor_user = $user["supervisor"];

    } catch (PDOException $e) {
        echo "Error in get handling edituser.php: " . $e->getMessage();
    }

} else {
    header("Location: users.php") or die();
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

	<title>News Admin | Edit User</title>

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
						<a href="index.html" class="site_title"><i class="fa fa-newspaper-o"></i> <span>News Admin</span></a>
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
							<h3>Manage Users</h3>
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
									<h2>Edit User</h2>
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
									<form action="" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
										<div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Full Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="hidden" name="id" value="<?= $user["id"] ?>" >
                                                <input type="text" id="first-name" required="required" class="form-control " name="fullname" value="<?= $user["fullname"] ?>"
                                                        <?= ($is_supervisor or $is_owner)? "": "disabled" ?> >
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="user-name">Username <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="user-name" name="username" value="<?= $user["username"] ?>" required="required" class="form-control"
                                                    <?= ($is_supervisor or $is_owner)? "": "disabled" ?> >
											</div>
										</div>
										<div class="item form-group">
											<label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Email <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="email" class="form-control" type="email" name="email" value="<?= $user["email"] ?>" required="required"
                                                    <?= ($is_supervisor or $is_owner)? "": "disabled" ?> >
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
											<div class="checkbox">
												<label>
													<input type="checkbox" class="flat" name="active" value="active" <?= $user["active"]? "checked":"" ?> <?= ($is_supervisor or (!$supervisor_user and  !$is_owner))? "":"disabled" ?>>
												</label>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="password" id="password" name="password" required="required" class="form-control" <?= ($is_supervisor or $is_owner)? "": "disabled" ?> value="**********">
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="button" class="btn btn-primary" onclick="window.location='users.php';">Cancel</button>
												<button type="submit" class="btn btn-success">Update</button>
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
