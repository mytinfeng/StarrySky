<?php 
// 独立页面函数
 $this->widget('Widget_Contents_Page_List',Typecho_Db::SORT_ASC)->to($pages); 
 while($pages->next()): 
    if($pages->template=='page-file.php'){
        echo '<li><a href=" '.$pages->permalink.' " title=" '.$pages->title.' "> '.$pages->title.' </a></li>';
    }
    if($pages->template=='page-sort.php'){
        echo '<li><a href=" '.$pages->permalink.' " title=" '.$pages->title.' "> '.$pages->title.' </a></li>';
    } 
    if($pages->template=='page-links.php'){
        echo '<li><a href=" '.$pages->permalink.' " title=" '.$pages->title.' "> '.$pages->title.' </a></li>';
    } 
    if($pages->template=='page-other.php'){
        echo '<li><a href=" '.$pages->permalink.' " title=" '.$pages->title.' "> '.$pages->title.' </a></li>';
    } 
    if($pages->template=='page-about.php'){
        echo '<li><a href=" '.$pages->permalink.' " title=" '.$pages->title.' "> '.$pages->title.' </a></li>';
    } 
     
 endwhile; 

