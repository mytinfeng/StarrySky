<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('public/header.php');
 
?>


<div id="archives">
    
    <h4 class="al_year"><span class="iconfont icon-a-wenjianjiawenjian"></span><?php $this->archiveTitle(array(
            'category'  =>  _t(' %s '),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?></h4>
    <ul class="al_mon_list">
        <li>
            <ul class="al_post_list">
                
                <?php if ($this->have()): ?>
        		<?php while($this->next()): ?>
                                
                    <li><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a> <span class="tin-fl-right"><?php $this->date(); ?></span></li>
                
                <?php endwhile; ?>
                <?php else: ?>
                    <li><a href="#">此分类无文章</a></li>
                <?php endif; ?>
                
            
            </ul>
        </li>
    </ul>
</div>


<?php $this->need('public/footer.php'); ?>