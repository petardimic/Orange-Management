<?php
namespace phpOMS\Module;

/**
 * Module class
 *
 * PHP Version 5.4
 *
 * @category   Module
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
interface ModuleInterface
{
    /**
     * Get modules this module is providing for
     *
     * @return array Providing
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getProviding();

    /**
     * Get module name
     *
     * @return string Name
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getName();

    /**
     * Get dependencies for this module
     *
     * @return array Dependencies
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getDependencies();

    /**
     * Call all modules from which this module is receiving
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function callPull();

    /**
     * Call all modules from which this module is receiving
     *
     * @param \phpOMS\Message\RequestAbstract  $request  Request
     * @param \phpOMS\Message\ResponseAbstract $response Response
     * @param mixed                            $data     Data to pass (if required)
     *
     * @since  1.0.0
     * @author Dennis Eichhorn
     */
    public function call($request, $response, $data = null);
}