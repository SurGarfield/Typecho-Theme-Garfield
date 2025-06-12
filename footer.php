</div>
<footer id="footer">
    <?php if ($this->options->beian): ?>
    <div class="info"><a href="https://beian.miit.gov.cn/" title="备案信息" target="_blank"><?php $this->options->beian(); ?></a></div>
    <?php endif; ?>
    <?php if ($this->options->banquan): ?>
    <div class="info"><?php $this->options->banquan(); ?></div>
    <p class="powered-by">Power by <a href="http://typecho.org" target="_blank">Typecho</a> • Theme by <a href="https://oxxx.cn">Garfield</a></p>
    <?php endif; ?>
</footer>

</div>
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/jquery.pjax.min.js'); ?>"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/nprogress.min.js'); ?>"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/jquery.fancybox.min.js'); ?>"></script>
<script type="text/javascript" src="<?php $this->options->themeUrl('Garfield.js'); ?>"></script>

        <script>
    function getBaseUrl() {
    var ishttps = 'https:' == document.location.protocol ? true : false;
    var url = window.location.host;
    if (ishttps) {
        url = 'https://' + url;
    } else {
        url = 'http://' + url;
    }
    return url;
    }
    
    let url = '"'+getBaseUrl()+'"';
    $(document).pjax('a[href^='+ url +']:not(a[target="_blank"], a[no-pjax])', {
    container: '#pjax',
    fragment: '#pjax',
    timeout: 8000
    })
    $(document).on('pjax:start',function() { NProgress.start(); });
    $(document).on('pjax:end',function() { NProgress.done(); });
        //表单提交事件
        $(document).on('.submit', function (event) {
        event.preventDefault();
        // $.pjax.submit(event, '#pjax');
        $.pjax.submit(event, '#pjax', {timeout: 10000});
    }); 
        //表单提交成功事件
        $(document).on('pjax:success', function (event) {
        //console.log("关闭搜索框之类的操作");
    });
    //「页面刷新」事件触发运行
    $(document).ready(function()
    {
        MyApp.initPjax();
    });

</script>

<?php $this->footer(); ?>
    </body>

</html>