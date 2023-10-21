<?php

try {
    $sql = "SELECT news.`id`, news.`date`, news.`title`, news.`image`, news.`cat_id`, category.category
            FROM `news_db`.`news` news JOIN `news_db`.`category` category
            ON news.cat_id = category.id   
            WHERE active = 1 & featured = 1 
            ORDER BY news.date DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

} catch (PDOException $e) {
    echo "Error in handling featured_news.php: " . $e->getMessage();
}

?>

<!-- Featured News Slider Start -->
<div class="container-fluid pt-5 mb-3">
    <div class="container">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">Featured News</h4>
        </div>
        <div class="owl-carousel news-carousel carousel-item-4 position-relative">
            <?php
            foreach ($stmt->fetchAll() as $featured_news):
                $date = date("M, d, Y", strtotime($featured_news["date"]))
            ?>
            <div class="position-relative overflow-hidden" style="height: 300px;">
                <img class="img-fluid h-100" src="img/<?= $featured_news["image"] ?>" style="object-fit: cover;">
                <div class="overlay">
                    <div class="mb-2">
                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                           href="/category.php?id=<?= $featured_news["cat_id"] ?>"><?= $featured_news["category"] ?></a>
                        <a class="text-white" href=""><small><?= $date ?></small></a>
                    </div>
                    <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="/single.php?id=<?= $featured_news["id"] ?>"><?= substr($featured_news["title"], 0, 50) ?>...</a>
                </div>
            </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</div>
<!-- Featured News Slider End -->
