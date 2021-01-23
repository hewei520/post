<?php
/**
 * 公共方法
 * User: 威少
 * Date: 2021/1/22
 * Time: 10:08
 */
namespace hw;

class Post
{
    /**
     * GET请求
     * @param $url string 请求地址
     * @return bool
     */
    public static function getUrl($url)
    {
        $info = curl_init();
        curl_setopt($info, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($info, CURLOPT_HEADER, 0);
        curl_setopt($info, CURLOPT_NOBODY, 0);
        curl_setopt($info, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($info, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($info, CURLOPT_URL, $url);
        $output = curl_exec($info);
        curl_close($info);
        return true;
    }

    /**
     * POST请求
     * @param $url string 请求地址
     * @param $postData array 参数
     * @return bool
     */
    public static function postUrl($url, $postData = [])
    {
        if (empty($url) || empty($postData)) {
            return false;
        }

        $o = "";
        foreach ($postData as $k => $v) {
            $o .= "$k=" . urlencode($v) . "&";
        }
        $postData = substr($o, 0, -1);
        $postUrl  = $url;
        $curlPost = $postData;
        $ch       = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL, $postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);

        return $data;
    }

}