<?php

/**
 * Author: Xooxx <xooxx.dev@gmail.com>
 * Date: 6/01/16
 * Time: 18:40.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Xooxx\Foundation\Domain\Model\Repository\Contracts;

interface BaseFilter
{
    const GREATER_THAN_OR_EQUAL = 'gte';
    const GREATER_THAN = 'gt';
    const LESS_THAN_OR_EQUAL = 'lte';
    const LESS_THAN = 'lt';
    const CONTAINS = 'contains';
    const STARTS_WITH = 'start_with';
    const ENDS_WITH = 'end_with';
    const NOT_CONTAINS = 'not_contains';
    const RANGES = 'ranges';
    const NOT_RANGES = 'not_ranges';
    const GROUP = 'group';
    const NOT_GROUP = 'not_group';
    const EQUALS = 'equals';
    const NOT_EQUAL = 'not_equals';
    const EMPTY_FILTER = 'empty';
    const NULL_FILTER = 'null';
    const NOT_EMPTY = 'not_empty';
    const NOT_NULL = 'not_null';
    const NOT_ENDS = 'not_ends';
    const NOT_STARTS = 'not_starts';
    /**
     * @param string $filterName
     * @param $value
     *
     * @return BaseFilter
     */
    public function notStartsWith($filterName, $value);
    /**
     * @param string $filterName
     * @param $value
     *
     * @return BaseFilter
     */
    public function notEndsWith($filterName, $value);
    /**
     * @param string $filterName
     *
     * @return BaseFilter
     */
    public function isEmpty($filterName);
    /**
     * @param string $filterName
     *
     * @return BaseFilter
     */
    public function notEmpty($filterName);
    /**
     * @param string $filterName
     *
     * @return BaseFilter
     */
    public function hasEmpty($filterName);
    /**
     * @param string $filterName
     *
     * @return BaseFilter
     */
    public function null($filterName);
    /**
     * @param string $filterName
     *
     * @return BaseFilter
     */
    public function notNull($filterName);
    /**
     * @param string $filterName
     * @param $value
     *
     * @return BaseFilter
     */
    public function startsWith($filterName, $value);
    /**
     * @param string $filterName
     * @param $value
     *
     * @return BaseFilter
     */
    public function endsWith($filterName, $value);
    /**
     * @param string $filterName
     * @param $value
     *
     * @return BaseFilter
     */
    public function equal($filterName, $value);
    /**
     * @param string $filterName
     * @param $value
     *
     * @return BaseFilter
     */
    public function notEqual($filterName, $value);
    /**
     * @param string $filterName
     * @param array  $value
     *
     * @return BaseFilter
     */
    public function includeGroup($filterName, array $value);
    /**
     * @param string $filterName
     * @param array  $value
     *
     * @return BaseFilter
     */
    public function notIncludeGroup($filterName, array $value);
    /**
     * @param string $filterName
     * @param $firstValue
     * @param $secondValue
     *
     * @return BaseFilter
     */
    public function range($filterName, $firstValue, $secondValue);
    /**
     * @param string $filterName
     * @param $firstValue
     * @param $secondValue
     *
     * @return BaseFilter
     */
    public function notRange($filterName, $firstValue, $secondValue);
    /**
     * @param string $filterName
     * @param $value
     *
     * @return BaseFilter
     */
    public function notContain($filterName, $value);
    /**
     * @param string $filterName
     * @param $value
     *
     * @return BaseFilter
     */
    public function contain($filterName, $value);
    /**
     * @param string $filterName
     * @param $value
     *
     * @return BaseFilter
     */
    public function beGreaterThanOrEqual($filterName, $value);
    /**
     * @param string $filterName
     * @param $value
     *
     * @return BaseFilter
     */
    public function beGreaterThan($filterName, $value);
    /**
     * @param string $filterName
     * @param $value
     *
     * @return BaseFilter
     */
    public function beLessThanOrEqual($filterName, $value);
    /**
     * @param string $filterName
     * @param $value
     *
     * @return BaseFilter
     */
    public function beLessThan($filterName, $value);
    /**
     * @return mixed
     */
    public function clear();
    /**
     * @return mixed
     */
    public function get();
}