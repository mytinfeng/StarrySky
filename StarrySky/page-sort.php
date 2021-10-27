<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('public/header.php');
/**
 * 模板 - 分类页面
 *
 * @package custom
 */
 

?>

<section>
    <div class="tin-page-sort">
        <div class="row">
            
            
                
                <?php
                Typecho_Widget::widget('Widget_Metas_Category_List')->to($tobjs);
                if($tobjs->have()){
                    while($tobjs->next()):
                 ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="tin-page-sort-list">
                        <div class="tin-page-sort-list-title">
                            <h4><span class="iconfont icon-a-wenjianjiawenjian"></span>&nbsp;<?php $tobjs->name() ?></h4>
                        </div>
                        <div class="tin-page-sort-list-content">
                            <ul>
                                <?php 
                                $wzarr = mou($tobjs->mid);
                                if(empty($wzarr)){
                                     echo "<li><a href='#'>此分类无文章</a></li>";
                                }else{
                                    foreach($wzarr as $key => $val){
                                        if(!empty($val)){
                                            $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
                                            echo "<li><a href='".$val['permalink']."'>".$val['title']."</a></li>";
                                        }
                                        
                                    }
                                }
                                
                                ?>
                            </ul>
                            <p>
                                <a href="<?php $tobjs->permalink() ?>">More >></a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                    endwhile;
                }else{
                ?>
                <div class="col-md-4 col-sm-6">
                    <div class="tin-page-sort-list">
                        <div class="tin-page-sort-list-title">
                            <h4>无分类</h4>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                
                
            
         </div>
    </div>
</section>


<?php $this->need('public/footer.php'); ?>