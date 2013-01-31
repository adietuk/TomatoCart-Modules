<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * TomatoCart Open Source Shopping Cart Solution
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License v3 (2007)
 * as published by the Free Software Foundation.
 *
 * @package     TomatoCart
 * @author      Adie Tuk
 * @copyright   Copyright (c) 2013 Adie Tuk.
 * @license     http://www.gnu.org/licenses/gpl.html
 * @link        http://www.twitter.com/adietuk
 * @since       Version 0.5.6
 * @filesource  
 */

class Facebook_Page extends TOC_Module {
    
    protected $code = 'facebook_page';
    protected $author_name = 'Adie Tuk';
    protected $author_url = 'http://www.twitter.com/adietuk';
    protected $version = '0.5.6';
    protected $params = array(
        array('name' => 'MODULE_FACEBOOK_PAGE_URL',
              'title' => 'Facebook Page URL', 
              'type' => 'textfield',
              'value' => 'http://www.facebook.com/tomatocart.id',
              'description' => 'The URL of the Facebook Page'),
        array('name' => 'MODULE_FACEBOOK_PAGE_BORDER',
              'title' => 'Border Color', 
              'type' => 'textfield',
              'value' => 0,
              'description' => 'The border color of the plugin'),
        array('name' => 'MODULE_FACEBOOK_PAGE_COLOR',
              'title' => 'Color Scheme', 
              'type' => 'combobox',
              'mode' => 'local',
              'value' => 'light',
              'description' => 'The color scheme of the plugin',
              'values' => array(
                  array('id' => 'light', 'text' => 'Light'),
                  array('id' => 'dark', 'text' => 'Dark'))),
        array('name' => 'MODULE_FACEBOOK_PAGE_FACES',
              'title' => 'Show Faces', 
              'type' => 'combobox',
              'mode' => 'local',
              'value' => 'true',
              'description' => 'Show profile photos in the plugin',
              'values' => array(
                  array('id' => 'true', 'text' => 'True'),
                  array('id' => 'false', 'text' => 'False'))),
        array('name' => 'MODULE_FACEBOOK_PAGE_STREAM',
              'title' => 'Show Stream', 
              'type' => 'combobox',
              'mode' => 'local',
              'value' => 'true',
              'description' => 'Show the profile stream for the public profile',
              'values' => array(
                  array('id' => 'true', 'text' => 'True'),
                  array('id' => 'false', 'text' => 'False'))),
        array('name' => 'MODULE_FACEBOOK_PAGE_HEADER',
              'title' => 'Header', 
              'type' => 'combobox',
              'mode' => 'local',
              'value' => 'true',
              'description' => 'Show the \'Find us on Facebook\' bar at top. Only shown when either stream or faces are present',
              'values' => array(
                  array('id' => 'true', 'text' => 'True'),
                  array('id' => 'false', 'text' => 'False'))),
        array('name' => 'MODULE_FACEBOOK_PAGE_HEIGHT',
              'title' => 'Height', 
              'type' => 'numberfield',
              'value' => '550',
              'description' => 'Height of Facebook Page Plugin'),
        array('name' => 'MODULE_FACEBOOK_PAGE_WIDTH',
              'title' => 'Width', 
              'type' => 'numberfield',
              'value' => '192',
              'description' => 'Width of Facebook Page Plugin')
    );
    
    public function __construct($config)
    {
        parent::__construct();
        if ( ! empty($config) && is_string($config))
        {
            $this->config = json_decode($config, TRUE);
        }
        $this->title = lang('box_facebook_page_heading');
    }
    
    public function index()
    {
        $data = array();
        $data['heading_title'] = lang('box_facebook_page_heading');
        $border = stripslashes($this->config['MODULE_FACEBOOK_PAGE_BORDER']);
        $url = htmlspecialchars($this->config['MODULE_FACEBOOK_PAGE_URL']);
        $height = stripslashes($this->config['MODULE_FACEBOOK_PAGE_HEIGHT']);
        $width = stripslashes($this->config['MODULE_FACEBOOK_PAGE_WIDTH']);
        if (empty($border))
        {
            $border = 0;
        }
        if ( ! is_numeric($width))
        {
            $width = 292;
        }
        if ( ! is_numeric($height))
        {
            $height = 590;
        }
        $data['content'] = '<iframe src="//www.facebook.com/plugins/likebox.php?href=' . $url .
            '&amp;width=' . $width .
            '&amp;height=' . $height .
            '&amp;show_faces=' . stripslashes($this->config['MODULE_FACEBOOK_PAGE_FACES']) .
            '&amp;colorscheme=' . stripslashes($this->config['MODULE_FACEBOOK_PAGE_COLOR']) .
            '&amp;stream=' . stripslashes($this->config['MODULE_FACEBOOK_PAGE_STREAM']) .
            '&amp;border_color=' . $border .
            '&amp;header=' . stripslashes($this->config['MODULE_FACEBOOK_PAGE_HEADER']) .
            '&amp;appId=202048429857981" scrolling="no" frameborder="0" style="border:none; overflow:hidden; ' .
            'width:' . $width . 'px; height:' . $height . 'px;" allowTransparency="true">' .
            '</iframe>';
        return $this->load_view('index.php', $data);
    }
}