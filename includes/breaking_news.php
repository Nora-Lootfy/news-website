<?php
require_once "includes/connection.php";

try {
    $sql = "SELECT title, id 
            FROM `news_db`.`news` 
            WHERE active = 1 & breaking = 1 ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

} catch (PDOException $e) {
    echo "Error in handling breaking_news.php: " . $e->getMessage();
}
?>

<!-- Breaking News Start -->
<div class="container-fluid bg-dark py-3 mb-3">
    <div class="container">
        <div class="row align-items-center bg-dark">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">Breaking News</div>
                    <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                         style="width: calc(100% - 170px); padding-right: 90px;">
                        <?php
                        foreach ($stmt->fetchAll() as $breaking_news):
                        ?>
                        <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold" href="/single.php?id=<?=$breaking_news["id"]?>"><?= $breaking_news["title"] ?></a></div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breaking News End -->