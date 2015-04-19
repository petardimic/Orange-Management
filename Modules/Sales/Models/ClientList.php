<?php
namespace Modules\Sales\Models;

/**
 * Sales client list class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Modules\Sales
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class ClientList
{

// region Class Fields
    /**
     * Database instance
     *
     * @var \phpOMS\DataStorage\Database\Database
     * @since 1.0.0
     */
    private $dbPool = null;
// endregion

    /**
     * Constructor
     *
     * @param \phpOMS\DataStorage\Database\Pool $dbPool Database pool instance
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct($dbPool)
    {
        $this->dbPool = $dbPool;
    }

    /**
     * Get all clients
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
            case \phpOMS\DataStorage\Database\DatabaseType::MYSQL:
                $search = $this->dbPool->get('core')->generate_sql_filter($filter, true);

                // SQL_CALC_FOUND_ROWS
                $sth = $this->dbPool->get('core')->con->prepare(
                    'SELECT DISTINCT
                            `' . $this->dbPool->get('core')->prefix . 'sales_client`.*,
                            `' . $this->dbPool->get('core')->prefix . 'accounts_data`.`name1`,
                            `' . $this->dbPool->get('core')->prefix . 'accounts_data`.`name2`,
                            `' . $this->dbPool->get('core')->prefix . 'accounts_data`.`name3`
                        FROM
                            `' . $this->dbPool->get('core')->prefix . 'sales_client`
                        LEFT JOIN `' . $this->dbPool->get('core')->prefix . 'accounts_data`
                        ON `' . $this->dbPool->get('core')->prefix . 'sales_client`.`account` = `' . $this->dbPool->get('core')->prefix . 'accounts_data`.`account`
                        GROUP BY `' . $this->dbPool->get('core')->prefix . 'sales_client`.`SalesClientID` '
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