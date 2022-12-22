<?php

namespace Core;

defined('ROOTPATH') OR die('ACCES DENIED');
/**
 * Image Class
 * 
 * @author Michał Borowiec <michal@cursed.pl>
 * @version 1.0 
 * @package Core\Pager
 * 
 */

class Pager {
    public $links = array();
    public $offset = 0;
    public $pageNumber = 1;
    public $start = 1;
    public $end = 1;
    public $limit = 10;
    public $navClass = "";
    public $ulClass = "pagination, justify-content-center";
    public $liClass = "page=item";
    public $aClass = "page-link";

    public function __construct($limit = 10, $extras = 1) {
        $pageNumber = isset($_GET['p']) ? (int) $_GET['p'] : 1;
        $pageNumber = $pageNumber < 1 ? 1 : $pageNumber;

        $this->end = $pageNumber + $extras;
        $this->start = $pageNumber - $extras;

        if($this->start < 1) {
            $this->start = 1;
        }

        $this->offset = ($pageNumber - 1) * $limit;
        $this->pageNumber = $pageNumber;
        $this->limit = $limit;

        $url = isset($_GET['url']) ? $_GET['url'] : '';

        $currentLink = ROOT . "/" . $url . "?" . trim(str_replace("url=", "", str_replace($url, "", $_SERVER['QUERY_STRING'])), '&');
        $currentLink = !strstr($currentLink, "p=") ? $currentLink . "p=1" : $currentLink;

        if(!strstr($currentLink, "?")) {
            $currentLink = str_replace("&p=", "?p=", $currentLink);
        }
        $firstLink = preg_replace('/p=[0-9]+/', "p=1", $currentLink);
        $nextLink = preg_replace('/p=[0-9]+/', "p=" . ($pageNumber + $extras + 1), $currentLink);

        $this->links['first'] = $firstLink;
        $this->links['current'] = $currentLink;
        $this->links['next'] = $nextLink;
    }

    public function display($recordCount = null) {
        // TODO: paginator
    }
}