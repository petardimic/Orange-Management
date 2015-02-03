<?php
namespace Web\Views\Lists;

/**
 * Pagination view
 *
 * PHP Version 5.4
 *
 * @category   Theme
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class PaginationView extends \Framework\Views\ViewAbstract
{
    /**
     * Maximum amount of pages
     *
     * @var int
     * @since 1.0.0
     */
    protected $maxPages = 7;

    /**
     * Current page id
     *
     * @var int
     * @since 1.0.0
     */
    protected $page = 50;

    /**
     * How many pages exists?
     *
     * @var int
     * @since 1.0.0
     */
    protected $pages = 100;

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getMaxPages()
    {
        return $this->maxPages;
    }

    /**
     * @param int $maxPages
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setMaxPages($maxPages)
    {
        $this->maxPages = $maxPages;
    }
}
