<?php

/**
 * Author: Xooxx <xooxx.dev@gmail.com>
 * Date: 6/16/15
 * Time: 2:05 AM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Xooxx\Foundation\Domain\Model\Repository\Contracts;

/**
 * Class Repository.
 */
interface Repository
{
    /**
     * Returns the total amount of elements in the repository given the restrictions provided by the Filter object.
     *
     * @param Filter|null $filter
     *
     * @return int
     */
    public function count(Filter $filter = null);
    /**
     * Returns whether an entity with the given id exists.
     *
     * @param $id
     *
     * @return bool
     */
    public function exists(Identity $id);
}