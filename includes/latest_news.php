<?php

include_once "includes/sections.php";
try {
    $sql = "SELECT news.`id`, news.`date`, news.`title`, news.`image`, news.`cat_id`, news.content, news.author, news.views, category.category
            FROM `news_db`.`news` news JOIN `news_db`.`category` category
            ON news.cat_id = category.id   
            WHERE active = 1
            ORDER BY news.date DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $row_count = $stmt->rowCount();

    $section_no = 0;
    $page = "";
    $is_without_views_begin = true;
    $iteration_number = 0;

    foreach ($stmt->fetchAll() as $news) {
        $news["date"] = date("M, d, Y", strtotime($news["date"]));
        $news["title"] = substr($news["title"], 0, 50) . "...";
        $news["content"] = substr($news["content"], 0, 100) . "...";


        if ($page_layout[$section_no][1] == 2) {
            $page .= $page_layout[$section_no][0];
            $section_no++;
        }

        if($section_no >= $section_count) {
            $section_no = 0;
        }

        if($page_layout[$section_no][1] == 1){
            if ($is_without_views_begin) {
                $page .= "<div class='col-lg-6'> ";
                $page .= replace_placeholders($page_layout[$section_no][0], $news);
                $is_without_views_begin = false;
                $page .= ($iteration_number == $row_count - 1)? "</div>":"";
            } else {
                $page .= replace_placeholders($page_layout[$section_no][0], $news);
                $page .= "</div>";
                $is_without_views_begin = true;
            }
        } else {
            $page .= replace_placeholders($page_layout[$section_no][0], $news);
        }

        $section_no++;
        $iteration_number++;

    }

} catch (PDOException $e) {
    echo "Error in handling latest_news.php: " . $e->getMessage();
}

?>

<!-- News With Sidebar Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">Latest News</h4>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                        </div>
                    </div>

                    <?= $page ?>

                </div>
            </div>
