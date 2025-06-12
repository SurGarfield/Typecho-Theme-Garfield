<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
/**
 * 友情链接
 *
 * @package custom
 *
 */$this->need('header.php');
?>
<?php $this->header('commentReply=1&description=0&keywords=0&generator=0&template=0&pingback=0&xmlrpc=0&wlw=0&rss2=0&rss1=0&antiSpam=0&atom'); ?>
            <div class="bgpicture">
            <div class="bgpicture_img">
                    <img src="<?php echo $this->options->beijing ? $this->options->beijing() : $this->options->themeUrl('assets/img/default.jpg'); ?>">
                </div>
                <div class="bgpicture_box">
                    <div class="bgpicture_box_title"><span class="name"><?php $this->title() ?><span></div>
                </div>
            </div>
                <article class="post">
                    <div class="song">
                        <div class="links">

                        <?php Links_Plugin::output('<div class="links_list">
                                <div class="links_box">
                                    <a href="{url}">
                                        <img class="links_img" src="{image}">
                                        <div class="links_info">
                                            <div class="links_name">{name}</div>
                                            <div class="links_qm">{description}。</div>
                                        </div>
                                    </a>
                                </div>
                            </div>'); ?>
                            

                        </div>
                        <div id="eof"><span>EOF</span></div>
                    </div>

                    <div class="sortbar"></div>
                    <div class="commentn"><?php $this->commentsNum(_t('暂无评论'), _t('发表评论（1 条评论）'), _t('发表评论（%d 条评论）')); ?></div>
                    <?php $this->need('comments.php'); ?>
                </article>
 <?php $this->need('footer.php'); ?>