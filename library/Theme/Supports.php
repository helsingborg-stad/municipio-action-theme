<?php

namespace ActionHbg\Theme;

class Supports
{
    public function __construct()
    {
        add_filter('body_class', array($this, 'noMaterialDesign'));
    }

    public function noMaterialDesign($classes)
    {
      if(is_array($classes)) {
        $classes[] = "material-no-shadow"; 
      }
      return $classes; 
    }
}
