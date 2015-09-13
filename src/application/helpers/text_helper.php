<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function auto_link_text($text) {
    $regex = '#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#';
    return preg_replace_callback($regex, function ($matches) {
        return "<a href=\"{$matches[0]}\" target=\"_blank\">{$matches[0]}</a>";
    }, $text);
}