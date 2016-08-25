<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('css_url')) {

    function css_url() {
        $CI = & get_instance();
        return base_url() . $CI->config->item('assets_path');
    }

}

/**
 * Load CSS
 * Creates the <link> tag that links all requested css file
 * @access  public
 * @param   string
 * @return  string
 */
if (!function_exists('queue_css')) {

    function queue_css($file, $media = 'all', $atts = array()) {
        if (!empty($file)) {
            foreach ($file as $e) {
                $element = '<link rel="stylesheet" href="' . css_url() . $e . '"';

                foreach ($file as $key => $val)
                    $element .= ' ' . $key . '="' . $val . '"';
                $element .= ' />' . "\n";
                echo $element;
            }
        }
    }

}

/**
 * Load JS
 * Creates the <script> tag that links all requested js file
 * @access  public
 * @param   string
 * @param     array     $atts Optional, additional key/value attributes to include in the SCRIPT tag
 * @return  string
 */
if (!function_exists('js_url')) {

    function js_url() {
        $CI = & get_instance();
        return base_url() . $CI->config->item('assets_path');
    }

}


if (!function_exists('queue_js')) {

    function queue_js($file, $atts = array()) {
        if (!empty($file)) {
             foreach ($file as $e) {
                $element = '<script type="text/javascript" src="' . js_url() . $e . '"';

                foreach ($file as $key => $val)
                    $element .= ' ' . $key . '="' . $val . '"';
                $element .= '></script>' . "\n";
                echo $element;
            }
//                foreach ($file as $e) 
//                {
//                    $element = '<script type="text/javascript" src="' . js_url() . $e . '"';
//                
//
////                    $element .= ' ' . $key . '="' . $val . '"';
//                    $element .= '></script>' . "\n";
//                }



            echo $element;
        }
    }

}
/* End of file queuescript_helper.php */ 

