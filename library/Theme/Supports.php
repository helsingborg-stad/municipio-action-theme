<?php

namespace ActionHbg\Theme;

class Supports
{
    public function __construct()
    {
        add_filter('body_class', array($this, 'noMaterialDesign'));
        add_filter('Municipio/desktop_menu_breakpoint', array($this, 'menuBreakpoint'));
        add_filter('Municipio/mobile_menu_breakpoint', array($this, 'mobileMenuBreakpoint')); 
        add_filter('Municipio/Jumbo/NavGroupClass', '__return_false');
    }

    public function noMaterialDesign($classes)
    {
      if(is_array($classes)) {
        $classes[] = "material-no-shadow"; 
      }
      return $classes; 
    }

    public function menuBreakpoint($classes) {

      $classes = "hidden-xs hidden-sm hidden-md"; 

      return $classes; 
    }

    public function mobileMenuBreakpoint($classes) {

      $classes = "hidden-lg"; 

      return $classes; 
    }
}
