        <footer>
            <div class="tin-footer">
                <p>© <?php $this->options->footerInfo() ?>| Powered by <a href="http://typecho.org/">Typecho</a> & <a href="https://blog.owoii.com/">StarrySky</a> | Loading time ：<?php echo timer_stop();?></p>
            </div>
        </footer>
        
    </div>
</div>

<?php $this->options->footerJs() ?>

<script src="<?php $this->options->themeUrl('style/js/viewer.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('style/js/jquery-viewer.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('style/js/style.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('style/js/i.js'); ?>"></script>

<div class="toTop">
    <span class="iconfont icon-jiantoushang"></span>
</div>
</body>
</html>