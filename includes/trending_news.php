<?php

try {
    $sql = "SELECT news.`id`, news.`date`, news.`title`, news.`image`, news.`cat_id`, category.category
            FROM `news_db`.`news` news JOIN `news_db`.`category` category
            ON news.cat_id = category.id   
            WHERE active = 1  
            ORDER BY news.views DESC LIMIT 5";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

}  catch (PDOException $e) {
    echo "Error in handling trending_news.php: " . $e->getMessage();
}


?>

<!-- Popular News Start -->
<div class="mb-3">
    <div class="section-title mb-0">
        <h4 class="m-0 text-uppercase font-weight-bold">Trending News</h4>
    </div>

    <div class="bg-white border border-top-0 p-3">

        <?php
        foreach ($stmt->fetchAll() as $trending_news):
            $date = date("M, d, Y", strtotime($trending_news["date"]));
        ?>
        <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
            <img class="img-fluid" src="img/<?= $trending_news["image"] ?>" alt="" style="max-width: 100px;">
            <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                <div class="mb-2">
                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="/category.php?id=<?= $trending_news["cat_id"] ?>"><?= $trending_news["category"] ?></a>
                    <a class="text-body" href=""><small><?= $date?></small></a>
                </div>
                <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="/single.php?id=<?= $trending_news["id"] ?>"><?= substr($trending_news["title"], 0, 50) ?>...</a>
            </div>
        </div>
        <?php
        endforeach;
        ?>

    </div>
</div>
<!-- Popular News End -->
