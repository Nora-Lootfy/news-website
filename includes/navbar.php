<?php

$sql = "SELECT id, cat_id from news_db.news ORDER BY date DESC  LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->execute();

$row = $stmt->fetch();

$news_id = $row["id"];
$cat_id = $row["cat_id"];
?>
<!-- Navbar Start -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2 py-lg-0 px-lg-5">
        <a href="/index.php" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 display-4 text-uppercase text-primary">Biz<span class="text-white font-weight-normal">News</span></h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
                <a href="/index.php" class="nav-item nav-link active">Home</a>
                <a href="/category.php?id=<?= $cat_id ?>" class="nav-item nav-link">Category</a>
                <a href="/single.php?id=<?= $news_id ?>" class="nav-item nav-link">Single News</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="#" class="dropdown-item">Menu item 1</a>
                        <a href="#" class="dropdown-item">Menu item 2</a>
                        <a href="#" class="dropdown-item">Menu item 3</a>
                    </div>
                </div>
                <a href="/contact.php" class="nav-item nav-link">Contact</a>
            </div>
            <div class="input-group ml-auto d-none d-lg-flex" style="width: 100%; max-width: 300px;">
                <input type="text" class="form-control border-0" placeholder="Keyword">
                <div class="input-group-append">
                    <button class="input-group-text bg-primary text-dark border-0 px-3"><i
                            class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->

<script>
    anchors = Array.from(document.getElementsByClassName("nav-item nav-link"))

    anchors.forEach(function (anchor) {
        if (anchor.href === window.location.href) {
            anchor.className = "nav-item nav-link active"
        } else {
            anchor.className = "nav-item nav-link"
        }
    })

</script>