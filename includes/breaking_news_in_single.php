<?php

try {
    $sql = "SELECT title, id 
            FROM `news_db`.`news` 
            WHERE active = 1 & breaking = 1
            ORDER BY date DESC
            LIMIT 5";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

} catch (PDOException $e) {
    echo "Error in handling breaking_news_in_single.php: " . $e->getMessage();
}

?>
<!-- Breaking News Start -->
<div class="container-fluid mt-5 mb-3 pt-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <div class="section-title border-right-0 mb-0" style="width: 180px;">
                        <h4 class="m-0 text-uppercase font-weight-bold">Trending</h4>
                    </div>
                    <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center bg-white border border-left-0"
                         style="width: calc(100% - 180px); padding-right: 100px;">
                        <?php
                        foreach ($stmt->fetchAll() as $breaking_news):
                            ?>
                            <div class="text-truncate"><a class="text-secondary text-uppercase font-weight-semi-bold" href="/single.php?id=<?=$breaking_news["id"]?>"><?= $breaking_news["title"] ?></a></div>
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
