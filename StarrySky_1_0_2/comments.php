<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<script type="text/javascript">
function showhidediv(id){var sbtitle=document.getElementById(id);if(sbtitle){if(sbtitle.style.display=='flex'){sbtitle.style.display='none';}else{sbtitle.style.display='flex';}}}
(function(){window.TypechoComment={dom:function(id){return document.getElementById(id)},pom:function(id){return document.getElementsByClassName(id)[0]},iom:function(id,dis){var alist=document.getElementsByClassName(id);if(alist){for(var idx=0;idx<alist.length;idx++){var mya=alist[idx];mya.style.display=dis}}},create:function(tag,attr){var el=document.createElement(tag);for(var key in attr){el.setAttribute(key,attr[key])}return el},reply:function(cid,coid){var comment=this.dom(cid),parent=comment.parentNode,response=this.dom("<?php echo $this->respondId(); ?>"),input=this.dom("comment-parent"),form="form"==response.tagName?response:response.getElementsByTagName("form")[0],textarea=response.getElementsByTagName("textarea")[0];if(null==input){input=this.create("input",{"type":"hidden","name":"parent","id":"comment-parent"});form.appendChild(input)}input.setAttribute("value",coid);if(null==this.dom("comment-form-place-holder")){var holder=this.create("div",{"id":"comment-form-place-holder"});response.parentNode.insertBefore(holder,response)}comment.appendChild(response);this.iom("comment-reply","");this.pom("cp-"+cid).style.display="none";this.iom("cancel-comment-reply","none");this.pom("cl-"+cid).style.display="";if(null!=textarea&&"text"==textarea.name){textarea.focus()}return false},cancelReply:function(){var response=this.dom("<?php echo $this->respondId(); ?>"),holder=this.dom("comment-form-place-holder"),input=this.dom("comment-parent");if(null!=input){input.parentNode.removeChild(input)}if(null==holder){return true}this.iom("comment-reply","");this.iom("cancel-comment-reply","none");holder.parentNode.insertBefore(response,holder);return false}}})();
</script>

<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
 
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
?>
 
<!---------------------------------------------------------------分割线-------------------------------------------------------->

<div id="li-<?php $comments->theId(); ?>" class="t-comment-yi comment<?php 
if ($comments->levels > $comments->theId()) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
    echo $comments->levels;
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <ul class="t-comment-list-bolck comment-body" id="<?php $comments->theId(); ?>">
        <li>
            <div class="t-comment-user-img" style="background: url('<?php headportrait($comments->mail) ?>');">
            </div>
            <div class="t-comment-user-name">
                <h5><?php $comments->author(); ?></h5>
                <p><?php $comments->date('Y-m-d H:i'); ?></p>
            </div>
            
            <div class="t-comment-content">
               <?php $parentMail = get_comment_at($comments->coid)?><?php echo $parentMail;?>&nbsp;<?php $comments->content(); ?> 
            </div>
            
            <div class="t-comment-reply">
                 <i class="iconfont icon-a-EditSquare"></i>
                 <span class="comment-reply cp-<?php $comments->theId(); ?> text-muted comment-reply-link"><?php $comments->reply('回复'); ?></span><span id="cancel-comment-reply" class="cancel-comment-reply cl-<?php $comments->theId(); ?> text-muted comment-reply-link" style="display:none" ><?php $comments->cancelReply(); ?></span>
            </div>
            
             
        </li>
    </ul>
    <?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
    <?php } ?>
   
</div>




<?php } ?>


<div id="comments" class="t-article-comment">
    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>
    
    <div class="t-comment-title">
        <h4>独特见解</h4>
    </div>

    <div class="t-comment-form" id="<?php $this->respondId(); ?>">
        

        
        <form method="post" action="<?php $this->commentUrl() ?>">
            <div>
                <textarea class="t-comment-textarea" name="text" rows="3" placeholder="也许你会说说你的见解..."></textarea>
            </div>
            <div class="re_face"><div id="showfacenamereplace" class="re_img"></div></div>
            
            <?php if ($this->user->hasLogin()) : ?>
            <div class="t-comment-user">
                <div class="row">
                    <input type="hidden"  name="author" placeholder="* 昵称" value="<?php $this->user->screenName(); ?>">
                    <input type="hidden" name="mail" placeholder="* 邮箱" value="<?php $this->user->mail(); ?>">
                    <input type="hidden" name="url">
                    <div class="col-md-8">
                        <p><i class="iconfont icon-renyuan"></i>&nbsp;&nbsp;欢迎回来，<?php $this->user->screenName(); ?></p>
                    </div>
                    <div class="col-md-4 t-comment-btn">
                        <input type="submit" value="发表评论">
                    </div>
                </div>
            </div>
            <?php else : ?>
            <div class="t-comment-user">
                <div class="row">
                    <div class="col-md-4 col-xs-6">
                        <input type="text"  name="author" placeholder="* 昵称" value="<?php $this->remember('author'); ?>">
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <input type="text" name="mail" placeholder="* 邮箱" value="<?php $this->remember('mail'); ?>">
                    </div>
                    <input type="hidden" name="url">
                    <div class="col-md-4 t-comment-btn">
                        <input type="submit" value="发表评论">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
        </form>
    </div>
    
    
    
    
    
    
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
    <?php if ($comments->have()): ?>
    <div class="t-comment-list-title">
        <h5 class="comments-title"><i class="iconfont icon-a-MoreCircle"></i>&nbsp<?php $this->commentsNum(_t('评论 0 条'), _t('评论 1 条'), _t('评论 %d 条')); ?></h5>
    </div>
        
    <div class="t-comment-list-a">
    
    <?php $comments->listComments(); ?>
    
    </div>

    <?php $comments->pageNav('←','→','2','...'); ?>
    
    <?php endif; ?>

</div>