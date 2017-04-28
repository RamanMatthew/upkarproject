<?php
namespace AppBundle\Service;

class Crypt
{
    public function randString($length)
    {
        return bin2hex(random_bytes($length / 2));
    }
}
