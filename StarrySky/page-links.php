<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('public/header.php');
/**
 * 模板 - 友情链接
 *
 * @package custom
 */
 
?>




    <div class="post-warp">
        <div class="post-warp-content" id="viewer_img">
                <?php $this->content(); ?>
        </div>
        <div class="t-my-pl">
                <?php $this->need("comments.php"); ?>
        </div>
    </div>



<?php $this->need('public/footer.php'); ?>