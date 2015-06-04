<?php
namespace phpOMS\Datatypes;

/**
 * SmartDateTime
 *
 * Providing smarter datetimes
 *
 * PHP Version 5.4
 *
 * @category   Modules
 * @package    phpOMS\Datatypes
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class SmartDateTime extends \DateTime
{
    /**
     * {@inheritdoc}
     */
    public function __construct($time = 'now', $timezone = null)
    {
        parent::__construct($time, $timezone);
    }

    /**
     * Modify datetime in a smart way
     *
     * @param int $y        Year
     * @param int $m        Month
     * @param int $d        Day
     * @param int $calendar Calendar
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function smartModify($y, $m = 0, $d = 0, $calendar = CAL_GREGORIAN)
    {
        $y_new       = (int) $this->format('Y') + $y;
        $m_new       = ((int) $this->format('m') + $m) % 12;
        $m_new       = $m_new === 0 ? 12 : $m_new;
        $d_month_old = cal_days_in_month($calendar, (int) $this->format('m'), (int) $this->format('Y'));
        $d_month_new = cal_days_in_month($calendar, $m_new, $y_new);
        $d_old       = (int) $this->format('d');

        if($d_old > $d_month_new) {
            $d_new = $d_month_new;
        } elseif($d_old < $d_month_new && $d_old === $d_month_old) {
            $d_new = $d_month_new;
        } else {
            $d_new = $d_old;
        }

        $this->setDate($y_new, $m_new, $d_new);

        if($d !== 0) {
            $this->modify($d . ' day');
        }
    }

    /**
     * Modify datetime in a smart way
     *
     * @param int $y        Year
     * @param int $m        Month
     * @param int $d        Day
     * @param int $calendar Calendar
     *
     * @return SmartDateTime
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function createModify($y, $m = 0, $d = 0, $calendar = CAL_GREGORIAN)
    {
        $dt = clone $this;
        $dt->smartModify($y, $m, $d, $calendar);

        return $dt;
    }
}