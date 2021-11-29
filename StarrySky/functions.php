<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO '), _t('填写文字'));
    $form->addInput($logoUrl);
    
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('站点 favicon 地址'), _t('请输入favicon网址，带http(s)://'));
    $form->addInput($favicon);
    
    
    $userLogo = new Typecho_Widget_Helper_Form_Element_Text('userLogo', NULL, NULL, _t('首页头像'), _t('请输入完整版图片网址，带http(s)://'));
    $form->addInput($userLogo);
    
    $userYiyan = new Typecho_Widget_Helper_Form_Element_Text('userYiyan', NULL, NULL, _t('首页展示的一言'), _t('首页展示的一言'));
    $form->addInput($userYiyan);
    
    $footerInfo = new Typecho_Widget_Helper_Form_Element_Text('footerInfo', NULL, NULL, _t('底部版权信息'), _t('底部版权信息'));
    $form->addInput($footerInfo);
    
    $footerJs = new Typecho_Widget_Helper_Form_Element_Text('footerJs', NULL, NULL, _t('自定义JS或者CSS'), _t('自定义JS或者CSS'));
    $form->addInput($footerJs);
}


/*
function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $layout->addItem($logoUrl);
}
*/

//分类底下的文章；直接在文章调用mou(分类id)
function mou($mid=NULL){
    if(empty($mid)){
        $mid = 1;
    }
    $db = Typecho_Db::get();
    $query = $db->select()->from('table.contents')->join('table.relationships', 'table.contents.cid = table.relationships.cid',Typecho_Db::LEFT_JOIN)->where('table.contents.type = ?', 'post')->where('table.relationships.mid = ?', $mid)->limit('5')->order('table.contents.cid',Typecho_Db::SORT_DESC);
    
    $arr =  $db->fetchAll($query);
    
    return $arr;


}


/**
* 页面加载时间
*/
function timer_start() {
global $timestart;
$mtime = explode( ' ', microtime() );
$timestart = $mtime[1] + $mtime[0];
return true;
}
timer_start();
function timer_stop( $display = 0, $precision = 3 ) {
global $timestart, $timeend;
$mtime = explode( ' ', microtime() );
$timeend = $mtime[1] + $mtime[0];
$timetotal = number_format( $timeend - $timestart, $precision );
$r = $timetotal < 1 ? $timetotal * 1000 . " ms" : $timetotal . " s";
if ( $display ) {
echo $r;
}
return $r;
}

/*解析QQ头像*/
function headportrait($obj){
        
    $reg='/^([1-9][0-9]{4,11})@qq.com$/';
    
    if(preg_match($reg,$obj)){
        
        $qq = preg_replace("/@qq.com/","",$obj);
        
        $qqavatar = file_get_contents('http://ptlogin2.qq.com/getface?appid=1006102&imgtype=3&uin='.$qq);
        
        $arrs = str_replace("pt.setHeader","qqavatarCallBack",$qqavatar);
        
        $arr=explode('"',$arrs);
        
        echo($arr[3]);
        
        
  
    }else{
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
        $color = $rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
        echo "https://api.prodless.com/avatar.png?backgroundColor=".$color."&color=fff"; 

    }
    
}

function duNav(){
    $db = Typecho_Db::get();
    $query = $db->select()
->from('table.contents')
->where('table.contents.type = ?', 'page')->order('cid',Typecho_Db::SORT_ASC);
    
    $arr =  $db->fetchAll($query);
    
    foreach($arr as $k=>$val){
        $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
         echo '<li><a href=" '.$val['permalink'].' " title=" '.$val['title'].' "> '.$val['title'].' </a></li>';
    }
}

