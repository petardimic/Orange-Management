<?php
namespace Modules\Tasks\Admin {
    /**
     * Dummy class
     *
     * PHP Version 5.4
     *
     * @category   Modules
     * @package    Dummy
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    class Dummy implements \Framework\Install\DummyInterface {
        /**
         * Generate dummy data
         *
         * @param \Framework\DataStorage\Database\Database $db     Database instance
         * @param int                                      $amount Amount of dummy entries
         *
         * @since  1.0.0
         * @author Dennis Eichhorn <d.eichhorn@oms.com>
         */
        public static function generate($db, $amount) {
            $textGenerator = new \Framework\Utils\RnG\Text();
            $textGenerator->setParagraphs(true);

            $titleGenerator = new \Framework\Utils\RnG\Text();

            $db->con->beginTransaction();

            for($i = 0; $i < $amount; $i++) {
                $dataString = " ('" . $titleGenerator->generateText(rand(3, 15)) . "', '" . $textGenerator->generateText(rand(20, 200)) . "', '" . $textGenerator->generateText(rand(20, 200)) . "', " . rand(0, 3) . ", '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', 1, '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "')";
                $db->con->prepare('INSERT INTO `' . $db->prefix . 'tasks` (`title`, `desc`, `plain`, `status`, `due`, `done`, `creator`, `created`) VALUES ' . $dataString)->execute();

                $max = rand(0, 5);
                for($c = 0; $c < $max; $c++) {
                    $dataString = " ('" . $textGenerator->generateText(rand(20, 200)) . "','" . $textGenerator->generateText(rand(20, 200)) . "', " . ($i + 1) . ", 1, " . rand(0, 3) . ", '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', 1, '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "')";
                    $db->con->prepare('INSERT INTO `' . $db->prefix . 'tasks_element` (`desc`, `plain`, `task`, `creator`, `status`, `due`, `forwarded`, `created`) VALUES ' . $dataString)->execute();
                }
            }

            $db->con->commit();
        }
    }
}