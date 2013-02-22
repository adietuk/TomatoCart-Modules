<?php
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
 * @since       Version 1.0.4
 * @filesource  
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ym_Support extends TOC_Module {
    
    protected $code = 'ym_support';
    protected $author_name = 'Adie Tuk';
    protected $author_url = 'http://www.twitter.com/adietuk';
    protected $version = '1.0.4';
    protected $params = array(
            array('name' => 'MODULE_YM_SUPPORT_USERNAME',
                  'title' => 'Username', 
                  'type' => 'textfield',
                  'value' => 'sales1;sales2;sales3',
                  'description' => 'Username(s) (Seperated by ";")'),
            array('name' => 'MODULE_YM_SUPPORT_TITLE',
                  'title' => 'Title Name', 
                  'type' => 'textfield',
                  'value' => 'Sales 1;Sales 2;Sales 3',
                  'description' => 'Add title(s) of above each username (Seperated by ";")'),
            array('name' => 'MODULE_YM_SUPPORT_TYPE',
                  'title' => 'Icon Type',  
                  'type' => 'combobox',
                  'mode' => 'local',
                  'value' => '6',
                  'description' => 'Type of icon',
                  'values' => array(
                      array('id' => '0', 'text' => 'Icon 1'),
                      array('id' => '1', 'text' => 'Icon 2'),
                      array('id' => '2', 'text' => 'Icon 3'),
                      array('id' => '3', 'text' => 'Icon 4'),
                      array('id' => '4', 'text' => 'Icon 5'),
                      array('id' => '5', 'text' => 'Icon 6'),
                      array('id' => '6', 'text' => 'Icon 7'),
                      array('id' => '7', 'text' => 'Icon 8'),
                      array('id' => '8', 'text' => 'Icon 9'),
                      array('id' => '9', 'text' => 'Icon 10'),
                      array('id' => '10', 'text' => 'Icon 11'),
                      array('id' => '11', 'text' => 'Icon 12'),
                      array('id' => '12', 'text' => 'Icon 13'),
                      array('id' => '13', 'text' => 'Icon 14'),
                      array('id' => '14', 'text' => 'Icon 15'),
                      array('id' => '15', 'text' => 'Icon 16'),
                      array('id' => '16', 'text' => 'Icon 17'),
                      array('id' => '17', 'text' => 'Icon 18'),
                      array('id' => '18', 'text' => 'Icon 19'),
                      array('id' => '19', 'text' => 'Icon 20'),
                      array('id' => '20', 'text' => 'Icon 21'),
                      array('id' => '21', 'text' => 'Icon 22'),
                      array('id' => '22', 'text' => 'Icon 23'),
                      array('id' => '23', 'text' => 'Icon 24'),
                      array('id' => '24', 'text' => 'Icon 25'))),
            array('name' => 'MODULE_YM_SUPPORT_POSITION',
                  'title' => 'Columns', 
                  'type' => 'combobox',
                  'mode' => 'local',
                  'value' => 'col1',
                  'description' => 'Columns of the icons',
                  'values' => array(
                     array('id' => 'col1', 'text' => 'Column 1'),
                     array('id' => 'col2', 'text' => 'Column 2'),
                     array('id' => 'col3', 'text' => 'Column 3'))
                )
        );
    
    public function __construct($config)
    {
        parent::__construct();
        if (!empty($config) && is_string($config))
        {
            $this->config = json_decode($config, TRUE);
        }
        $this->title = lang('box_ym_support_title');
    }
    
    public function index()
    {
        $data = array();
        $data['heading_title'] = lang('box_ym_support_title');
        $data['position'] = $this->config['MODULE_YM_SUPPORT_POSITION'];
        $usernames = explode(';', $this->config['MODULE_YM_SUPPORT_USERNAME']);
        $titles = explode(';', $this->config['MODULE_YM_SUPPORT_TITLE']);
        $type = $this->config['MODULE_YM_SUPPORT_TYPE'];
        $data['content'] = '';
        if ($this->config['MODULE_YM_SUPPORT_POSITION'] === 'col1')
        {
            if (($type === '0') || ($type === '1') || ($type === '2') || ($type === '3') || ($type === '4') || ($type === '5'))
            {
                if (substr($this->config['MODULE_YM_SUPPORT_USERNAME'], -1, 1) === ';')
                {
                    $data['content'] .= '<div class="contents"><table cellspacing="5" align="center">';
                    for ($i = 0; $i < (count($usernames) - 1); ++$i)
                    {
                        $data['content'] .= '<tr>' .
                                            '<td align="right">' . trim($titles[$i]) . '</td>' .
                                            '<td>&nbsp;:&nbsp;</td>' .
                                            '<td>' . '<a href="ymsgr:sendIM?' . trim($usernames[$i]) . '">' .
                                            '<img border=0 src="http://opi.yahoo.com/online?u=' . trim($usernames[$i]) . '&m=g&t=' . $type . '" />' .
                                            '</a></td>' .
                                            '</tr>';
                    }
                    $data['content'] .= '</table></div>';
                }
                else
                {
                    $data['content'] .= '<div class="contents"><table align="center" cellspacing="5">';
                    for ($i = 0; $i < count($usernames); ++$i)
                    {
                        $data['content'] .= '<tr>' .
                                           '<td>' . trim($titles[$i]) . '</td>' .
                                           '<td>&nbsp;:&nbsp;</td>' .
                                           '<td>' . '<a href="ymsgr:sendIM?' . trim($usernames[$i]) . '">' .
                                           '<img border=0 src="http://opi.yahoo.com/online?u=' . trim($usernames[$i]) . '&m=g&t=' . $type . '" />' .
                                           '</a></td>' .
                                           '</tr>';
                    }
                }
                $data['content'] .= '</table></div>';
            }
            else
            {
                $data['content'] .= '<div class="contents"><div style="text-align: center;">';
                if (substr($this->config['MODULE_YM_SUPPORT_USERNAME'], -1, 1) === ';')
                {
                    for ($i = 0; $i < count($usernames)-1; ++$i)
                    {
                        $data['content'] .= '<span style="font-weight: bold; margin-top: 5px;">' . trim($titles[$i]) . '</span><br />' .
                                            '<a href="ymsgr:sendIM?' . trim($usernames[$i]) . '">' .
                                            '<img border=0 src="http://opi.yahoo.com/online?u=' . trim($usernames[$i]) . '&m=g&t=' . $this->config['MODULE_YM_SUPPORT_TYPE'] . '" />' .
                                            '</a>' .
                                            '<br /><br />';
                    }
                    $data['content'] .= '</div>';
                }
                else
                {
                    for ($i = 0; $i < count($usernames); ++$i)
                    {
                        $data['content'] .= '<span style="font-weight: bold; margin-top: 5px;">' . trim($titles[$i]) . '</span><br />' .
                                            '<a href="ymsgr:sendIM?' . trim($usernames[$i]) . '">' .
                                            '<img border=0 src="http://opi.yahoo.com/online?u=' . trim($usernames[$i]) . '&m=g&t=' . $this->config['MODULE_YM_SUPPORT_TYPE'] . '" />' .
                                            '</a>' .
                                            '<br /><br />';
                    }
                    $data['content'] .= '</div></div>';
                }
            }
            return $this->load_view('index.php', $data);
        }
        else
        {
            if ($usernames !== NULL)
            {
                if ($this->config['MODULE_YM_SUPPORT_POSITION'] === 'col2')
                {
                    $data['content'] .= '<div class="contents clearfix col2">';
                }
                if ($this->config['MODULE_YM_SUPPORT_POSITION'] === 'col3')
                {
                    $data['content'] .= '<div class="contents clearfix col3">';
                }
                for ($i = 0; $i < count($usernames); ++$i)
                {
                    $data['content'] .= '<div class="center" style="text-align: center;">';
                    $data['content'] .= '<div><span style="font-weight: bold; margin-top: 5px;">'. trim($titles[$i]) .'</span></div>';
                    $data['content'] .= '<a href="ymsgr:sendIM?'.$usernames[$i].'"><img border=0 src="http://opi.yahoo.com/online?u='.$usernames[$i].'&m=g&t='.$type.'" /></a>';
                    $data['content'] .= '</div>';
                }
                $data['content'] .= '</div>';
                return $this->load_view('index.php', $data);
            }
            return NULL;
        }
    }
}