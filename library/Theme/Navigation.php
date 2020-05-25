<?php

namespace ActionHbg\Theme; 

class Navigation {
    public function __construct(){
        add_filter('wp_nav_menu', array($this, 'appendDropdownClasses'), 10, 2);
    }

    public function appendDropdownClasses($items, $args){
        $str = $items;
        $re = '/(<li.*?class=".*?menu-item-has-children.*?)(">.*?<a.*?)(>.*?<\/a>.*?<ul class="sub-menu)(".*?>.*?<\/ul>.*?<\/li>)/s';  
        $replacement = '$1 js-dropdown c-dropdown c-dropdown--menu$2 class="c-dropdown__toggle"$3 unlist c-dropdown__body$4'; 

        //if it's the mobile view menu, remove the sub-menu 
        if(strpos($args->menu_class, 'mobile') !== false ) {
            $re = '/(<li.*?class=".*?menu-item-has-children.*?>.*?)(<ul.*?class=".*?sub-menu.*?">.*?<\/ul>)/s';
            $replacement='$1';
        }

        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

        if (count($matches) === 0) {
            return $items;
        }

        return preg_replace($re, $replacement, $str);
    }
}