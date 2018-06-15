<?php

/**
 * Author: Xooxx <xooxx.dev@gmail.com>
 * Date: 6/19/15
 * Time: 5:59 PM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Xooxx\Foundation\Domain\Model\Repository;

use Xooxx\Foundation\Domain\Model\Repository\Contracts\BaseFilter as BaseFilterInterface;
class BaseFilter implements BaseFilterInterface
{
    /**
     * @var array
     */
    protected $filters;
    /**
     *
     */
    public function __construct()
    {
        $this->filters = [];
    }
    /**
     * @param string $filterName
     *
     * @return BaseFilterInterface
     */
    public function notEmpty($filterName)
    {
        $this->addFilter(self::NOT_EMPTY, $filterName, self::NOT_EMPTY);
        return $this;
    }
    /**
     * @param string $filterName
     *
     * @return BaseFilterInterface
     */
    public function hasEmpty($filterName)
    {
        $this->isEmpty($filterName);
        return $this;
    }
    /**
     * @param string $filterName
     *
     * @return BaseFilterInterface
     */
    public function notNull($filterName)
    {
        $this->addFilter(self::NOT_NULL, $filterName, self::NOT_NULL);
        return $this;
    }
    /**
     * @param string $filterName
     * @param mixed  $value
     *
     * @return BaseFilterInterface
     */
    public function startsWith($filterName, $value)
    {
        $this->addFilter(self::STARTS_WITH, $filterName, $value);
        return $this;
    }
    /**
     * @param string $property
     * @param string $filterName
     * @param mixed  $value
     */
    protected function addFilter($property, $filterName, $value)
    {
        $filterName = (string) $filterName;
        $property = (string) $property;
        $this->filters[$property][$filterName][] = $value;
    }
    /**
     * @param string $filterName
     * @param mixed  $value
     *
     * @return BaseFilterInterface
     */
    public function endsWith($filterName, $value)
    {
        $this->addFilter(self::ENDS_WITH, $filterName, $value);
        return $this;
    }
    /**
     * @param string $filterName
     * @param mixed  $value
     *
     * @return BaseFilterInterface
     */
    public function equal($filterName, $value)
    {
        $this->addFilter(self::EQUALS, $filterName, $value);
        return $this;
    }
    /**
     * @param string $filterName
     * @param mixed  $value
     *
     * @return BaseFilterInterface
     */
    public function notEqual($filterName, $value)
    {
        $this->addFilter(self::NOT_EQUAL, $filterName, $value);
        return $this;
    }
    /**
     * @param string $filterName
     * @param mixed  $value
     *
     * @return BaseFilterInterface
     */
    public function includeGroup($filterName, array $value)
    {
        $filterName = (string) $filterName;
        $this->filters[self::GROUP][$filterName] = array_merge(!empty($this->filters[self::GROUP][$filterName]) ? $this->filters[self::GROUP][$filterName] : [], array_values($value));
        return $this;
    }
    /**
     * @param string $filterName
     * @param mixed  $value
     *
     * @return BaseFilterInterface
     */
    public function notIncludeGroup($filterName, array $value)
    {
        $filterName = (string) $filterName;
        $this->filters[self::NOT_GROUP][$filterName] = array_merge(!empty($this->filters[self::NOT_GROUP][$filterName]) ? $this->filters[self::NOT_GROUP][$filterName] : [], array_values($value));
        return $this;
    }
    /**
     * @param string $filterName
     * @param mixed  $firstValue
     * @param mixed  $secondValue
     *
     * @return BaseFilterInterface
     */
    public function range($filterName, $firstValue, $secondValue)
    {
        $this->addFilter(self::RANGES, $filterName, [$firstValue, $secondValue]);
        return $this;
    }
    /**
     * @param string $filterName
     * @param mixed  $firstValue
     * @param mixed  $secondValue
     *
     * @return BaseFilterInterface
     */
    public function notRange($filterName, $firstValue, $secondValue)
    {
        $this->addFilter(self::NOT_RANGES, $filterName, [$firstValue, $secondValue]);
        return $this;
    }
    /**
     * @param string $filterName
     * @param mixed  $value
     *
     * @return BaseFilterInterface
     */
    public function notContain($filterName, $value)
    {
        $this->addFilter(self::NOT_CONTAINS, $filterName, $value);
        return $this;
    }
    /**
     * @param string $filterName
     * @param mixed  $value
     *
     * @return BaseFilterInterface
     */
    public function contain($filterName, $value)
    {
        $this->addFilter(self::CONTAINS, $filterName, $value);
        return $this;
    }
    /**
     * @param string $filterName
     * @param mixed  $value
     *
     * @return BaseFilterInterface
     */
    public function beGreaterThanOrEqual($filterName, $value)
    {
        $this->addFilter(self::GREATER_THAN_OR_EQUAL, $filterName, $value);
        return $this;
    }
    /**
     * @param string $filterName
     * @param mixed  $value
     *
     * @return BaseFilterInterface
     */
    public function beGreaterThan($filterName, $value)
    {
        $this->addFilter(self::GREATER_THAN, $filterName, $value);
        return $this;
    }
    /**
     * @param string $filterName
     * @param mixed  $value
     *
     * @return BaseFilterInterface
     */
    public function beLessThanOrEqual($filterName, $value)
    {
        $this->addFilter(self::LESS_THAN_OR_EQUAL, $filterName, $value);
        return $this;
    }
    /**
     * @param string $filterName
     * @param mixed  $value
     *
     * @return BaseFilterInterface
     */
    public function beLessThan($filterName, $value)
    {
        $this->addFilter(self::LESS_THAN, $filterName, $value);
        return $this;
    }
    /**
     * @return BaseFilterInterface
     */
    public function clear()
    {
        $this->filters = [];
        return $this;
    }
    /**
     * @return array
     */
    public function get()
    {
        return $this->filters;
    }
    /**
     * @param string $filterName
     * @param $value
     *
     * @return BaseFilterInterface
     */
    public function notStartsWith($filterName, $value)
    {
        $this->addFilter(self::NOT_STARTS, $filterName, $value);
        return $this;
    }
    /**
     * @param string $filterName
     * @param $value
     *
     * @return BaseFilterInterface
     */
    public function notEndsWith($filterName, $value)
    {
        $this->addFilter(self::NOT_ENDS, $filterName, $value);
        return $this;
    }
    /**
     * @param string $filterName
     *
     * @return BaseFilterInterface
     */
    public function isEmpty($filterName)
    {
        $this->addFilter(self::EMPTY_FILTER, $filterName, self::EMPTY_FILTER);
        return $this;
    }
    /**
     * @param string $filterName
     *
     * @return BaseFilterInterface
     */
    public function null($filterName)
    {
        $this->addFilter(self::NULL_FILTER, $filterName, self::NULL_FILTER);
        return $this;
    }
}