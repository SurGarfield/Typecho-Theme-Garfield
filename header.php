<!--


                                         
                                   .. .vr       
                                 qBMBBBMBMY     
                                8BBBBBOBMBMv    
                              iMBMM5vOY:BMBBv        
              .r,             OBM;   .: rBBBBBY     
              vUL             7BB   .;7. LBMMBBM.   
             .@Wwz.           :uvir .i:.iLMOMOBM..  
              vv::r;             iY. ...rv,@arqiao. 
               Li. i:             v:.::::7vOBBMBL.. 
               ,i7: vSUi,         :M7.:.,:u08OP. .  
                 .N2k5u1ju7,..     BMGiiL7   ,i,i.  
                  :rLjFYjvjLY7r::.  ;v  vr... rE8q;.:,, 
                 751jSLXPFu5uU@guohezou.,1vjY2E8@Yizero.    
                 BB:FMu rkM8Eq0PFjF15FZ0Xu15F25uuLuu25Gi.   
               ivSvvXL    :v58ZOGZXF2UUkFSFkU1u125uUJUUZ,   
             :@kevensun.      ,iY20GOXSUXkSuS2F5XXkUX5SEv.  
         .:i0BMBMBBOOBMUi;,        ,;8PkFP5NkPXkFqPEqqkZu.  
       .rqMqBBMOMMBMBBBM .           @kexianli.S11kFSU5q5   
     .7BBOi1L1MM8BBBOMBB..,          8kqS52XkkU1Uqkk1kUEJ   
     .;MBZ;iiMBMBMMOBBBu ,           1OkS1F1X5kPP112F51kU   
       .rPY  OMBMBBBMBB2 ,.          rME5SSSFk1XPqFNkSUPZ,.
              ;;JuBML::r:.:.,,        SZPX0SXSP5kXGNP15UBr.
                  L,    :@sanshao.      :MNZqNXqSqXk2E0PSXPE .
              viLBX.,,v8Bj. i:r7:,     2Zkqq0XXSNN0NOXXSXOU 
            :r2. rMBGBMGi .7Y, 1i::i   vO0PMNNSXXEqP@Secbone.
            .i1r. .jkY,    vE. iY....  20Fq0q5X5F1S2F22uuv1M; 


    又看源码，看你妹妹呀！
    何だよ？

-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8>
        <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0" name=viewport>
        <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
        <link rel=stylesheet href="<?php $this->options->themeUrl('style.css'); ?>">
        <link rel=stylesheet href="<?php $this->options->themeUrl('assets/css/nprogress.min.css'); ?>">
                <script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/jquery.min.js'); ?>"></script>
        <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/jquery.fancybox.min.css'); ?>" />
        <script type="text/javascript" src="<?php $this->options->themeUrl('assets/OWO/OwO.js'); ?>"></script>
        <script type="text/javascript" src="<?php $this->options->themeUrl('assets/js/jquery.lazyload.min.js'); ?>"></script>
        <?php $this->header(); ?>
    </head>
    <body>
        <div class="content">
            <header id="header">
                <div class="header_box">
                    <div class="logo">
                        <div class="logo_img">
                            <a href="<?php $this->options->siteUrl(); ?>">
                                <?php if ($this->options->logoUrl): ?>
                                    <img src="<?php $this->options->logoUrl(); ?>">
                                <?php else: ?>
                                    <span class="site-name"><?php $this->options->title(); ?></span>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <nav class="meun_list">
                        <ul class="meun_ul">
                            <li class="meun_li"><a href="<?php $this->options->siteUrl(); ?>">首页</a></li>
                            <?php $this->widget('Widget_Contents_Page_List')
               ->parse('<li class="meun_li"><a href="{permalink}">{title}</a></li>'); ?>
                        </ul>
                    </nav>
                </div>
            </header>
            <div id="pjax">