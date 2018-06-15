<?php

/**
 * Author: Xooxx <xooxx.dev@gmail.com>
 * Date: 6/01/16
 * Time: 18:25.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Xooxx\Foundation\Domain\Model\Repository\Contracts;

interface Page
{
    /**
     * Page constructor.
     *
     * @param array  $elements
     * @param        $totalElements
     * @param        $pageNumber
     * @param        $totalPages
     * @param Sort   $sort
     * @param Filter $filter
     * @param Fields $fields
     */
    public function __construct(array $elements, $totalElements, $pageNumber, $totalPages, Sort $sort = null, Filter $filter = null, Fields $fields = null);
    /**
     * Returns the page content as an array.
     *
     * @return array
     */
    public function content();
    /**
     * Returns if there is a previous Page.
     *
     * @return bool
     */
    public function hasPrevious();
    /**
     * Returns whether the current Page is the first one.
     *
     * @return bool
     */
    public function isFirst();
    /**
     * Returns whether the current Page is the last one.
     *
     * @return bool
     */
    public function isLast();
    /**
     * Returns if there is a next Page.
     *
     * @return bool
     */
    public function hasNext();
    /**
     * Returns the size of the Page.
     *
     * @return int
     */
    public function pageSize();
    /**
     * Returns the number of the current Page.
     *
     * @return int
     */
    public function pageNumber();
    /**
     * Returns the number of total pages.
     *
     * @return int
     */
    public function totalPages();
    /**
     * Returns the Pageable to request the next Page.
     *
     * @return Pageable
     */
    public function nextPageable();
    /**
     * Returns the sorting parameters for the Page.
     *
     * @return Sort
     */
    public function sortings();
    /**
     * @return Filter
     */
    public function filters();
    /**
     * Returns the Pageable to request the previous Page.
     *
     * @return Pageable
     */
    public function previousPageable();
    /**
     * Returns the total amount of elements.
     *
     * @return int
     */
    public function totalElements();
    /**
     * Returns a new Page with the content of the current one mapped by the $converter callable.
     *
     * @param callable $converter
     *
     * @return Page
     */
    public function map(callable $converter);
    /**
     * @return Fields
     */
    public function fields();
}