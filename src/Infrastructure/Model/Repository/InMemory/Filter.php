<?php

/**
 * Author: Xooxx <xooxx.dev@gmail.com>
 * Date: 20/01/16
 * Time: 23:55.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Xooxx\Foundation\Infrastructure\Model\Repository\InMemory;

use Xooxx\Foundation\Domain\Model\Repository\Contracts\BaseFilter;
use Xooxx\Foundation\Domain\Model\Repository\Contracts\Filter as FilterInterface;
use Xooxx\Foundation\Infrastructure\Model\Repository\InMemory\Filters\ComparisonFilter;
use Xooxx\Foundation\Infrastructure\Model\Repository\InMemory\Filters\ContainenceFilter;
use Xooxx\Foundation\Infrastructure\Model\Repository\InMemory\Filters\RangeFilter;
use Xooxx\Foundation\Infrastructure\Model\Repository\InMemory\Filters\StringFilter;
class Filter
{
    const MUST_NOT = 'must_not';
    const MUST = 'must';
    const SHOULD = 'should';
    /**
     * @param array           $results
     * @param FilterInterface $filter
     *
     * @return array
     */
    public static function filter(array $results, FilterInterface $filter)
    {
        $filteredResults = $results;
        foreach ($filter->filters() as $condition => $filters) {
            $filters = self::removeEmptyFilters($filters);
            if (count($filters) > 0) {
                switch ($condition) {
                    case self::MUST:
                        self::must($filteredResults, $filters);
                        break;
                    case self::MUST_NOT:
                        self::mustNot($filteredResults, $filters);
                        break;
                    case self::SHOULD:
                        self::should($results, $filteredResults, $filters);
                        $filteredResults = array_unique($filteredResults);
                        break;
                }
            }
        }
        return $filteredResults;
    }
    /**
     * @param array $filters
     *
     * @return array
     */
    private static function removeEmptyFilters(array $filters)
    {
        $filters = array_filter($filters, function ($v) {
            return count($v) > 0;
        });
        return $filters;
    }
    /**
     * @param array $filteredResults
     * @param array $filters
     */
    protected static function must(array &$filteredResults, array $filters)
    {
        foreach ($filters as $filterName => $valuePair) {
            foreach ($valuePair as $property => $v) {
                if (is_array($v) && count($v) > 0) {
                    $v = array_values($v);
                    if (count($v[0]) > 1) {
                        switch ($filterName) {
                            case BaseFilter::RANGES:
                                $filteredResults = array_filter($filteredResults, RangeFilter::ranges($property, $v[0][0], $v[0][1]));
                                break;
                            case BaseFilter::NOT_RANGES:
                                $filteredResults = array_filter($filteredResults, RangeFilter::notRanges($property, $v[0][0], $v[0][1]));
                                break;
                        }
                    } else {
                        switch ($filterName) {
                            case BaseFilter::GROUP:
                                $filteredResults = array_filter($filteredResults, ContainenceFilter::in($property, $v));
                                break;
                            case BaseFilter::NOT_GROUP:
                                $filteredResults = array_filter($filteredResults, ContainenceFilter::notIn($property, $v));
                                break;
                        }
                    }
                }
                $v = (array) $v;
                $v = array_shift($v);
                switch ($filterName) {
                    case BaseFilter::GREATER_THAN_OR_EQUAL:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::greaterThanOrEqual($property, $v));
                        break;
                    case BaseFilter::GREATER_THAN:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::greaterThan($property, $v));
                        break;
                    case BaseFilter::LESS_THAN_OR_EQUAL:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::lessThanOrEqual($property, $v));
                        break;
                    case BaseFilter::LESS_THAN:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::lessThan($property, $v));
                        break;
                    case BaseFilter::CONTAINS:
                        $filteredResults = array_filter($filteredResults, ContainenceFilter::contains($property, $v));
                        break;
                    case BaseFilter::NOT_CONTAINS:
                        $filteredResults = array_filter($filteredResults, ContainenceFilter::notContains($property, $v));
                        break;
                    case BaseFilter::STARTS_WITH:
                        $filteredResults = array_filter($filteredResults, StringFilter::startsWith($property, $v));
                        break;
                    case BaseFilter::ENDS_WITH:
                        $filteredResults = array_filter($filteredResults, StringFilter::endsWith($property, $v));
                        break;
                    case BaseFilter::EQUALS:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::equals($property, $v));
                        break;
                    case BaseFilter::NOT_EQUAL:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::notEquals($property, $v));
                        break;
                    case BaseFilter::NOT_EMPTY:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::notEmpty($property));
                        break;
                    case BaseFilter::EMPTY_FILTER:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::isEmpty($property));
                        break;
                    case BaseFilter::NOT_NULL:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::notNull($property));
                        break;
                    case BaseFilter::NULL_FILTER:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::null($property));
                        break;
                    case BaseFilter::NOT_STARTS:
                        $filteredResults = array_filter($filteredResults, StringFilter::notStartsWith($property, $v));
                        break;
                    case BaseFilter::NOT_ENDS:
                        $filteredResults = array_filter($filteredResults, StringFilter::notEndsWith($property, $v));
                        break;
                }
            }
        }
    }
    /**
     * @param array $filteredResults
     * @param array $filters
     */
    protected static function mustNot(array &$filteredResults, array $filters)
    {
        foreach ($filters as $filterName => $valuePair) {
            foreach ($valuePair as $property => $v) {
                if (is_array($v) && count($v) > 0) {
                    $v = array_values($v);
                    if (count($v[0]) > 1) {
                        switch ($filterName) {
                            case BaseFilter::RANGES:
                                $filteredResults = array_filter($filteredResults, RangeFilter::notRanges($property, $v[0][0], $v[0][1]));
                                break;
                            case BaseFilter::NOT_RANGES:
                                $filteredResults = array_filter($filteredResults, RangeFilter::ranges($property, $v[0][0], $v[0][1]));
                                break;
                        }
                    } else {
                        switch ($filterName) {
                            case BaseFilter::GROUP:
                                $filteredResults = array_filter($filteredResults, ContainenceFilter::notIn($property, $v));
                                break;
                            case BaseFilter::NOT_GROUP:
                                $filteredResults = array_filter($filteredResults, ContainenceFilter::in($property, $v));
                                break;
                        }
                    }
                }
                $v = array_shift($v);
                switch ($filterName) {
                    case BaseFilter::GREATER_THAN_OR_EQUAL:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::lessThan($property, $v));
                        break;
                    case BaseFilter::GREATER_THAN:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::lessThanOrEqual($property, $v));
                        break;
                    case BaseFilter::LESS_THAN_OR_EQUAL:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::greaterThan($property, $v));
                        break;
                    case BaseFilter::LESS_THAN:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::greaterThanOrEqual($property, $v));
                        break;
                    case BaseFilter::CONTAINS:
                        $filteredResults = array_filter($filteredResults, ContainenceFilter::notContains($property, $v));
                        break;
                    case BaseFilter::NOT_CONTAINS:
                        $filteredResults = array_filter($filteredResults, ContainenceFilter::contains($property, $v));
                        break;
                    case BaseFilter::STARTS_WITH:
                        $filteredResults = array_filter($filteredResults, StringFilter::notStartsWith($property, $v));
                        break;
                    case BaseFilter::ENDS_WITH:
                        $filteredResults = array_filter($filteredResults, StringFilter::notEndsWith($property, $v));
                        break;
                    case BaseFilter::EQUALS:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::notEquals($property, $v));
                        break;
                    case BaseFilter::NOT_EQUAL:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::equals($property, $v));
                        break;
                    case BaseFilter::NOT_EMPTY:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::isEmpty($property));
                        break;
                    case BaseFilter::EMPTY_FILTER:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::notEmpty($property));
                        break;
                    case BaseFilter::NOT_NULL:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::notNull($property));
                        break;
                    case BaseFilter::NULL_FILTER:
                        $filteredResults = array_filter($filteredResults, ComparisonFilter::null($property));
                        break;
                    case BaseFilter::NOT_STARTS:
                        $filteredResults = array_filter($filteredResults, StringFilter::startsWith($property, $v));
                        break;
                    case BaseFilter::NOT_ENDS:
                        $filteredResults = array_filter($filteredResults, StringFilter::endsWith($property, $v));
                        break;
                }
            }
        }
    }
    /**
     * @param array $results
     * @param array $filteredResults
     * @param array $filters
     */
    protected static function should(array &$results, array &$filteredResults, array $filters)
    {
        foreach ($filters as $filterName => $valuePair) {
            foreach ($valuePair as $property => $v) {
                if (is_array($v) && count($v) > 0) {
                    $v = array_values($v);
                    if (count($v[0]) > 1) {
                        switch ($filterName) {
                            case BaseFilter::RANGES:
                                $filteredResults = array_merge($filteredResults, array_filter($results, RangeFilter::ranges($property, $v[0][0], $v[0][1]), ARRAY_FILTER_USE_BOTH));
                                break;
                            case BaseFilter::NOT_RANGES:
                                $filteredResults = array_merge($filteredResults, array_filter($results, RangeFilter::notRanges($property, $v[0][0], $v[0][1]), ARRAY_FILTER_USE_BOTH));
                                break;
                        }
                    } else {
                        switch ($filterName) {
                            case BaseFilter::GROUP:
                                $filteredResults = array_merge($filteredResults, array_filter($results, ContainenceFilter::in($property, $v)));
                                break;
                            case BaseFilter::NOT_GROUP:
                                $filteredResults = array_merge($filteredResults, array_filter($results, ContainenceFilter::notIn($property, $v)));
                                break;
                        }
                    }
                }
                $v = array_shift($v);
                switch ($filterName) {
                    case BaseFilter::GREATER_THAN_OR_EQUAL:
                        $filteredResults = array_merge($filteredResults, array_filter($results, ComparisonFilter::greaterThanOrEqual($property, $v)));
                        break;
                    case BaseFilter::GREATER_THAN:
                        $filteredResults = array_merge($filteredResults, array_filter($results, ComparisonFilter::greaterThan($property, $v)));
                        break;
                    case BaseFilter::LESS_THAN_OR_EQUAL:
                        $filteredResults = array_merge($filteredResults, array_filter($results, ComparisonFilter::lessThanOrEqual($property, $v)));
                        break;
                    case BaseFilter::LESS_THAN:
                        $filteredResults = array_merge($filteredResults, array_filter($results, ComparisonFilter::lessThan($property, $v)));
                        break;
                    case BaseFilter::CONTAINS:
                        $filteredResults = array_merge($filteredResults, array_filter($results, ContainenceFilter::contains($property, $v)));
                        break;
                    case BaseFilter::NOT_CONTAINS:
                        $filteredResults = array_merge($filteredResults, array_filter($results, ContainenceFilter::notContains($property, $v)));
                        break;
                    case BaseFilter::STARTS_WITH:
                        $filteredResults = array_merge($filteredResults, array_filter($results, StringFilter::startsWith($property, $v)));
                        break;
                    case BaseFilter::ENDS_WITH:
                        $filteredResults = array_merge($filteredResults, array_filter($results, StringFilter::endsWith($property, $v)));
                        break;
                    case BaseFilter::EQUALS:
                        $filteredResults = array_merge($filteredResults, array_filter($results, ComparisonFilter::equals($property, $v)));
                        break;
                    case BaseFilter::NOT_EQUAL:
                        $filteredResults = array_merge($filteredResults, array_filter($results, ComparisonFilter::notEquals($property, $v)));
                        break;
                    case BaseFilter::NOT_EMPTY:
                        $filteredResults = array_merge($filteredResults, array_filter($results, ComparisonFilter::notEmpty($property)));
                        break;
                    case BaseFilter::EMPTY_FILTER:
                        $filteredResults = array_merge($filteredResults, array_filter($results, ComparisonFilter::isEmpty($property)));
                        break;
                    case BaseFilter::NOT_NULL:
                        $filteredResults = array_merge($filteredResults, array_filter($results, ComparisonFilter::notNull($property)));
                        break;
                    case BaseFilter::NULL_FILTER:
                        $filteredResults = array_merge($filteredResults, array_filter($results, ComparisonFilter::null($property)));
                        break;
                    case BaseFilter::NOT_STARTS:
                        $filteredResults = array_merge($filteredResults, array_filter($results, StringFilter::notStartsWith($property, $v)));
                        break;
                    case BaseFilter::NOT_ENDS:
                        $filteredResults = array_merge($filteredResults, array_filter($results, StringFilter::notEndsWith($property, $v)));
                        break;
                }
            }
        }
    }
}