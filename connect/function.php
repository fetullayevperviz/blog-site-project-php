<?php

require_once 'dbcon.php';

function post($parametr, $condition = false){
    if( $condition == false ){
        $result = strip_tags(trim($_POST[$parametr]));
    }elseif( $condition == true ){
        $result = strip_tags(trim(addslashes($_POST[$parametr])));
    }
    return $result;
}

function IP(){

    if(getenv("HTTP_CLIENT_IP")){
        $ip = getenv("HTTP_CLIENT_IP");
    }elseif(getenv("HTTP_X_FORWARDED_FOR")){
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode (',', $ip);
            $ip = trim($tmp[0]);
        }
    }else{
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}

function pagination($s, $ptotal, $url){
    global $site;

    $forlimit = 3;
    if($ptotal < 2){
        null;
    }else{

        if($s > 4){
            $prev  = $s - 1;
            echo '<li class="page-item"><a class="page-link" href="'.$site.'/'.$url.'1" ><i class="fa fa-angle-left"></i></a></li>';
            echo '<li class="page-item"><a class="page-link" href="'.$site.'/'.$url.($s-1).'" ><</a></li>';
        }

        for($i = $s - $forlimit; $i < $s + $forlimit + 1; $i++){
            if($i > 0 && $i <= $ptotal){
                if($i == $s){
                    echo '<li class="page-item active"><a class="page-link"  href="#">'.$i.'</a></li>';
                }else{
                    echo '<li class="page-item"><a class="page-link" href="'.$site.'/'.$url.$i.'" >'.$i.'</a></li>';
                }
            }
        }

        if($s <= $ptotal - 4){
            $next  = $s + 1;
            echo '<li class="page-item"><a class="page-link" href="'.$site.'/'.$url.$next.'" > <i class="fa fa-angle-right"></i></a></li>';
            echo '<li class="page-item"><a class="page-link" href="'.$site.'/'.$url.$ptotal.'" >»</a></li>';
        }
    }

}


function chef_link($str){
    $preg = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#', '.');
    $match = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp', '');
    $perma = strtolower(str_replace($preg, $match, $str));
    $perma = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $perma);
    $perma = trim(preg_replace('/\s+/', ' ', $perma));
    $perma = str_replace(' ', '-', $perma);
    return $perma;
}


function tags()
{
  global $db;
  global $site;

  $request=$db->prepare("SELECT text_id, text_tags FROM articles WHERE text_status=:text_status ORDER BY text_id DESC LIMIT :lim");
  $request->bindValue(':text_status',(int) 1, PDO::PARAM_INT);
  $request->bindValue(':lim',(int) 3, PDO::PARAM_INT);
  $request->execute();
  if($request->rowCount())
  {
    $arr=array();
    foreach ($request as $row)
    {
        $tags=$row['text_tags'];
        $exp =explode(',', $tags);
        foreach ($exp as $tag) 
        {
           $arr[]='<a title="'.$tag.'" href="'.$site.'/tagdetails.php?tag='.chef_link($tag).'">'.$tag.'</a>';
        }
    }

    $arr=array_unique($arr);
    foreach ($arr as $tags_info) 
    {
        echo $tags_info;
    }
  }
}


function title()
{
    global $db;
    global $site_title;
    global $site;
    global $logo;
    global $site_keyword;
    global $site_desc;

    $text_chef= @$_GET['text_chef'];
    $cat_chef = @$_GET['cat_chef'];
    $search   = @$_GET['search'];
    $tag      = @$_GET['tag'];

    if($text_chef)
    {
       $text=$db->prepare("SELECT * FROM articles WHERE text_chef=:text_chef 
            AND text_status=:text_status");
       $text->execute([':text_chef'=>$text_chef, ':text_status'=>1]);
       $text_row=$text->fetch(PDO::FETCH_OBJ);

       $title['title']=$text_row->text_title." - ".$site_title;
       $title['image']=$site."/images/".$text_row->text_image;
       $title['tags'] =$text_row->text_tags;
       $title['desc'] =mb_substr($text_row->text_content, 0,150);
    }
    else if($cat_chef)
    {
        $categories=$db->prepare("SELECT * FROM categories WHERE cat_chef=:cat_chef");
        $categories->execute([':cat_chef'=>$cat_chef]);
        $cat_row=$categories->fetch(PDO::FETCH_OBJ);

        $title['title'] = $cat_row->cat_name." - ".$site_title;
        $title['image'] = $site.'/images/'.$logo;
        $title['tags']  = $cat_row->cat_keyword;
        $title['desc']  = $cat_row->cat_desc;
    }
    else if($search)
    {
        $title['title'] = $search." - ".$site_title;
        $title['image'] = $site.'/images/'.$logo;
        $title['tags']  = $site_keyword;
        $title['desc']  = $site_desc;
    }
    else if($tag)
    {
        $title['title'] = $tag." - ".$site_title;
        $title['image'] = $site.'/images/'.$logo;
        $title['tags']  = $site_keyword;
        $title['desc']  = $site_desc;
    }
    else
    {
        $title['title'] = $site_title;
        $title['image'] = $site.'/images/'.$logo;
        $title['tags']  = $site_keyword;
        $title['desc']  = $site_desc;
    }
    return $title;
}

$title=title();

?>