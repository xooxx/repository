<?php

/**
 * Author: Xooxx <xooxx.dev@gmail.com>
 * Date: 6/16/15
 * Time: 2:07 AM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Xooxx\Foundation\Domain\Model\Repository\Contracts;

/**
 * Class PageRepository.
 */
interface PageRepository
{
    /**
     * Returns a Page of entities meeting the paging restriction provided in the Pageable object.
     *
     * @param Pageable $pageable
     *
     * @return Page
     */
    public function findAll(Pageable $pageable = null);
}