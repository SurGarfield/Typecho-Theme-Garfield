<?php $this->need('header.php'); ?>
<?php $this->header('commentReply=1&description=0&keywords=0&generator=0&template=0&pingback=0&xmlrpc=0&wlw=0&rss2=0&rss1=0&antiSpam=0&atom'); ?>
<?php if($this->fields->banner && $this->fields->banner!=''){ ?>
            <div class="bgpicture">
                <div class="bgpicture_img">
                    <img src="<?php $this->fields->banner(); ?>">
                </div>
                <div class="bgpicture_box">
                    <div class="bgpicture_box_title"><span class="name"><?php $this->title() ?></span><div class="time"><?php $this->date('Y.m.d'); ?></div></div>
                </div>
            </div>
            <?php } else { ?>
                <div class="bgpicture">
                <div class="bgpicture_img">
                    <img src="<?php echo $this->options->beijing ? $this->options->beijing() : $this->options->themeUrl('assets/img/default.jpg'); ?>">
                </div>
                <div class="bgpicture_box">
                    <div class="bgpicture_box_title"><span class="name"><?php echo $this->options->beiwenzi ? $this->options->beiwenzi() : '等风来，不如追风去'; ?><span></div>
                </div>
            </div>
            <?php } ?>

                <article class="post">
                <?php if($this->fields->banner && $this->fields->banner==''){ ?>
                    <h1 class="post_title"><?php $this->title() ?></h1>
                    <?php } ?>
                    <div class="post_info">
                        <span class="author"><?php $this->author->gravatar(); ?> <?php $this->author(); ?></span>
                        <?php if($this->fields->banner && $this->fields->banner==''){ ?>
                        <time itemprop="datePublished" datetime="<?php $this->date('Y.m.d'); ?>"><?php $this->date('Y.m.d'); ?></time>
                        <?php } ?>
                    </div>

                    <div class="song">
                    <?php $this->content(); ?>
                        <div id="eof"><span>EOF</span></div>
                    </div>

                    <div class="sortbar"></div>

                    <div class="commentn"><?php $this->commentsNum(_t('暂无评论'), _t('发表评论（1 条评论）'), _t('发表评论（%d 条评论）')); ?></div>
 
                    <?php $this->need('comments.php'); ?>
                </article>
               

                <script>
        // 处理文章中的图片
        $(function() {
            $("div.song figure:not(.size-parsed)").each(function() {
                var $figure = $(this);
                var $img = $figure.find("img");
                var originalSrc = $img.attr("data-original") || $img.attr("src");
                
                if (!originalSrc) return;
                
                // 预加载图片以获取尺寸
                var img = new Image();
                img.onload = function() {
                    var width = this.width;
                    var height = this.height;
                    
                    if (width && height) {
                        $figure.addClass("size-parsed")
                               .css({
                                   "width": width + "px",
                                   "flex-grow": 50 * width / height
                               });
                        
                        $figure.find("a").css("padding-top", (height / width * 100) + "%");
                    }
                };
                img.src = originalSrc;
            });
        });

        // 代码块行号
        (function(){
            var pres = document.querySelectorAll('pre');
            var lineNumberClassName = 'line-numbers';
            pres.forEach(function (item, index) {
                item.className = item.className == '' ? lineNumberClassName : item.className + ' ' + lineNumberClassName;
            });
        })();
</script>
<?php $this->need('footer.php'); ?>