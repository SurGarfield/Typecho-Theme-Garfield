<?php
/**
 * 一个简约优雅的Typecho主题
 *
 * @package Garfield
 * @author 森木志
 * @version 1.0.2
 * @link https://oxxx.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>


            <div class="bgpicture">
                <div class="bgpicture_img">
                    <img src="<?php echo $this->options->beijing ? $this->options->beijing() : $this->options->themeUrl('assets/img/default.jpg'); ?>">
                </div>
                <div class="bgpicture_box">
                    <div class="bgpicture_box_title"><span class="name"><?php echo $this->options->beiwenzi ? $this->options->beiwenzi() : '等风来，不如追风去'; ?></span></div>
                </div>
            </div>

            <div class="index_ajax">
                <?php while($this->next()): ?>
                <article class="index_list">
                    <h2 class="index_list_title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
                    <div class="index_list_excerpt">
                        <?php $this->excerpt(120);?>
                    </div>
                    <div class="index_list_footer">
                        <span><time itemprop="datePublished" datetime="<?php $this->date('Y.m.d'); ?>"><?php $this->date('Y.m.d'); ?></time></span>
                        <span><?php get_post_view($this) ?> 阅</span>
                        <span><?php $this->category(','); ?></span>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>

            <div class="paging">
                <?php $this->pageLink('点击查看更多','next'); ?>
            </div>

            <div class="row">
            <div class="nav-page">
            <?php $this->pageNav('&laquo;', '&raquo;'); ?>
            </div>
            </div>



            <?php $this->need('footer.php'); ?>

