<?php

namespace Xooxx\Foundation\Infrastructure;

use Xooxx\Serializer\Serializer;
use Xooxx\Serializer\Transformer\FlatArrayTransformer;
class ObjectFlattener
{
    /** @var Serializer */
    protected static $serializer;
    /**
     * @return Serializer
     */
    public static function instance()
    {
        if (null === self::$serializer) {
            self::$serializer = new Serializer(new FlatArrayTransformer());
        }
        return self::$serializer;
    }
}