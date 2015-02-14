<?php
namespace Modules\Tasks\Admin;

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
class Dummy implements \phpOMS\Install\DummyInterface
{
    /**
     * {@inheritdoc}
     */
    public static function generate($dbPool, $amount)
    {
        $textGenerator = new \phpOMS\Utils\RnG\Text();
        $textGenerator->setParagraphs(true);

        $titleGenerator = new \phpOMS\Utils\RnG\Text();

        $dbPool->get('core')->con->beginTransaction();

        for($i = 0; $i < $amount; $i++) {
            $dataString = " ('" . $titleGenerator->generateText(rand(3, 15)) . "', '" . $textGenerator->generateText(rand(20, 200)) . "', '" . $textGenerator->generateText(rand(20, 200)) . "', " . rand(0, 3) . ", '" . \phpOMS\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', '" . \phpOMS\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', 1, '" . \phpOMS\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "')";
            $dbPool->get('core')->con->prepare('INSERT INTO `' . $dbPool->get('core')->prefix . 'tasks` (`title`, `desc`, `plain`, `status`, `due`, `done`, `creator`, `created`) VALUES ' . $dataString)->execute();

            $max = rand(0, 5);
            for($c = 0; $c < $max; $c++) {
                $dataString = " ('" . $textGenerator->generateText(rand(20, 200)) . "','" . $textGenerator->generateText(rand(20, 200)) . "', " . ($i + 1) . ", 1, " . rand(0, 3) . ", '" . \phpOMS\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', 1, '" . \phpOMS\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "')";
                $dbPool->get('core')->con->prepare('INSERT INTO `' . $dbPool->get('core')->prefix . 'tasks_element` (`desc`, `plain`, `task`, `creator`, `status`, `due`, `forwarded`, `created`) VALUES ' . $dataString)->execute();
            }
        }

        $dbPool->get('core')->con->commit();
    }
}