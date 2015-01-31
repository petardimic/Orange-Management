<?php
namespace Modules\News\Admin;

/**
 * Dummy class
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    News
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Dummy implements \Framework\Install\DummyInterface
{
    /**
     * {@inheritdoc}
     */
    public static function generate($db, $amount)
    {
        $textGenerator = new \Framework\Utils\RnG\Text();
        $textGenerator->setParagraphs(true);

        $titleGenerator = new \Framework\Utils\RnG\Text();
        $dbPool->get('core')->con->beginTransaction();

        for($i = 0; $i < $amount; $i++) {
            $dataString = " ( '" . $titleGenerator->generateText(rand(3, 7)) . "', " . rand(0, 1) . ", '" . $textGenerator->generateText(rand(200, 600)) . "', '" . $textGenerator->generateText(rand(200, 600)) . "', " . rand(0, 1) . ", 'en', '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', 1, '" . \Framework\Utils\RnG\DateTime::generateDateTime('2005-12-10', '2014-12-31')->format('Y-m-d H:i:s') . "', 1)";
            $dbPool->get('core')->con->prepare('INSERT INTO `' . $dbPool->get('core')->prefix . 'news` (`title`, `featured`, `content`, `plain`, `type`, `lang`, `publish`, `created`, `author`, `last_changed`, `last_change`) VALUES ' . $dataString)->execute();
        }

        $dbPool->get('core')->con->commit();
    }
}