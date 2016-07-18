<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Router Class
 */
class MY_Router extends CI_Router {

    /**
     * Set default controller - Surcharge pour la prise en compte des directory
     *
     * @return  void
     */
    // protected function _set_default_controller()
    // {

    //     if (empty($this->default_controller)) {
    //         show_error('Unable to determine what should be displayed. A default route has not been specified in the routing file.');
    //     }

    //     $segments =  explode('/', $this->default_controller);

    //     $nb_segment = count($segments);

    //     //Unique segment = controller only
    //     if ($nb_segment === 1) {
    //         $method = 'index';
    //     } else {
    //         //Two last elements can be conttroller + mehtod OR dir + conttroller
    //         $class = array_pop($segments);
    //         $this->set_directory(implode('/', $segments));
    //         if (!file_exists(APPPATH.'controllers/'.$this->directory.ucfirst($class).'.php')) {
    //             $method = $class;
    //             $class = array_pop($segments);
    //             $this->set_directory(implode('/', $segments));
    //         } else {
    //             $method = 'index';
    //         }
    //     }

    //     if ( ! file_exists(APPPATH.'controllers/'.$this->directory.ucfirst($class).'.php')) {
    //         // This will trigger 404 later
    //         return;
    //     }


    //     $this->set_class($class);
    //     $this->set_method($method);

    //     // Assign routed segments, index starting from 1
    //     $this->uri->rsegments = array(
    //         1 => $class,
    //         2 => $method
    //     );

    //     log_message('debug', 'No URI present. Default controller set.');
    // }
}
