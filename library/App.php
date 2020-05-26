<?php
namespace ActionHbg;

class App
{
    public function __construct()
    {
        new \ActionHbg\Controller\ChildController(); 
        new \ActionHbg\Theme\Navigation(); 
        new \ActionHbg\Theme\Enqueue();
        new \ActionHbg\Theme\Supports();
    }
}
