<?php
namespace phpOMS\Datatypes;

class SmartDateTime extends \DateTime
{
    public function __construct($time = 'now', $timezone = null)
    {
        parent::__construct($time, $timezone);
    }

    public function smartModify($y, $m = 0, $d = 0, $calendar = CAL_GREGORIAN)
    {
        $y_new       = (int) $this->format('Y') - $y;
        $m_new       = ((int) $this->format('m') - $m) % 12;
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

    public function createModify($y, $m = 0, $d = 0, $calendar = CAL_GREGORIAN)
    {
        $dt = clone $this;
        $dt->smartModify($y, $m, $d, $calendar);

        return $dt;
    }
}