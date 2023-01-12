<?php

// if (! function_exists('layoutConfig')) {
//     function layoutConfig($configLayout) {

//         if ($configLayout === 'vertical-light-menu') {

//             $__getConfiguration = Config::get('app-config.layout.vlm');
            
//         } else if ($configLayout === 'vertical-dark-menu') {
            
//             $__getConfiguration = Config::get('app-config.layout.vdm');
            
//         } else if ($configLayout === 'collapsible-menu') {
            
//             $__getConfiguration = Config::get('app-config.layout.cm');
            
//         }

//         return $__getConfiguration;
//     }
// }


if (! function_exists('layoutConfig')) {
    function layoutConfig() {

        if (Request::is('modern-light-menu/*')) {

            $__getConfiguration = Config::get('app-config.layout.vlm');
            
        } else if (Request::is('modern-dark-menu/*')) {
            
            $__getConfiguration = Config::get('app-config.layout.vdm');
            
        } else if (Request::is('collapsible-menu/*')) {
            
            $__getConfiguration = Config::get('app-config.layout.cm');
            
        } 
        
        // RTL

        else if (Request::is('rtl/modern-light-menu/*')) {

            $__getConfiguration = Config::get('app-config.layout.vlm-rtl');
            
        } else if (Request::is('rtl/modern-dark-menu/*')) {
            
            $__getConfiguration = Config::get('app-config.layout.vdm-rtl');
            
        } else if (Request::is('rtl/collapsible-menu/*')) {
            
            $__getConfiguration = Config::get('app-config.layout.cm-rtl');
            
        }



        // Login

        else if (Request::is('login')) {

            $__getConfiguration = Config::get('app-config.layout.vlm');
            
        }

        return $__getConfiguration;
    }
}



if (!function_exists('getRouterValue')) {
    function getRouterValue() {
        
        if (Request::is('modern-light-menu/*')) {
            
            $__getRoutingValue = '/modern-light-menu';
            
        } else if (Request::is('modern-dark-menu/*')) {
            
            $__getRoutingValue = '/modern-dark-menu';
            
        } else if (Request::is('collapsible-menu/*')) {
            
            $__getRoutingValue = '/collapsible-menu';

        }


        // RTL

        else if (Request::is('rtl/modern-light-menu/*')) {

            $__getRoutingValue = '/rtl/modern-light-menu';
            
        } else if (Request::is('rtl/modern-dark-menu/*')) {
            
            $__getRoutingValue = '/rtl/modern-dark-menu';
            
        } else if (Request::is('rtl/collapsible-menu/*')) {
            
            $__getRoutingValue = '/rtl/collapsible-menu';
            
        }


        // Login

        else if (Request::is('login')) {

            $__getRoutingValue = '/modern-light-menu';
            
        }
        
        
        return $__getRoutingValue;
    }
}