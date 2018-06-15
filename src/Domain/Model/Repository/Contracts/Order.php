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

interface Order
{
    const ASCENDING = 'ASC';
    const DESCENDING = 'DESC';
    /**
     * @return bool
     */
    public function isDescending();
    /**
     * @return bool
     */
    public function isAscending();
    /**
     * @return string
     */
    public function direction();
    /**
     * @return string
     */
    public function __toString();
    /**
     * Compares the current object with a second object.
     * It will compare its type and and its properties values.
     *
     * @param Order $object
     *
     * @return bool
     */
    public function equals(Order $object);
    /**
     * Creates a null Value Object.
     *
     * @return self
     */
    public static function null();
    /**
     * @return bool
     */
    public function isNull();
}