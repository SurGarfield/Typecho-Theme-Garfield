<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php

require_once 'libs/core.php';
require_once 'libs/Shortcode.php';
require_once 'libs/feature.php';

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $form->addInput($logoUrl);

    $beijing = new Typecho_Widget_Helper_Form_Element_Text('beijing', NULL, NULL, _t('导航下面图片'), _t('导航下面图片'));
    $form->addInput($beijing);

    $beiwenzi = new Typecho_Widget_Helper_Form_Element_Text('beiwenzi', NULL, NULL, _t('导航图片文字'), _t('导航图片文字'));
    $form->addInput($beiwenzi);

    $beian = new Typecho_Widget_Helper_Form_Element_Text('beian', NULL, NULL, _t('备案号'), _t('网站备案号，如果备案了就填写备案号，没有备案就空着'));
    $form->addInput($beian);

    $banquan = new Typecho_Widget_Helper_Form_Element_Text('banquan', NULL, NULL, _t('底部版权信息'), _t('请填写底部版权信息，例如：© 2023 森木志. All Rights Reserved.'));
    $form->addInput($banquan);
}
/**
 * 主题初始化
 */
function themeInit($archive){
    Helper::options()->commentsAntiSpam = false; //关闭反垃圾
    Helper::options()->commentsCheckReferer = false; //关闭检查评论来源URL与文章链接是否一致判断(否则会无法评论)
    Helper::options()->commentsMaxNestingLevels = '999'; //最大嵌套层数
    Helper::options()->commentsPageDisplay = 'first'; //强制评论第一页
    Helper::options()->commentsOrder = 'DESC'; //将最新的评论展示在前
    Helper::options()->commentsHTMLTagAllowed = '<a href=""> <img src=""> <img src="" class=""> <code> <del>';
    Helper::options()->commentsMarkdown = true;

}

Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('Shortcode','parseContent');//文章短代码解析
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('Shortcode','parseContent');//首页去除短代码
Typecho_Plugin::factory('Widget_Feedback')->comment_1000 = array('feature', 'insertSecret');//隐私评论
Typecho_Plugin::factory('Widget_Abstract_Comments')->contentEx = array('feature','parseContent');//评论表情


function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
 $views = Typecho_Cookie::get('extend_contents_views');
        if(empty($views)){
            $views = array();
        }else{
            $views = explode(',', $views);
        }
if(!in_array($cid,$views)){
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
        }
    }
    echo $row['views'];
}

function themeFields($layout) {
    $banner = new Typecho_Widget_Helper_Form_Element_Text('banner', NULL, NULL,_t('文章头图'), _t('输入一个图片 url，作为缩略图显示在文章列表，没有则不显示'));
    $layout->addItem($banner);
}