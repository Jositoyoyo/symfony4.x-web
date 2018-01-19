<?php
namespace App\Service;

class SlugGenerator {

    static public function simpleSlug($string) {
        return trim(preg_replace('/[^a-z0-9]+/', '-', strtolower(strip_tags($string))), '-');
    }

    static public function TokenizenSlug($string) {
        return md5(uniqid($string, true));
    }

}
