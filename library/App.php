<?php
namespace ActionHbg;

class App
{
    public function __construct()
    {
        new \ActionHbg\Theme\Enqueue();
        new \ActionHbg\Theme\Supports();
    }
}