//获取评论的锚点链接
function get_comment_at($coid)
{
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent,status')->from('table.comments')
        ->where('coid = ?', $coid));//当前评论
    $mail = "";
    $parent = @$prow['parent'];
    if ($parent != "0") {//子评论
        $arow = $db->fetchRow($db->select('author,status,mail')->from('table.comments')
            ->where('coid = ?', $parent));//查询该条评论的父评论的信息
        @$author = @$arow['author'];//作者名称
        $mail = @$arow['mail'];
        if(@$author && $arow['status'] == "approved"){//父评论作者存在且父评论已经审核通过
            if (@$prow['status'] == "waiting"){
                echo '<p class="commentReview">'._mt("（评论审核中）").'</p>';
            }
            echo '<a href="#comment-' . $parent . '">@' . $author . '</a>';
        }else{//父评论作者不存在或者父评论没有审核通过
            if (@$prow['status'] == "waiting"){
                echo '<p class="commentReview">'._mt("（评论审核中）").'</p>';
            }else{
                echo '';
            }

        }

    } else {//母评论，无需输出锚点链接
        if (@$prow['status'] == "waiting"){
            echo '<p class="commentReview">'._mt("（评论审核中）").'</p>';
        }else{
            echo '';
        }
    }

}


/**
// 缓存放入头部 **bug太多，废弃
function cache(){
        

        //获取域名后面几位，正则替换，把/和.替换成@
        $string = $_SERVER['REQUEST_URI'];
        $stringx =  explode("?",$string);
        $replacement = '@';
        $pattern = '/\//i';
        $pattern1 = '/\./i';
        $string1 =  preg_replace($pattern, $replacement, $stringx[0]);
        $string2 =  preg_replace($pattern1, $replacement, $string1);
        
        //当前文件地址
        $file = "usr/themes/StarrySky/cache/".$string2.".txt";
        
        //获取当前完整地址
        $eUrl = (isHTTPS() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
        
        
        //get写入命令
        $cachexr = $_GET['cachexr'];
        
        
        

        //判断文件在不在
        
        if(!file_exists($file))
        {
            //"当前目录中，文件不存在",新写入一个空文件先
            $myfile = fopen($file, "w") or die("Unable to open file!");
            $txt = '';
            fwrite($myfile, $txt);
            //记得关闭流
            fclose($myfile);
            //get更新缓存
            //get一个写入命令，获取值，并且写入
            $content = file_get_contents($eUrl.'?cachexr=ok');
            $myfile = fopen($file, "a") or die("Unable to open file!");
            $txt = $content;
            fwrite($myfile, $txt);
            fclose($myfile);
            
        }else{
            if($cachexr!=='ok'){
                // 文件存在
                $jc = file_get_contents($file); //将整个文件内容读入到一个字符串中
                echo $jc;
                exit;
            }
            
        }
        
    

}

**/

//获取当前域名
function isHTTPS()
{
    if (defined('HTTPS') && HTTPS) return true;
    if (!isset($_SERVER)) return FALSE;
    if (!isset($_SERVER['HTTPS'])) return FALSE;
    if ($_SERVER['HTTPS'] === 1) {  //Apache
        return TRUE;
    } elseif ($_SERVER['HTTPS'] === 'on') { //IIS
        return TRUE;
    } elseif ($_SERVER['SERVER_PORT'] == 443) { //其他
        return TRUE;
    }
    return FALSE;
}

/*文章阅读次数*/
/*<?php echo Postviews($this); ?>*/
function Postviews($archive) {
    $db = Typecho_Db::get();
    $cid = $archive->cid;
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `'.$db->getPrefix().'contents` ADD `views` INT(10) DEFAULT 0;');
    }
    $exist = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid))['views'];
    if ($archive->is('single')) {
        $cookie = Typecho_Cookie::get('contents_views');
        $cookie = $cookie ? explode(',', $cookie) : array();
        if (!in_array($cid, $cookie)) {
            $db->query($db->update('table.contents')
                ->rows(array('views' => (int)$exist+1))
                ->where('cid = ?', $cid));
            $exist = (int)$exist+1;
            array_push($cookie, $cid);
            $cookie = implode(',', $cookie);
            Typecho_Cookie::set('contents_views', $cookie);
        }
    }
    echo $exist == 0 ? '没人来访过' : $exist.' 个足迹';
}