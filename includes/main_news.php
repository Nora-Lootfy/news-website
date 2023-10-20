<?php
require_once "includes/connection.php";

try {
    $sql = "SELECT news.`id`, news.`date`, news.`title`, news.`image`, news.`cat_id`, category.category
            FROM `news_db`.`news` news JOIN `news_db`.`category` category
            ON news.cat_id = category.id 
            WHERE news.active = 1
            ORDER BY news.date DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();
    $news_list = $stmt->fetchAll();

} catch (PDOException $e) {
    echo "Error in handling main_news.php: " . $e->getMessage();
}

?>
<!-- Main News Slider Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 px-0">
            <div class="owl-carousel main-carousel position-relative">
                <?php
                if ($count > 4) :
                for ($i=0; $i < $count - 4; $i++):
                $date = date("M, d, Y", strtotime($news_list[$i]["date"]))
                ?>
                <div class="position-relative overflow-hidden" style="height: 500px;">
                    <img class="img-fluid h-100" src="/img/<?= $news_list[$i]["image"] ?>" style="object-fit: cover;" alt="">
                    <div class="overlay">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                               href="/category.php?id=<?=$news_list[$i]["cat_id"]?>"><?= $news_list[$i]["category"] ?></a>
                            <a class="text-white" href=""><?= $date ?></a>
                        </div>
                        <a class="h2 m-0 text-white text-uppercase font-weight-bold" href="/single.php?id=<?=$news_list[$i]["id"]?>"><?= substr($news_list[$i]["title"], 0, 50) ?>...</a>
                    </div>
                </div>
                <?php
                endfor;
                else:
                for ($i=0; $i < $count; $i++):
                $date = date("M, d, Y", strtotime($news_list[$i]["date"]));
                ?>
                <div class="position-relative overflow-hidden" style="height: 500px;">
                    <img class="img-fluid h-100" src="/img/<?= $news_list[$i]["image"] ?>" style="object-fit: cover;" alt="">
                    <div class="overlay">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                               href="/category.php?id=<?=$news_list[$i]["cat_id"]?>"><?= $news_list[$i]["category"] ?></a>
                            <a class="text-white" href=""><?= $date ?></a>
                        </div>
                        <a class="h2 m-0 text-white text-uppercase font-weight-bold" href="/single.php?id=<?=$news_list[$i]["id"]?>"><?= substr($news_list[$i]["title"], 0, 50) ?>...</a>
                    </div>
                </div>
                <?php
                endfor;
                endif;
                ?>
            </div>
        </div>
        <div class="col-lg-5 px-0">
            <div class="row mx-0">
                <?php
                if ($count > 4) :
                    for ($i=$count - 4; $i < $count; $i++):
                        $date = date("M, d, Y", strtotime($news_list[$i]["date"]))
                ?>
                <div class="col-md-6 px-0">
                    <div class="position-relative overflow-hidden" style="height: 250px;">
                        <img class="img-fluid w-100 h-100" src="/img/<?= $news_list[$i]["image"] ?>" style="object-fit: cover;" alt="">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                   href="/category.php?id=<?=$news_list[$i]["cat_id"]?>"><?= $news_list[$i]["category"] ?></a>
                                <a class="text-white" href=""><small><?= $date ?></small></a>
                            </div>
                            <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="/single.php?id=<?=$news_list[$i]["id"]?>"><?= substr($news_list[$i]["title"], 0, 50) ?>...</a>
                        </div>
                    </div>
                </div>
                <?php
                endfor;
                else:
                    for ($i=0; $i < $count; $i++):
                        $date = date("M, d, Y", strtotime($news_list[$i]["date"]));
                ?>
                <div class="col-md-6 px-0">
                    <div class="position-relative overflow-hidden" style="height: 250px;">
                        <img class="img-fluid w-100 h-100" src="/img/<?= $news_list[$i]["image"] ?>" style="object-fit: cover;" alt="">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                   href="/category.php?id=<?=$news_list[$i]["cat_id"]?>"><?= $news_list[$i]["category"] ?></a>
                                <a class="text-white" href=""><small><?= $date ?></small></a>
                            </div>
                            <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="/single.php?id=<?=$news_list[$i]["id"]?>"><?= substr($news_list[$i]["title"], 0, 50) ?>...</a>
                        </div>
                    </div>
                </div>
                <?php
                endfor;
                endif;
                ?>

            </div>
        </div>
    </div>
</div>
<!-- Main News Slider End -->
