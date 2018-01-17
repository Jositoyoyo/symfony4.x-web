<?php

namespace App\Service;
use Symfony\Bridge\Doctrine\Security\RememberMe\DoctrineTokenProvider;
class SlugGenerator
{

    static public function slugify($string)
    {
        return trim(preg_replace('/[^a-z0-9]+/', '-', strtolower(strip_tags($string))), '-');
    }

    static public function slugTokenizen(){
        $s = new DoctrineTokenProvider();
       return $s->createNewToken('23345');
    }
}
