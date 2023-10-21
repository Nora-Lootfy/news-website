<?php

$detailed_section = <<<_DETAILED_DIV
<div class="col-lg-6">
<div class="position-relative mb-3">
    <img class="img-fluid w-100" src="/img/{image}" style="object-fit: cover;" alt="">
    <div class="bg-white border border-top-0 p-4">
        <div class="mb-2">
            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
               href="/category.php?id={cat_id}">{category}</a>
            <a class="text-body" href=""><small>{date}</small></a>
        </div>
        <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="/single.php?id={id}">{title}</a>
        <p class="m-0">{content}</p>
    </div>
    <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
        <div class="d-flex align-items-center">
            <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt="">
            <small>{author}</small>
        </div>
        <div class="d-flex align-items-center">
            <small class="ml-3"><i class="far fa-eye mr-2"></i>{views}</small>
            <small class="ml-3"><i class="far fa-comment mr-2"></i>123</small>
        </div>
    </div>
</div>
</div>
_DETAILED_DIV;

$ads = <<<_ADS
<div class="col-lg-12 mb-3">
    <a href=""><img class="img-fluid w-100" src="img/ads-728x90.png" alt=""></a>
</div>
_ADS;

$section_without_content = <<<_SEMI_DETAILED_DEV
<div class="col-lg-6">
    <div class="position-relative mb-3">
        <img class="img-fluid w-100" src="/img/{image}" alt=""  style="object-fit: cover;">
        <div class="bg-white border border-top-0 p-4">
            <div class="mb-2">
                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                   href="/category.php?id={cat_id}">{category}</a>
                <a class="text-body" href=""><small>{date}</small></a>
            </div>
            <a class="h4 d-block mb-0 text-secondary text-uppercase font-weight-bold" href="{id}">{title}</a>
        </div>
        <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
            <div class="d-flex align-items-center">
                <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt="">
                <small>{author}</small>
            </div>
            <div class="d-flex align-items-center">
                <small class="ml-3"><i class="far fa-eye mr-2"></i>{views}</small>
                <small class="ml-3"><i class="far fa-comment mr-2"></i>123</small>
            </div>
        </div>
    </div>
</div>
_SEMI_DETAILED_DEV;

$without_views_section = <<<_WITHOUT_VIEWS_DIV
<div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
    <img class="img-fluid" src="/img/{image}" alt="" style="max-width: 100px;">
    <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
        <div class="mb-2">
            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href="/category.php?id={id}">{category}</a>
            <a class="text-body" href=""><small>{date}</small></a>
        </div>
        <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="/single.php?id={id}">{title}</a>
    </div>
</div>
_WITHOUT_VIEWS_DIV;

$large_section = <<<_LARGE_DIV
<div class="col-lg-12">
    <div class="row news-lg mx-0 mb-3">
        <div class="col-md-6 h-100 px-0">
            <img class="img-fluid h-100" src="/img/{image}" style="object-fit: cover;" alt="">
        </div>
        <div class="col-md-6 d-flex flex-column border bg-white h-100 px-0">
            <div class="mt-auto p-4">
                <div class="mb-2">
                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                       href="/category.php?id={cat_id}">{category}</a>
                    <a class="text-body" href=""><small>{date}</small></a>
                </div>
                <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="/single.php?id={id}">{title}</a>
                <p class="m-0">{content}</p>
            </div>
            <div class="d-flex justify-content-between bg-white border-top mt-auto p-4">
                <div class="d-flex align-items-center">
                    <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt="">
                    <small>{author}</small>
                </div>
                <div class="d-flex align-items-center">
                    <small class="ml-3"><i class="far fa-eye mr-2"></i>{views}</small>
                    <small class="ml-3"><i class="far fa-comment mr-2"></i>123</small>
                </div>
            </div>
        </div>
    </div>
</div>
_LARGE_DIV;

$page_layout = [
    [$detailed_section, 0], [$detailed_section, 0], [$ads, 2], [$section_without_content, 0] , [$section_without_content, 0] ,
    [$without_views_section, 1], [$without_views_section, 1], [$without_views_section, 1], [$without_views_section, 1],
    [$ads, 2], [$large_section, 0], [$without_views_section, 1], [$without_views_section,1], [$without_views_section,1],
    [$without_views_section, 1], [$ads, 2]
];

$section_count = count($page_layout);

function replace_placeholders($section, $assoc_array) {
    $str = $section;

    foreach ($assoc_array as $key => $value) {
        $str = str_replace("{".$key."}", $value, $str);
    }

    return $str;
}




