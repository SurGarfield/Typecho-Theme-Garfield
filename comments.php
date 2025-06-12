<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php
 $GLOBALS['isLogin'] = $this->user->hasLogin();
 $GLOBALS['rememberEmail'] = $this->remember('mail',true);
function threadedComments($comments, $options)
{
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    if ($comments->url) {
        $author = '<a href="' . $comments->url . '"' . '" target="_blank"' . ' rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }
    ?>
    <li id="li-<?php $comments->theId(); ?>" class="comment-body<?php
                                                                if ($comments->levels > 0) {
                                                                    echo ' comment-child';
                                                                    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
                                                                } else {
                                                                    echo ' comment-parent';
                                                                }
                                                                $comments->alt(' comment-odd', ' comment-even');
                                                                echo $commentClass;
                                                                ?>">
        <div id="<?php $comments->theId(); ?>">
            <?php $avatar = '//sdn.geekzu.org/avatar/' . md5(strtolower($comments->mail)) . '?s=80&r=X&d='; ?>
            <img class="avatar" src="<?php echo $avatar ?>" alt="<?php echo $comments->author; ?>" />
            <div class="comment_main">
                
                <div class="comment_meta">
                    <span class="comment_author"><?php echo $author ?></span> <span class="comment_reply"><?php $comments->reply(); ?></span>
                    
                    <div class="comment_time"><?php $comments->date(); ?></div>
                </div>
           
                <?php $parentMail = feature::get_comment_at($comments->coid)?>
                <?php echo core::postCommentContent($comments->content,$GLOBALS['isLogin'],$GLOBALS['rememberEmail'],$comments->mail,$parentMail);?>
            </div>
        </div>
        <?php if ($comments->children) { ?><div class="comment-children"><?php $comments->threadedComments($options); ?></div><?php } ?>
    </li>
<?php } ?>

<div id="comments" class="gen">
    <?php $this->comments()->to($comments); ?>

    <?php if ($this->allow('comment')) : ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>

            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                <div class="comment-inputs">
                    <?php if ($this->user->hasLogin()) : ?>
                        <p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
                    <?php else : ?>
                        <div>
                        <input type="text" name="author" id="comment-name" class="text" placeholder="<?php _e('名称'); ?>" value="<?php $this->remember('author'); ?>" required />
                    </div>
                    <div>
                        <input type="email" name="mail" id="comment-mail" class="text" placeholder="<?php _e('邮箱'); ?>" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail) : ?> required<?php endif; ?> />
                        </div>
                        <div>
                        <input type="url" name="url" id="comment-url" class="text" placeholder="<?php _e('网址'); ?>" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL) : ?> required<?php endif; ?> />
                        </div>
                            <?php endif; ?>
                </div>
                <div class="comment-editor">
                    <textarea name="text" id="textarea" class="textarea textarea_box  OwO-textarea" placeholder="撰写评论" required onkeydown="if((event.ctrlKey||event.metaKey)&&event.keyCode==13){document.getElementById('submitComment').click();return false};"><?php $this->remember('text'); ?></textarea>
                </div>
                <div class="comment-buttons">


                <div class="rko"><div class="OwO">OωO</i></div></div>

                <input type="checkbox" id="secret-button" name="secret">
                <label for="secret-button" class="slider-v3"></label>
                    <div class="right">
                        <button id="submitComment" type="submit" class="submit"><?php _e('发送'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    <?php else : ?>
        <h2>
            <center><?php _e('抱歉，评论已关闭...'); ?></center>
        </h2>
    <?php endif; ?>
    <div class="comments_lie comment-content">
    <?php if ($comments->have()) : ?>

        <?php $comments->listComments(); ?>
<div class="row">
<div class="nav-page">
            <?php $comments->pageNav('&laquo;', '&raquo;'); ?>
        </div>
</div>

    <?php endif; ?>
</div>
</div>

<?php if ($this->allow('comment')) : ?>
<script>
      var OwO_demo = new OwO({
        logo: 'OωO表情',
        container: document.getElementsByClassName('OwO')[0],
        target: document.getElementsByClassName('OwO-textarea')[0],
        api: '<?php $this->options->themeUrl('assets/OWO/OwO.json'); ?>',
        position: 'down',
        width: '100%',
        maxHeight: '250px'
    });
</script>
<?php endif; ?>