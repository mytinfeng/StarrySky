<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('public/header.php');
/**
 * 模板 - 归档页面
 *
 * @package custom
 */
 
?>



<div id="nian-archives">
    <h4 class="al_year"><span class="iconfont icon-a-wenjianjiawenjian"></span>&nbsp;快速选择年份</h4>
    <ul class="al_mon_list tin-nf">
        
<?php  

$obj = $this->widget('Widget_Contents_Post_Date');
?>




<?php 

if($obj->have()){
    $listArr = array();
    while($obj->next()){
    $listArr[] .= $obj->year;
    }
    
    $listArr = array_unique($listArr);

    foreach ( $listArr as $key => $value){
    ?>
        <li data-nian='<?php echo $value; ?>'><?php echo $value; ?>&nbsp;年</li>
    <?php
    };
    
    
    
}else{
    echo '<li>无文章</li>';
}

?>


    </ul>
</div>





<?php
 
    $this->widget('Widget_Contents_Post_Recent', 'pageSize=100000')->to($archives);   
    $year=0; $mon=0; $i=0; $j=0;   
    $output = '<div id="archives">';   
    while($archives->next()):   
        $year_tmp = date('Y',$archives->created);   
        $mon_tmp = date('m',$archives->created);   
        $y=$year; $m=$mon;   
        if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';   
        if ($year != $year_tmp && $year > 0) $output .= '</ul>';   
        if ($year != $year_tmp) {   
            $year = $year_tmp;   
            $output .= '<h4 class="al_year nian-'.$year.'">'. $year .' 年</h4><ul class="al_mon_list">'; //输出年份   
        }   
        if ($mon != $mon_tmp) {   
            $mon = $mon_tmp;   
            $output .= '<li><span class="al_mon">'. $mon .' 月</span><ul class="al_post_list">'; //输出月份   
        }   
        $output .= '<li><a href="'.$archives->permalink .'">'. $archives->title .'</a> <span class="tin-fl-right">'.date('d',$archives->created).'&nbsp;day</span</li>'; //输出文章日期和标题   
    endwhile;   
    $output .= '</ul></li></ul></div>';
    echo $output;
?>



<?php $this->need('public/footer.php'); ?>