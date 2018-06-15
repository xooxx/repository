<?php

namespace Xooxx\Foundation\Infrastructure\Model\Repository\InMemory\Filters;

use Xooxx\Foundation\Infrastructure\Model\Repository\InMemory\PropertyValue;
class ComparisonFilter
{
    /**
     * @param string $property
     *
     * @return \Closure
     */
    public static function isEmpty($property)
    {
        return function ($v) use($property) {
            return PropertyValue::get($v, $property) === null || PropertyValue::get($v, $property) === '';
        };
    }
    /**
     * @param string $property
     *
     * @return \Closure
     */
    public static function notEmpty($property)
    {
        return function ($v) use($property) {
            return PropertyValue::get($v, $property) !== null && PropertyValue::get($v, $property) !== '';
        };
    }
    /**
     * @param string $property
     *
     * @return \Closure
     */
    public static function null($property)
    {
        return function ($v) use($property) {
            return PropertyValue::get($v, $property) === null;
        };
    }
    /**
     * @param string $property
     *
     * @return \Closure
     */
    public static function notNull($property)
    {
        return function ($v) use($property) {
            return PropertyValue::get($v, $property) !== null;
        };
    }
    /**
     * @param string           $property
     * @param string|int|float $value
     *
     * @return \Closure
     */
    public static function equals($property, $value)
    {
        return function ($v) use($property, $value) {
            return PropertyValue::get($v, $property) == $value;
        };
    }
    /**
     * @param string           $property
     * @param string|int|float $value
     *
     * @return \Closure
     */
    public static function notEquals($property, $value)
    {
        return function ($v) use($property, $value) {
            return PropertyValue::get($v, $property) != $value;
        };
    }
    /**
     * @param string           $property
     * @param string|int|float $value
     *
     * @return \Closure
     */
    public static function greaterThanOrEqual($property, $value)
    {
        return function ($v) use($property, $value) {
            return PropertyValue::get($v, $property) >= $value;
        };
    }
    /**
     * @param string           $property
     * @param string|int|float $value
     *
     * @return \Closure
     */
    public static function greaterThan($property, $value)
    {
        return function ($v) use($property, $value) {
            return PropertyValue::get($v, $property) > $value;
        };
    }
    /**
     * @param string           $property
     * @param string|int|float $value
     *
     * @return \Closure
     */
    public static function lessThanOrEqual($property, $value)
    {
        return function ($v) use($property, $value) {
            return PropertyValue::get($v, $property) <= $value;
        };
    }
    /**
     * @param string           $property
     * @param string|int|float $value
     *
     * @return \Closure
     */
    public static function lessThan($property, $value)
    {
        return function ($v) use($property, $value) {
            return PropertyValue::get($v, $property) < $value;
        };
    }
}