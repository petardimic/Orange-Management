<?php
namespace Framework\Http {
    /**
     * Request page enum
     *
     * PHP Version 5.4
     *
     * @category   Base
     * @package    OMS Core
     * @author     OMS Development Team <dev@oms.com>
     * @author     Dennis Eichhorn <d.eichhorn@oms.com>
     * @copyright  2013
     * @license    OMS License 1.0
     * @version    1.0.0
     * @link       http://orange-management.com
     * @since      1.0.0
     */
    abstract class RequestPage extends \Framework\Datatypes\Enum {
        const WEBSITE  = 'website';
        const API      = 'api';
        const SHOP     = 'shop';
        const BACKEND  = 'backend';
        const STATICP  = 'static';
        const FORUM    = 'forum';
        const TICKET   = 'ticket';
        const SUPPORT  = 'support';
        const SURVEY   = 'survey';
        const BLOG     = 'blog';
        const CHART    = 'chart';
        const CALENDAR = 'calendar';
        const PROFILE  = 'profile';
        const CHAT     = 'chat';
    }
}