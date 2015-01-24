<?php
namespace Modules\Accounting\Models;
    /**
     * Posting abstract class
     *
     * PHP Version 5.4
     *
     * @category   Module
     * @package    Accounting
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class PostingAbstract implements \Modules\Accounting\Models\PostingInterface
    {
        public function __construct()
        {
        }
    }