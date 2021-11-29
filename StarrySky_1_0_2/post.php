<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
$this->need('public/header.php');


 ?>
    


    <section>
        <div class="post-warp">
            
            <div class="post-warp-title">
                <h4><?php $this->title() ?></h4>
            </div>
            <div class="post-warp-info">
                <p>作者 by <?php $this->author(); ?> / <?php $this->date(); ?> / <?php $this->commentsNum(_t('暂无评论'), _t('1 评论'), _t('%d 评论')); ?> / <?php echo Postviews($this); ?></p>
            </div>
            
            <div class="post-warp-content" id="viewer_img">
                <?php $this->content(); ?>
            </div>
            
            <div class="post-tag">
                <span class="iconfont icon-tubiao_biaoqian"></span><?php $this->tags('</a><a>', true, '无'); ?>
            </div>
            
            <div class="t-my-pl">
                <?php $this->need("comments.php"); ?>
            </div>
            
            
            
            
        </div>
    </section>
    




<script>
    $(function(){
        $("table").addClass('table table-striped t-table');
    })
</script>
<?php $this->need('public/footer.php'); ?>
