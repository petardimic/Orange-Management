<?php
namespace phpOMS\Uri;

/**
 * Uri interface
 *
 * Used in order to create and evaluate a uri
 *
 * PHP Version 5.4
 *
 * @category   Uri
 * @package    Framework
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Http implements \phpOMS\Uri\UriInterface
{
    /**
     * Constructor
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function __construct()
    {
    }

    /**
     * Get current uri
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public static function getCurrent()
    {
        /** @noinspection PhpUndefinedConstantInspection */
        return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    /**
     * {@inheritdoc}
     */
    public static function create($data, $query = null)
    {
        $uri = '/' . rtrim(implode('/', $data), '/') . '.php';

        if(isset($query) && $query !== []) {
            /*
            $i = 0;
            foreach($query as $key => $para) {
                if($i == 0) {
                    $uri .= '?' . $key . '=' . $para;
                    $i++;
                    continue;
                }

                $uri .= '&' . $key . '=' . $para;
            }*/

            $uri .= '?' . http_build_query($query);
        }

        return $uri;
    }

    public static function routify($uri)
    {
        $route = parse_url($uri);
        $path  = explode('/', ltrim(rtrim($route['path'], '.php'), '/'));

        $count = count($path);

        for($i = 0; $i < $count; $i++) {
            $path['l' . $i] = $path[$i];
            unset($path[$i]);
        }

        $query = [];
        if(isset($route['query'])) {
            parse_str($route['query'], $query);
        }

        return ['route' => $path, 'query' => $query];
    }

    /**
     * {@inheritdoc}
     */
    public static function isValid($uri)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function parse($uri)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function toString()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function resolve($base)
    {
    }
}
