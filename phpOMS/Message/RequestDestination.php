<?php
namespace phpOMS\Message;

/**
 * Request page enum
 *
 * Possible page requests. Page requests can have completely different themes, permissions and page structures.
 *
 * PHP Version 5.4
 *
 * @category   Request
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class RequestDestination extends \phpOMS\Datatypes\Enum
{
    const WEBSITE = 'website';     /* Website */
    const API = 'api';         /* API */
    const SHOP = 'shop';        /* Shop */
    const BACKEND = 'backend';     /* Backend */
    const STATICP = 'static';      /* Static content */
    const FORUM = 'forum';       /* Forum */
    const TICKET = 'ticket';      /* ???? */
    const SUPPORT = 'support';     /* Support center */
    const SURVEY = 'survey';      /* Survey page */
    const BLOG = 'blog';        /* Blog */
    const CHART = 'chart';       /* Chart view */
    const CALENDAR = 'calendar';    /* Calendar */
    const PROFILE = 'profile';     /* User profile page */
    const CHAT = 'chat';        /* Chat page */
    const GALLERY = 'gallery';     /* Chat page */
    // This or let api handle this const GUI = 'gui';     /* Request GUI elements */
}