<?php

/**
 * Author: Xooxx <xooxx.dev@gmail.com>
 * Date: 6/15/15
 * Time: 11:31 PM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Xooxx\Foundation\Domain\Model\Repository;

use Xooxx\Foundation\Domain\Model\Repository\Collections\ImmutableTypedCollection;
use Xooxx\Foundation\Domain\Model\Repository\Contracts\Fields as FieldsInterface;
use Xooxx\Foundation\Domain\Model\Repository\Contracts\Filter as FilterInterface;
use Xooxx\Foundation\Domain\Model\Repository\Contracts\Page as PageInterface;
use Xooxx\Foundation\Domain\Model\Repository\Contracts\Pageable as PageableInterface;
use Xooxx\Foundation\Domain\Model\Repository\Contracts\Sort as SortInterface;
class Page implements PageInterface
{
    /**
     * @var ImmutableTypedCollection
     */
    protected $elements;
    /**
     * @var int
     */
    protected $totalPages;
    /**
     * @var int
     */
    protected $totalElements;
    /**
     * @var int
     */
    protected $pageNumber;
    /**
     * @var SortInterface
     */
    protected $sort;
    /**
     * @var FilterInterface
     */
    protected $filter;
    /**
     * @var Fields
     */
    protected $fields;

    /**
     * Page constructor.
     *
     * @param array $elements
     * @param                 $totalElements
     * @param                 $pageNumber
     * @param                 $totalPages
     * @param SortInterface $sort
     * @param FilterInterface $filter
     * @param FieldsInterface $fields
     * @throws \ReflectionException
     */
    public function __construct(array $elements, $totalElements, $pageNumber, $totalPages, SortInterface $sort = null, FilterInterface $filter = null, FieldsInterface $fields = null)
    {
        $this->elements = ImmutableTypedCollection::fromArray(array_values($elements));
        $this->totalElements = (int) $totalElements;
        $this->pageNumber = (int) $pageNumber;
        $this->totalPages = (int) $totalPages;
        $this->sort = $sort ? $sort : Sort::null();
        $this->filter = $filter ? $filter : Filter::null();
        $this->fields = $fields ? $fields : Fields::null();
    }
    /**
     * Returns the page content as an array.
     *
     * @return array
     */
    public function content()
    {
        return array_filter($this->elements->toArray());
    }
    /**
     * Returns if there is a previous Page.
     *
     * @return bool
     */
    public function hasPrevious()
    {
        return $this->pageNumber > 1;
    }
    /**
     * Returns whether the current Page is the first one.
     *
     * @return bool
     */
    public function isFirst()
    {
        return 1 === $this->pageNumber;
    }
    /**
     * Returns whether the current Page is the last one.
     *
     * @return bool
     */
    public function isLast()
    {
        return false === $this->hasNext();
    }
    /**
     * Returns if there is a next Page.
     *
     * @return bool
     */
    public function hasNext()
    {
        return $this->pageSize() * $this->pageNumber() < $this->totalPages();
    }
    /**
     * Returns the size of the Page.
     *
     * @return int
     */
    public function pageSize()
    {
        return count($this->elements);
    }
    /**
     * Returns the number of the current Page.
     *
     * @return int
     */
    public function pageNumber()
    {
        return $this->pageNumber;
    }
    /**
     * Returns the number of total pages.
     *
     * @return int
     */
    public function totalPages()
    {
        return $this->totalPages;
    }

    /**
     * Returns the Pageable to request the next Page.
     *
     * @return PageableInterface
     * @throws \ReflectionException
     */
    public function nextPageable()
    {
        return new Pageable($this->pageNumber() + 1, $this->pageSize(), $this->sortings(), $this->filters(), $this->fields());
    }
    /**
     * Returns the sorting parameters for the Page.
     *
     * @return SortInterface
     */
    public function sortings()
    {
        return $this->sort;
    }
    /**
     * @return FilterInterface
     */
    public function filters()
    {
        return $this->filter;
    }
    /**
     * @return FieldsInterface
     */
    public function fields()
    {
        return $this->fields;
    }

    /**
     * Returns the Pageable to request the previous Page.
     *
     * @return PageableInterface
     * @throws \ReflectionException
     */
    public function previousPageable()
    {
        $pageable = new Pageable($this->pageNumber(), $this->pageSize(), $this->sortings(), $this->filters(), $this->fields());
        return $pageable->previousOrFirst();
    }
    /**
     * Returns the total amount of elements.
     *
     * @return int
     */
    public function totalElements()
    {
        return $this->totalElements;
    }

    /**
     * Returns a new Page with the content of the current one mapped by the $converter callable.
     *
     * @param callable $converter
     *
     * @return PageInterface
     * @throws \ReflectionException
     */
    public function map(callable $converter)
    {
        $collection = [];
        foreach ($this->elements as $key => $element) {
            $collection[$key] = $converter($element);
        }
        return new self($collection, $this->totalElements, $this->pageNumber, $this->totalPages, $this->sort, $this->filter, $this->fields);
    }
}