(function ($) {

    var MyApp = {
        initPjax: function () {
            var self = this;
  
            // 初始化
            $(document).pjax('a:not(a[target="_blank"])', '#pjax', {
              container: '#pjax',
              fragment: "#pjax",
              timeout: 1600,
              maxCacheLength: 500,
          });
         
            // PJAX 渲染结束时
            $(document).on('pjax:end', function () {
                // 这里的调用 **只有** 在「局部刷新」时才会运行
                self.siteBootUp();
            });
            self.siteBootUp();
        },
  
        /*
        * Things to be execute when normal page load
        * and pjax page load.
        */
        siteBootUp: function () {
            // ... 「局部刷新」和「页面刷新」都需要运行的代码
            var self = this;
            self.postGetLoading();
            self.ajaxComment();
            self.private_comment();
            self.lazyload();
        },

      //懒加载
      lazyload: function () {
        $(function() {
            // 处理所有带有 data-original 属性的图片
            $("img[data-original]").each(function() {
                var $this = $(this);
                var originalSrc = $this.attr('data-original');
                
                // 创建一个新的图片对象来预加载
                var img = new Image();
                img.onload = function() {
                    $this.attr('src', originalSrc);
                    $this.fadeIn('fast');
                };
                
                // 创建 Intersection Observer
                var observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            img.src = originalSrc;
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1
                });
                
                // 开始观察
                observer.observe(this);
            });
        });
      },
      //点击加载更多
      postGetLoading: function () {
        //点击下一页的链接(即那个a标签)
        $('.paging a').click(function() {
            $this = $(this);
            $this.addClass('loading').text('正在努力加载'); //给a标签加载一个loading的class属性，可以用来添加一些加载效果
            var href = $this.attr('href'); //获取下一页的链接地址
            if (href != undefined) { //如果地址存在
                $.ajax({ //发起ajax请求
                    url: href,
                    type: 'get',
                    success: function(data) { //请求成功
                        $this.removeClass('loading').text('点击查看更多'); //移除loading属性
                        var $res = $(data).find('.index_list'); //从数据中挑出文章数据，请根据实际情况更改
                        $('.index_ajax').append($res.fadeIn(500)); //将数据加载加进posts-loop的标签中。
                        var newhref = $(data).find('.paging a').attr('href'); //找出新的下一页链接
                        if (newhref != undefined) {
                            $('.paging a').attr('href', newhref);
                        } else {
                            $('.paging a').remove(); //如果没有下一页了，隐藏
                        }
                    }
                });
            }
            return false;
        });
        
},

     //私密评论
     private_comment: function () {
        var holder = $('.comment-editor textarea').attr('placeholder');
        $('#secret-button').click(function () {
          var textareaDom = $('.comment-editor textarea');
          if($(this).is(':checked')) {
              textareaDom.attr('placeholder', '正在私密评论中...')
          }else {
              textareaDom.attr('placeholder', holder)
          }
        });
      },

ajaxComment: function () {
    $('#comment-form').submit(function(event){
        var commentdata=$(this).serializeArray();
        $.ajax({
            url:$(this).attr('action'),
            type:$(this).attr('method'),
            data:commentdata,
            success:function(data){
                var error=/<title>Error<\/title>/;
                if (error.test(data)){
                    var text=data.match(/<div(.*?)>(.*?)<\/div>/is);
                    var str='发生了未知错误';if (text!=null) str=text[2];
                   
                } else {
                    //评论框复位（清空文本，刷新高度）
                    $('.textarea_box').val('');$('.textarea_box').css('height','75px');
                    //评论框复位（取消回复）
                    if ($('#cancel-comment-reply-link').css('display')!='none') $('#cancel-comment-reply-link').click();
                    var target='#comments',parent=true;
                    $.each(commentdata,function(i,field) {if (field.name=='parent') parent=false;});
                    if (!parent || !$('ol.page-navigator .prev').length){
                        var latest=-19260817;
                        $('#comments .comment-parent',data).each(function(){
                            var id=$(this).attr('id'),coid=parseInt(id.substring(8));
                            if (coid>latest) {latest=coid;target='#'+id;}
                        });
                    }
                    $('.comment').html($('.comment',data).html()); //更新最新评论
                    $('.comments-title').html($('.comments-title',data).html()); //更新评论数量
                    $('.comments_lie').html($('.comments_lie',data).html()); //更新评论列表
                }
            }
        });
        return false;
    });
  },












      };
    window.MyApp = MyApp;
  
  })(jQuery);
