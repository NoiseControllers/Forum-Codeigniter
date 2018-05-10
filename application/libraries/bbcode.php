<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 10/05/2018
 * Time: 17:05
 */

class bbcode {
    private $bbcode = [];

    public function __construct()
    {

        $this->bbcode["/\[b\](.*?)\[\/b\]/is"] = function ($match) {
            return "<strong>$match[1]</strong>";
        };

        $this->bbcode["/\[i\](.*?)\[\/i\]/is"] = function ($match) {
            return "<em>$match[1]</em>";
        };

        $this->bbcode["/\[u\](.*?)\[\/u\]/is"] = function ($match) {
            return '<ins>' . $match[1] . '</ins>';
        };

        $this->bbcode["/\[s\](.*?)\[\/s\]/is"] = function ($match) {
            return '<del>' . $match[1] . '</del>';
        };

        $this->bbcode["/\[center\](.*?)\[\/center\]/is"] = function ($match) {
            return '<p style="text-align:center;">' . $match[1] . '</p>';
        };

        $this->bbcode["/\[left\](.*?)\[\/left\]/is"] = function ($match) {
            return '<p style="text-align:left;">' . $match[1] . '</p>';
        };

        $this->bbcode["/\[right\](.*?)\[\/right\]/is"] = function ($match) {
            return '<p style="text-align:right;">' . $match[1] . '</p>';
        };

        $this->bbcode["/\[img\](.*?)\[\/img\]/is"] = function ($match) {
            return "<img src=\"$match[1]\"/>";
        };

        $this->bbcode["/\[url\](.*?)\[\/url\]/is"] = function ($match) {
            return "<a href=\"$match[1]\">$match[1]</a>";
        };

        $this->bbcode["/\[url=(.*?)\](.*?)\[\/url\]/is"] = function ($match) {
            return "<a href=\"$match[1]\">$match[2]</a>";
        };

        $this->bbcode["/\[quote\](.*?)\[\/quote\]/is"] = function ($match) {
            return "<blockquote><p>$match[1]</p></blockquote>";
        };

        $this->bbcode["/\[quote=\"([^\"]+)\"\](.*?)\[\/quote\]/is"] = function ($match) {
            return "$match[1]: <blockquote><p>$match[2]</p></blockquote>";
        };

    }

    public function toHTML($str)
    {
        foreach($this->bbcode as $key => $val) {
            $str = preg_replace_callback($key, $val, $str);
        }

        return $str;
    }
}