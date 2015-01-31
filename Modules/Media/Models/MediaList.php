<?php
namespace Modules\Media\Models;

/**
 * Media list class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Media
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class MediaList
{
    /**
     * Database
     *
     * @var \Framework\DataStorage\Database\Database
     * @since 1.0.0
     */
    private $db = null;

    /**
     * Constructor
     *
     * @param \Framework\DataStorage\Database\Pool $dbPool Database pool instance
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($dbPool)
    {
        $this->dbPool = $dbPool;
    }

    /**
     * Get all news
     *
     * This function gets all accounts in a range
     *
     * @param array $filter Filter for search results
     * @param int   $offset Offset for first account
     * @param int   $limit  Limit for results
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getList($filter = null, $offset = 0, $limit = 100)
    {
        $result = null;

        switch($this->dbPool->get('core')->getType()) {
            case \Framework\DataStorage\Database\DatabaseType::MYSQL:
                $search = $this->dbPool->get('core')->generate_sql_filter($filter, true);

                // SQL_CALC_FOUND_ROWS
                $sth = $this->dbPool->get('core')->con->prepare(
                    'SELECT
                            `' . $this->dbPool->get('core')->prefix . 'media`.*,
                            `' . $this->dbPool->get('core')->prefix . 'account_data`.`name1`,
                            `' . $this->dbPool->get('core')->prefix . 'account_data`.`name2`,
                            `' . $this->dbPool->get('core')->prefix . 'account_data`.`name3`
                        FROM
                            `' . $this->dbPool->get('core')->prefix . 'media`
                        LEFT JOIN `' . $this->dbPool->get('core')->prefix . 'account_data`
                        ON `' . $this->dbPool->get('core')->prefix . 'media`.`media_creator` = `' . $this->dbPool->get('core')->prefix . 'account_data`.`account`
                        GROUP BY `' . $this->dbPool->get('core')->prefix . 'media`.`media_id` '
                    . $search . 'LIMIT ' . $offset . ',' . $limit
                );
                $sth->execute();

                $result['list'] = $sth->fetchAll();

                $sth = $this->dbPool->get('core')->con->prepare(
                    'SELECT FOUND_ROWS();'
                );
                $sth->execute();

                $result['count'] = $sth->fetchAll()[0][0];
                break;
        }

        return $result;
    }
}