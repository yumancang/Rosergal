<?php


namespace Twinkle\Library\Controller;


use Twinkle\Library\Service\ServiceLocatorTrait;

class Controller
{

    use ServiceLocatorTrait;

    public static function supportAutoNamespaces() {
        return [
            'App\\Service'
        ];
    }

    public function __construct()
    {

    }

}
