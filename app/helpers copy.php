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

// use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;



if (! function_exists('layoutConfig')) {
    function layoutConfig() {
        // $__getConfiguration = Config::get('app-config.layout.vdm');
        Log::info('I am in layout config helpers.php');
        // Log::debug($__getConfiguration);
        if (Request::is('modern-light-menu/*')) {

            $__getConfiguration = Config::get('app-config.layout.vlm');
            
        } else if (Request::is('modern-dark-menu/*')) {
            Log::info('I am in layout config dark menu');
            $__getConfiguration = Config::get('app-config.layout.vdm');
            Log::debug($__getConfiguration);


        } else if (Request::is('/')) {
            Log::info("I am in request '/*");
            $__getConfiguration = Config::get('app-config.layout.vdm');

        } else if (Request::is('/register')) {
            Log::info("I am in request '/requster");
            $__getConfiguration = Config::get('app-config.layout.vdm');
            
        } else if (Request::is('/new-orders')) {

            $__getConfiguration = Config::get('app-config.layout.vdm');
        } 
        
        else if (Request::is('collapsible-menu/*')) {
            
            $__getConfiguration = Config::get('app-config.layout.cm');
            
        }

        // // RTL

        // else if (Request::is('rtl/modern-light-menu/*')) {

        //     $__getConfiguration = Config::get('app-config.layout.vlm-rtl');

        // } else if (Request::is('rtl/modern-dark-menu/*')) {

        //     $__getConfiguration = Config::get('app-config.layout.vdm-rtl');

        // } else if (Request::is('rtl/collapsible-menu/*')) {

        //     $__getConfiguration = Config::get('app-config.layout.cm-rtl');

        // }


        //new orders 
        else if (Request::is('/new-orders/*')) {

            // $__getConfiguration = Config::get('app-config.layout.vlm');
            $__getConfiguration = Config::get('app-config.layout.vdm');
        }

        // Login

        else if (Request::is('login')) {

            // $__getConfiguration = Config::get('app-config.layout.vlm');
            $__getConfiguration = Config::get('app-config.layout.vdm');
            
        }

        //register

        else if (Request::is('register')) {

            // $__getConfiguration = Config::get('app-config.layout.vlm');
            $__getConfiguration = Config::get('app-config.layout.vdm');
        }

        return $__getConfiguration;
    }
}



if (!function_exists('getRouterValue')) {
    function getRouterValue() {
        // $__getRoutingValue = '/modern-dark-menu';
        if (Request::is('modern-light-menu/*')) {
            
            $__getRoutingValue = '/modern-light-menu';
            
        } else if (Request::is('modern-dark-menu/*')) {
            
            $__getRoutingValue = '/modern-dark-menu';
            
        } else if (Request::is('/')) {

            $__getRoutingValue = '/modern-dark-menu';
        }   else if (Request::is('collapsible-menu/*')) {
            
            $__getRoutingValue = '/collapsible-menu';

        } else if (Request::is('/new-orders')) {

            $__getRoutingValue = '/modern-dark-menu';
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



///


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

// use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;



if (!function_exists('layoutConfig')) {
    function layoutConfig()
    {
        // $__getConfiguration = Config::get('app-config.layout.vdm');
        Log::info('I am in layout config helpers.php');
        // Log::debug($__getConfiguration);
        if (Request::is('modern-light-menu/*')) {

            $__getConfiguration = Config::get('app-config.layout.vlm');
        } else if (Request::is('modern-dark-menu/*')) {
            Log::info('I am in layout config dark menu');
            $__getConfiguration = Config::get('app-config.layout.vdm');
            Log::debug($__getConfiguration);
        } else if (Request::is('/')) {
            Log::info("I am in request '/*");
            $__getConfiguration = Config::get('app-config.layout.vdm');
        } else if (Request::is('/register')) {
            Log::info("I am in request '/requster");
            $__getConfiguration = Config::get('app-config.layout.vdm');
        } else if (Request::is('/new-orders')) {

            $__getConfiguration = Config::get('app-config.layout.vdm');
        } else if (Request::is('collapsible-menu/*')) {

            $__getConfiguration = Config::get('app-config.layout.cm');
        }

        // // RTL

        // else if (Request::is('rtl/modern-light-menu/*')) {

        //     $__getConfiguration = Config::get('app-config.layout.vlm-rtl');

        // } else if (Request::is('rtl/modern-dark-menu/*')) {

        //     $__getConfiguration = Config::get('app-config.layout.vdm-rtl');

        // } else if (Request::is('rtl/collapsible-menu/*')) {

        //     $__getConfiguration = Config::get('app-config.layout.cm-rtl');

        // }


        //new orders 
        else if (Request::is('/new-orders/*')) {

            // $__getConfiguration = Config::get('app-config.layout.vlm');
            $__getConfiguration = Config::get('app-config.layout.vdm');
        }

        // Login

        else if (Request::is('login')) {

            // $__getConfiguration = Config::get('app-config.layout.vlm');
            $__getConfiguration = Config::get('app-config.layout.vdm');
        }

        //register

        else if (Request::is('register')) {

            // $__getConfiguration = Config::get('app-config.layout.vlm');
            $__getConfiguration = Config::get('app-config.layout.vdm');
        }

        return $__getConfiguration;
    }
}



if (!function_exists('getRouterValue')) {
    function getRouterValue()
    {
        // $__getRoutingValue = '/modern-dark-menu';
        if (Request::is('modern-light-menu/*')) {

            $__getRoutingValue = '/modern-light-menu';
        } else if (Request::is('modern-dark-menu/*')) {

            $__getRoutingValue = '/modern-dark-menu';
        } else if (Request::is('/')) {

            $__getRoutingValue = '/modern-dark-menu';
        } else if (Request::is('collapsible-menu/*')) {

            $__getRoutingValue = '/collapsible-menu';
        } else if (Request::is('/new-orders')) {

            $__getRoutingValue = '/modern-dark-menu';
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
