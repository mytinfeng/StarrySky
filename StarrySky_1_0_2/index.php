<?php
/**
 * 也许你厌倦了各种花里胡哨的博客主题，或许，你只是想记录一下你的生活，仅此而已
 * 
 * @package 星空写作主题
 * @author 听风 && YOU
 * @version 1.0.2
 * @link #
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('public/header.php');

 ?>
   


        <section>
            <div class="tin-user-logo">
                <img src="<?php $this->options->userLogo() ?>" alt="用户头像">
            </div>
            <div class="tin-user-autograph">
               
                <p><?php $this->options->userYiyan() ?></p>
            </div>

        </section>
        





<?php $this->need('public/footer.php'); ?>
