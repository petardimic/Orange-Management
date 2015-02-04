<?php
namespace Modules\HumanResources\Models;

/**
 * Employee class
 *
 * PHP Version 5.4
 *
 * @category   HumanResources
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Employee implements \Framework\Models\MapperInterface, \Framework\Pattern\Multition
{
    /**
     * Employee ID
     *
     * @var int
     * @since 1.0.0
     */
    private $id = null;

    /**
     * User
     *
     * @var \Framework\Models\User\User
     * @since 1.0.0
     */
    private $user = null;

    private static $instances = [];

    public function __construct($id)
    {
    }

    public function getInstance($id)
    {
        if(!isset(self::$instances[$id])) {
            self::$instances[$id] = new self($id);
        }

        return self::$instances[$id];
    }

    /**
     * {@inheritdoc}
     */
    public function init($id)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function __clone()
    {
    }

    public function setUser($id)
    {
        $this->user = new \Framework\Models\User\User($id);
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
    }

    /**
     * {@inheritdoc}
     */
    public function delete()
    {
        // TODO: Implement delete() method.
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        // TODO: Implement create() method.
    }

    /**
     * {@inheritdoc}
     */
    public function update()
    {
        // TODO: Implement update() method.
    }
}