<?php
namespace Modules\Tasks\Models;

/**
 * Task list class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    Tasks
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class TaskList
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
     * Get all accounts
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

                $sth = $this->dbPool->get('core')->con->prepare('SELECT
                            `' . $this->dbPool->get('core')->prefix . 'tasks`.*, `' . $this->dbPool->get('core')->prefix . 'tasks_element`.`forwarded`
                        FROM
                            `' . $this->dbPool->get('core')->prefix . 'tasks`
                        LEFT JOIN `' . $this->dbPool->get('core')->prefix . 'tasks_element`
                        ON `' . $this->dbPool->get('core')->prefix . 'tasks`.`TaskID` = `' . $this->dbPool->get('core')->prefix . 'tasks_element`.`task`
                        AND `' . $this->dbPool->get('core')->prefix . 'tasks_element`.`forwarded` = 1
                        GROUP BY `' . $this->dbPool->get('core')->prefix . 'tasks`.`TaskID` ' . $search . 'LIMIT ' . $offset . ',' . $limit);
                $sth->execute();

                $result['list'] = $sth->fetchAll();

                $sth = $this->dbPool->get('core')->con->prepare('SELECT FOUND_ROWS();');
                $sth->execute();

                $result['count'] = $sth->fetchAll()[0][0];
                break;
        }

        return $result;
    }

    /**
     * Get task stats
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getStats()
    {
    }
}