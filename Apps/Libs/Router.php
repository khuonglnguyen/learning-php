<?php
class Apps_Libs_Router
{
    const PARAM_NAME = 'r';
    const HOME_PAGE = 'home';
    const INDEX_PAGE = 'index';

    public static $sourcePath;

    public function __construct($sourcePath = '')
    {
        if ($sourcePath) {
            self::$sourcePath = $sourcePath;
        }
    }

    public function getGET($name = null)
    {
        if ($name != null) {
            return isset($_GET[$name]) ? $_GET[$name] : null;
        }
        return $_GET;
    }

    public function getPOST($name = null)
    {
        if ($name != null) {
            return isset($_POST[$name]) ? $_POST[$name] : null;
        }
        return $_POST;
    }

    public function router()
    {
        $url = $this->getGET(self::PARAM_NAME);
        if (!is_string($url) || !$url || $url===self::INDEX_PAGE) {
            $url = self::HOME_PAGE;
        } else {
            $path = self::$sourcePath . '/' . $url.'.php';
        }
        if (file_exists($path)) {
            return require_once $path;
        } else {
            $this->pageNotFound();
        }
    }

    public function pageNotFound()
    {
        echo 'Page not found 404';
        die();
    }

    public function createUrl($url,$params=[])
    {
        if ($url) {
            $params[self::PARAM_NAME]=$url;
        }
        return $_SERVER['PHP_SELF'].'?'.http_build_query($params);
    }

    public function redirect($url)
    {
        $path=$this->createUrl($url);
        header('Location:$u');
    }
}
