<?php 
echo !defined('security') ? die() : null;
include("connect/function.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="<?php echo $a_row->site_title; ?>" />
    <meta name="description" content="<?php echo $title['desc']; ?>">
    <meta name="keywords" content="<?php echo $title['tags']; ?>">
    <!-- Document title -->
    <title><?php echo $title['title']; ?></title>
    <!-- Stylesheets & Fonts -->
    <link href="css/plugins.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="js/sweetalert/sweetalert.css">
    <link rel="icon" type="image/png" href="<?php echo $a_row->site_url;?>/images/<?php echo $a_row->site_favicon;?>">

    <meta name="google-site-verification" content="<?php echo $a_row->google_code;?>"/>
    <meta name="msvalidate.01" content="<?php echo $a_row->bing_code;?>"/>
    <meta name="yandex-verification" content="<?php echo $a_row->yandex_code;?>"/>
    <meta name="robots" content="index, follow"/>

</head>

<body data-animation-in="fadeIn"  data-animation-out="fadeOut" data-icon="2" data-icon-color="#072a16" data-speed-in="1000" data-speed-out="1000">

    <!-- Body Inner -->
    <div class="body-inner">