<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * Author: 森木志
 * CreateTime: 2021/3/4
 * 主题功能
 */
class feature
{



    //隐私评论
    public static function get_comment_at($_var_108)
    {
        $_var_109 = Typecho_Db::get();
        $_var_110 = $_var_109->fetchRow($_var_109->select('parent,status')->from('table.comments')->where('coid = ?', $_var_108));
        $_var_111 = '';
        $_var_112 = @$_var_110['parent'];
        if ($_var_112 != '0') {
            $_var_113 = $_var_109->fetchRow($_var_109->select('author,status,mail')->from('table.comments')->where('coid = ?', $_var_112));
            @($_var_114 = @$_var_113['author']);
            $_var_111 = @$_var_113['mail'];
            if (@$_var_114 && $_var_113['status'] == 'approved') {
                if (@$_var_110['status'] == 'waiting') {}
            } else {
                if (@$_var_110['status'] == 'waiting') {
                } else {
                    echo '';
                }
            }
        } else {
            if (@$_var_110['status'] == 'waiting') {
            } else {
                echo '';
            }
        }
        return $_var_111;
    }

    //隐私评论
    public static function insertSecret($comment)
    {
        if ($_POST['secret']) {
            $comment['text'] = '[secret] &nbsp;' . $comment['text'] . '[/secret]';
        }
        return $comment;
    }





    





    //表情解析
    public static function parseContent($text, $widget, $lastResult)
    {
        $text = empty($lastResult) ? $text : $lastResult;
        if ($widget instanceof Widget_Abstract_Comments) {
            $text = Shortcode::parseBiaoQing($text);
        }
        return $text;
    }

    /**
     * 泡泡表情回调函数
     *
     * @return string
     */
    public static function parsePaopaoBiaoqingCallback($match)
    {
        return '<img class="biaoqing paopao" src="' . ('/usr/themes/Garfield/assets/OWO/biaoqing/paopao/') . str_replace('%', '', urlencode($match[1])) . '_2x.png" height="30" width="30">';
    }

    /**
     * 阿鲁表情回调函数
     *
     * @return string
     */
    public static function parseAruBiaoqingCallback($match): string
    {
        return '<img class="biaoqing alu" src="' . ('/usr/themes/Garfield/assets/OWO/biaoqing/aru/') . str_replace('%', '', urlencode($match[1])) . '_2x.png">';
    }

       /**
     * HEO表情回调函数
     *
     * @return string
     */
    public static function parseheoBiaoqingCallback($match): string
    {
        return '<img class="biaoqing alu" src="' . ('/usr/themes/Garfield/assets/OWO/biaoqing/Heo/') . str_replace('%', '', $match[1]) . '.png">';
    }

    /**
     * 输出文章摘要
     * @param $content
     * @param $limit 字数限制
     * @return string
     */
    public static function excerpt($content, $limit)
    {

        if ($limit == 0) {
            return "";
        } else {
           
            if (trim($content) == "") {
                return ("暂时无可提供的摘要");
            } else {
                return Typecho_Common::subStr(strip_tags($content), 0, $limit, "...");
            }
        }
    }














}


