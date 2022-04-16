<?php
// シェアリンク生成
class ShareLinkGenerator {

    private $twitter_username = 'oguemon_com';
    private $fb_app_id = '1846956072250071';

    private $link_fb      = '';
    private $link_hatena  = '';
    private $link_line    = '';
    private $link_pocket  = '';
    private $link_twitter = '';

    public function __construct($url, $title) {
        $encoded_url   = urlencode($url);
        $encoded_title = urlencode($title);
        $this->link_fb      = sprintf('https://www.facebook.com/dialog/feed?link=%s&app_id=%s', $encoded_url, $this->fb_app_id);
        $this->link_hatena  = sprintf('http://b.hatena.ne.jp/entry/%s',                         $encoded_url);
        $this->link_line    = sprintf('http://line.me/R/msg/text/?%s',                          $encoded_url);
        $this->link_pocket  = sprintf('http://getpocket.com/edit?url=%s&title=%s',              $encoded_url, $encoded_title);
        $this->link_twitter = sprintf('http://twitter.com/share?url=%s&text=%s&related=%s',     $encoded_url, $encoded_title, $this->$twitter_username);
    }

    public function getShareLinkFacebook() {
        return $this->link_fb;
    }

    public function getShareLinkHatena() {
        return $this->link_hatena;
    }

    public function getShareLinkLine() {
        return $this->link_line;
    }

    public function getShareLinkPocket() {
        return $this->link_pocket;
    }

    public function getShareLinkTwitter() {
        return $this->link_twitter;
    }
}
