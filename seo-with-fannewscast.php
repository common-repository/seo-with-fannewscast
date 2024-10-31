<?php

/*
  Plugin Name: FanNewscast Plugin
  Plugin URI: http://fannewscast.com/solutions/seo/wordpress/
  Description: SEO with Content Channels is a FanNewscast plugin allows you to pull trending, curated news from your configured FanNewscast content channel.  Select from over 900+ categories or specify advanced keyword phrase filters to pull in news that engages your audience.  Improves your SEO rankings by dynamically streaming hot-topic keywords and quality links to your site from your targeted content channel.
  Version: 2.1.6
  Author: FanNewscast
  Author URI:
  License: GPL2
 */

/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/*
  Copyright 2015  FanNewscast

 */
### Function: Plugin Administration Menu
add_action('admin_menu', 'fnc_content_menu');
require_once plugin_dir_path(__FILE__) . 'cache.php';

if (!get_option('fnc_appid'))
{
  function fnc_warning() {
    echo "
			<div id='akismet-warning' class='updated fade'>
			<p>
			<strong>".__('FanNewscast is almost ready.')."</strong> "
      .sprintf(
        __('You must <a href="%1$s">enter your FanNewscast AppID</a> for it to work.'),
        admin_url('admin.php?page=seo-with-fannewscast/settings.php')
      )
      .sprintf(
        __('To get AppId go <a href="%1$s" target="_blank">here</a>.'),
        "http://fannewscast.com/solutions/seo/wordpress/"
      )
      ."</p></div>
			";
  }
  add_action('admin_notices', 'fnc_warning');
}
function fnc_settings_page()
{
  if ($_REQUEST['setdefault']) {
    //update_option($_REQUEST['setdefault'], trim($_POST['range']));
    switch ($_REQUEST['setdefault']) {
      case 'fnc_entry_template':
        update_option('fnc_entry_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_entry.php'));
        break;
      case 'fnc_social_template':
        update_option('fnc_social_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_social.php'));
        break;
      case 'fnc_img_template':
        update_option('fnc_img_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_img.php'));
        break;
      case 'fnc_yt_img_template':
        update_option('fnc_yt_img_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_yt_img.php'));
        break;
      case 'fnc_noitems_template':
        update_option('fnc_noitems_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_noitems.php'));
        break;
      case 'fnc_list_template':
        update_option('fnc_list_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_list.php'));
        break;
      case 'fnc_searchbox_template':
        update_option('fnc_searchbox_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_search.php'));
        break;
      case 'fnc_sort_template':
        update_option('fnc_sort_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_sort.php'));
        break;
      case 'fnc_css':
        update_option('fnc_css', file_get_contents(plugin_dir_path(__FILE__) . 'styles.css'));
        break;
    }
  }
  if ($_POST['Submit']) {
    $appid = trim($_POST['appid']);
    $ck = trim($_POST['ck']);
    $query = trim($_POST['query']);

    update_option('fnc_appid', $appid);

    update_option('fnc_ck', $ck);
    update_option('fnc_query', $query);

    update_option('fnc_range', trim($_POST['range']));
    update_option('fnc_list_template', trim($_POST['list_template']));
    update_option('fnc_entry_template', trim($_POST['entry_template']));
    update_option('fnc_img_template', trim($_POST['img_template']));
    update_option('fnc_yt_img_template', trim($_POST['yt_img_template']));
    update_option('fnc_noitems_template', trim($_POST['noitems_template']));

    update_option('fnc_social_template', trim($_POST['social_template']));
    update_option('fnc_searchbox_template', trim($_POST['searchbox_template']));
    update_option('fnc_sort_template', trim($_POST['sort_template']));

    update_option('fnc_css', trim($_POST['css']));

    update_option('fnc_search', $_POST['search'] ? 'yes' : 'no');
    update_option('fnc_sortmenu', $_POST['sortmenu'] ? 'yes' : 'no');
    update_option('fnc_ajax', $_POST['ajax'] ? 'yes' : 'no');
  }

  if ($_POST['Submit'] || $_REQUEST['setdefault'])
  {
    header( 'Location: ' . admin_url('admin.php?page=seo-with-fannewscast/settings.php'));
    exit;
  }


  require_once 'settings.php';
}

function fnc_content_menu() {
  if (function_exists('add_menu_page'))
  {

    add_menu_page('FanNewscast Plugin', 'FanNewscast', 8, 'seo-with-fannewscast/settings.php', 'fnc_settings_page',
      plugins_url('seo-with-fannewscast/images/icon_s.png'));
  }
}

add_action('activate_seo-with-fannewscast/seo-with-fannewscast.php', 'init_plugin');


/**
 * Initialise plugin vars
 */
function init_plugin() {

  add_option('fnc_appid', null);
  add_option('fnc_ck', null);
  add_option('fnc_query', null);
  add_option('fnc_search', 'yes');
  add_option('fnc_sortmenu', 'yes');
  add_option('fnc_ajax', 'yes');
  add_option('fnc_range', 10);
  $entry_template = file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_entry.php');
  add_option('fnc_entry_template', $entry_template);
  add_option('fnc_social_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_social.php'));
  add_option('fnc_img_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_img.php'));
  add_option('fnc_yt_img_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_yt_img.php'));
  add_option('fnc_noitems_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_noitems.php'));
  add_option('fnc_list_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_list.php'));
  add_option('fnc_searchbox_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_search.php'));
  add_option('fnc_sort_template', file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_sort.php'));
  add_option('fnc_css', file_get_contents(plugin_dir_path(__FILE__) . 'styles.css'));

}


/**
 * Main content function
 * @param $atts
 * @return mixed|string
 */
function fnc_content($atts) {
  /**
   * @var $query string
   * @var $range int
   * @var $sortby string
   * @var $search = string
   * @var $sortmenu
   * @var sortitems
   * @var $ck
   * @var $varprefix string
   */
  extract(
    shortcode_atts(array(
    'query' => get_option('fnc_query'),
    'range' => get_option('fnc_range'),
    'sortby' => null,
    'ck' => get_option('fnc_ck'),
    'search' => get_option('fnc_search'),
    'sortmenu' => get_option('fnc_sortmenu'),
    'sortitems' => null,
    'imageformat' => null,
    'hidepagination' => null,
    'varprefix' => substr(md5(json_encode($atts)), 0, 4),
  ), $atts)
  );

  $maxEntryes = 1000;
  $params = '';


  $sort = isset($_REQUEST[$varprefix . '_sort']) ? $_REQUEST[$varprefix . '_sort'] : $sortby;
  $curPage = (int) (isset($_REQUEST[$varprefix . '_page']) ? $_REQUEST[$varprefix . '_page'] : 1);
  $query = (isset($_REQUEST[$varprefix . '_q']) && trim($_REQUEST[$varprefix . '_q']) != '' && $_REQUEST[$varprefix . '_q'] != 'Search')
    ? $_REQUEST[$varprefix . '_q'] : $query;


  if ($sortmenu != 'no')
  {
    $params .= '&sortmenu=true';
  }

  //generate request uri
  $feed_uri = 'http://fannewscast.com/services/getcontent/?ck=' . $ck .
    '&query=' . urlencode(str_replace('\\', '', stripslashes($query))) .
    '&range=' . $range .
    '&sortby=' . $sort .
    '&page=' . $curPage .
    '&appid=' . get_option('fnc_appid') .
    $params;


  if ($curPage <= 0)
  {
    return 'Wrong page.';
  }

  try
  {
    //Check cache
    $cache = new Jg_fnc_Cache(plugin_dir_path(__FILE__) . 'cache/');
    $key = md5($feed_uri);
    if ($source = $cache->get($key, 300))
    {
      $xml_source = $source;
    }
    else
    {
      $xml_source = fnc_file_get_contents_curl($feed_uri);

      if (!$xml_source) {
           return 'Unable to connect to http://fannewscast.com.  Please check connectivity with your hosting provider.';
      }
      $cache->set($key, $xml_source);
    }

    if ( ! class_exists( 'DOMDocument' ) )
    {
        return 'Error DOMDocument noe exist';
    }
    $dom = new DOMDocument;
    $success = $dom->loadXML( $xml_source );
    $x = fnc_domnode_to_array($dom);

    $list = '';
    if (get_option('fnc_ajax') == 'yes')
    {
//      $list .= sprintf('<div class="page-static-url">Page static url: http://%s%s</div>',
//        $_SERVER['HTTP_HOST'], str_replace(' ', '+', $_SERVER['REQUEST_URI']));
    }

    if (count($x['getContentResponse']['entryResults']['entry']))
    {
        if ($dom->getElementsByTagName('entry')->length == 1){
            $x['getContentResponse']['entryResults']['entry'] =
                array($x['getContentResponse']['entryResults']['entry']);
        }

      foreach ($x['getContentResponse']['entryResults']['entry'] as $vars)
      {
        $entry = stripslashes(get_option('fnc_entry_template'));
        //$entry = file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_entry.php');
        $vars['titleUrl'] = urlencode($vars['title']);

        if (isset($vars['thumbnailImage']))
        {
          if (strtolower(substr($vars['source'], 0, 8)) != 'youtube:')
          {
            $img_tmpl = stripslashes(get_option('fnc_img_template'));
            //$img_tmpl = file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_img.php');
          }
          else
          {
            $img_tmpl = stripslashes(get_option('fnc_yt_img_template'));
            $img_tmpl = str_replace('[%plugin_path%]', plugins_url('', __FILE__), $img_tmpl);
            // $img_tmpl = file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_yt_img.php');
          }

          $img_tmpl = is_string($vars['url']) ? str_replace('[%url%]', $vars['url'], $img_tmpl) : '';

          $vars['tmplImage'] = '';
          if (isset($vars['imagemetadata']) && $imageformat)
          {
            $imgs = $vars['imagemetadata'];

            if (isset($imgs[$imageformat]))
            {
              $i1 = $imgs[$imageformat];

              // $vars['tmplImage'] = str_replace('[%'.$imgs.'%]', $i1['imageurl'], $vars['tmplImage']);
              $vars['tmplImage'] = str_replace('[%thumbnailImage%]', $i1['imageurl'], $img_tmpl) ;
            }
          }
          else
          {
              if ($vars['thumbnailImage'] != '') {
            $vars['tmplImage'] = is_string($vars['thumbnailImage'])
              ? str_replace('[%thumbnailImage%]', $vars['thumbnailImage'], $img_tmpl) : '';
              }
          }

        }
        if (isset($vars['aggregatelikecount']))
        {
          $tmplSocial = stripslashes(get_option('fnc_social_template'));
          //$tmplSocial = file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_social.php');

          foreach ($vars as $key => $value)
          {
            if (is_string($value)) {
              $tmplSocial = str_replace(
                '[%' . $key . '%]',
                $key == 'tmplImage' ? $value : strip_tags($value),
                $tmplSocial
              );
            }

          }
          $vars['tmplSocial'] = $tmplSocial;
        }
        else
        {
          $vars['tmplSocial'] = '';
        }
//        if (isset($vars['contentDateTime'])) {
//          // var_dump($vars['contentDateTime'],the_date($vars['contentDateTime'], 'Y-m-d H:i:s', 'Y-m-d', false)); exit;
//          $vars['contentDateTime'] =date('Y-m-d', strtotime($vars['contentDateTime']));
//        }

        foreach ($vars as $key => $value)
        {
          if (is_string($value))
            $entry = str_replace(
              '[%' . $key . '%]',
              $key == 'tmplImage' || $key == 'tmplSocial' ? $value : strip_tags($value),
              $entry
            );
          else
            $entry = str_replace('[%' . $key . '%]', '', $entry);
        }
        $list .= $entry;
      }
    }
    else
    {
      if ($x['getContentResponse']['errorMessage'])
      {
          if (count($x['getContentResponse']['errorMessage']['message']) > 1) {

        foreach ($x['getContentResponse']['errorMessage']['message'] as $value)
        {
          $list .= '<div class="entry">' . $value . '</div>';
        }
          }
          else {
              $list .= '<div class="entry">' . $x['getContentResponse']['errorMessage']['message'] . '</div>';
          }
      }
      else
        $list = stripslashes(get_option('fnc_noitems_template'));
      //   $list = file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_noitems.php');
    }

    $tml_list = stripslashes(get_option('fnc_list_template'));
    //$tml_list = file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_list.php');

    $x = $x['getContentResponse'];

    if ($curPage == 1 && (int) $x['paginationOutput']['entriesPerPage'] < (int) $x['paginationOutput']['totalEntries'])
    {
      $c = 'p_start';
    }
    elseif ($curPage == 1 && (int) $x['paginationOutput']['entriesPerPage'] >= (int) $x['paginationOutput']['totalEntries'])
    {
      $c = 'p_single';
    }
    elseif (($curPage + 1) * (int) $x['paginationOutput']['entriesPerPage'] > $maxEntryes)
    {
      $c = 'p_end';
    }
    else
    {
      $c = 'p_middle';
    }

    if ($search == 'yes')
    {
      $searchBox = stripslashes(get_option('fnc_searchbox_template'));
      //$searchBox = file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_search.php');
      $searchBox = str_replace(
        '[%searchQuery%]',
        (isset($_REQUEST[$varprefix . '_q']) && trim($_REQUEST[$varprefix . '_q']) != '' && $_REQUEST[$varprefix . '_q'] != 'Search')
          ? htmlentities(str_replace('\\' , '',stripslashes($_REQUEST[$varprefix . '_q']))) : 'Search',
        $searchBox
      );

      $searchBox = str_replace(
        '[%clearQuery%]',
        add_query_arg(array($varprefix . '_sort' => $sort, $varprefix . '_q' => ''), $_SERVER['REQUEST_URI']),
        $searchBox
      );
      $searchBox = str_replace('[%plugin_path%]', plugins_url('', __FILE__), $searchBox);
      $searchBox = str_replace(
        '[%hiddenParams%]',
        (isset($_REQUEST['p']) ? '<input type="hidden" name="p" value="' . $_REQUEST['p'].'" />' : '' )
          . (isset($_REQUEST['page_id']) ? '<input type="hidden" name="page_id" value="' . $_REQUEST['page_id'].'" />' : '' ),
        $searchBox
      );
      $searchBox = str_replace('[%varprefix%]', $varprefix, $searchBox);
    }
    else
      $searchBox = '';


    if ($sortmenu == 'yes')
    {
      $tmplSort = stripslashes(get_option('fnc_sort_template'));
      //$tmplSort = file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_sort.php');
      if ($sortitems)
      {
        $rows = explode(';', $sortitems);
        $sortitems = array();
        foreach ($rows as $cols)
        {
          $col = explode('=', $cols);
          $sortitems[$col[0]] = $col[1];
        }
      }
      else
      {
        if(count($x['sortMenu']['sortOption']))
        {
          $sortitems = array();
          /** @var $sort_item SimpleXMLElement */

          foreach ($x['sortMenu']['sortOption'] as $sort_item)
          {
            $sortitems[(string) $sort_item['value']] = $sort_item['@attributes']['label'];
            if ($sortby == null && isset($sort_item['@attributes']['status']) && (string) $sort_item['@attributes']['status'] == 'selected')
            {
              $sortby = (string) $sort_item['value'];
            }

          }
          $sort = isset($_REQUEST[$varprefix . '_sort']) ? $_REQUEST[$varprefix . '_sort'] : $sortby;
        }
        else
        {
          $sortitems = array();
          $tmplSort = '';
        }

      }
      $slist = '';
      foreach ($sortitems as $key => $value)
      {
        $slist .='<td class="fnc_' . $key . '"><a href="'
          . (isset($_REQUEST['p']) ? '?p=' . $_REQUEST['p'] : '?' )
          . (isset($_REQUEST['page_id']) ? '?page_id=' . $_REQUEST['page_id'] : '?' )
          . $varprefix . '_page=1'
          . ((isset($_REQUEST[$varprefix . '_q']) && trim($_REQUEST[$varprefix . '_q']) != '' && $_REQUEST[$varprefix . '_q'] != 'Search')
            ? '&' . $varprefix . '_q=' . urlencode($_REQUEST[$varprefix . '_q']) : '')
          . '&' . $varprefix . '_sort=' . $key
          . '">' . $value . '</a></td>';
        $slist = str_replace('??', '?', $slist);
      }
      $sortParams = array(
        'sortStateClass' => $sort,
        'sortList' => $slist
      );
      foreach ($sortParams as $key => $value)
      {

        $tmplSort = str_replace('[%' . $key . '%]', $value, $tmplSort);
      }
    }
    else
      $tmplSort;

    $listParams = array(
      'varprefix' => $varprefix,
      'tmplSort' => $tmplSort,
      'paginationAttrs' => $hidepagination=='yes' ? 'style="display:none"' : '',
      'qParams' => '?' . $varprefix . '_page=1' . (
          (isset($_REQUEST[$varprefix . '_q']) && trim($_REQUEST[$varprefix . '_q']) != '' && $_REQUEST[$varprefix . '_q'] != 'Search')
          ? '&' . $varprefix . '_q=' . urlencode($_REQUEST[$varprefix . '_q']) : ''),
      'tmplSearch' => $searchBox,
      'list' => $list,
      'pagerStateClass' => $c,
      'firstPageUrl' => add_query_arg(array($varprefix . '_page' => 1, $varprefix . '_sort' => $sort), $_SERVER['REQUEST_URI']),
      'prevPageUrl' => add_query_arg(array($varprefix . '_page' => (string) $x['paginationOutput']['previousPage'],
        $varprefix . '_sort' => $sort), $_SERVER['REQUEST_URI']),
      'curPage' => $curPage,
      'nextPageUrl' => add_query_arg(array($varprefix . '_page' => (string) $x['paginationOutput']['nextPage'],
        $varprefix . '_sort' => $sort), $_SERVER['REQUEST_URI']),
      'totalEntries' => (int) $x['paginationOutput']['totalEntries'],
      'entriesSlice' =>
      ((($curPage - 1) * (int) $x['paginationOutput']['entriesPerPage']) + 1)
        . ' - ' .
        ((int) $x['paginationOutput']['totalEntries'] <= (int) $x['paginationOutput']['entriesPerPage']
          ? $x['paginationOutput']['totalEntries'] :
          (
            (($curPage - 1) * (int) $x['paginationOutput']['entriesPerPage']) + 1
            + (int) $x['paginationOutput']['entriesPerPage']
          )
        ),
    );

    //Ajax refresh
    $listParams['ajax'] = '';
    if (get_option('fnc_ajax') == 'yes')
    {
      $ajax =  file_get_contents(plugin_dir_path(__FILE__) . 'tmpl_ajax.php');
      $ajaxParams = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'atts' => addslashes(build_query($atts)),
        'varprefix' => $varprefix,
      );
      foreach ($ajaxParams as $key => $value)
      {
        $ajax = str_replace('[%' . $key . '%]', $value, $ajax);
      }
      $listParams['ajax'] = $ajax;
    }

    foreach ($listParams as $key => $value)
    {
      $tml_list = str_replace('[%' . $key . '%]', $value, $tml_list);
    }
  }
  catch (Exception $exc)
  {
    $tml_list = 'Content  Is Currently Unavailable. Please check again later';
  }

  return $tml_list;
}

add_shortcode('fnc-content', 'fnc_content');

function add_fnc_css() {
  $css = stripslashes(get_option('fnc_css'));
  $css = str_replace('[%plugin_path%]', plugins_url('', __FILE__), $css);

  //$css = file_get_contents(plugin_dir_path(__FILE__) . 'styles.css');
  if (!empty($css))
  {
    echo "\n<style type=\"text/css\">\n\n" . $css . "\n</style>\n";
  }
}

add_action('wp_head', 'add_fnc_css');


add_filter( 'query_vars', 'fnc_more_rewrite_add_var' );
function fnc_more_rewrite_add_var( $vars )
{
  $vars[] = 'fnc_entry_id';
  return $vars;
}


function add_itamore_rewrite_rule(){
  if (get_option('fnc_ajax') == 'yes')
  {
   // wp_deregister_script( 'jquery' );
    //wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');

  }
  add_rewrite_tag( '%itamore%', '([^&]+)' );
  add_rewrite_rule(
    '^itamore/([^/]*)/([^/]*)?',
    'index.php?page_id=0&fnc_entry_id=$matches[2]',
    'top'
  );
}
add_action('init', 'add_itamore_rewrite_rule');
add_action( 'template_redirect', 'fnc_more_rewrite_catch' );
function fnc_more_rewrite_catch()
{
  global $wp_query;

  if (array_key_exists('fnc_entry_id', $wp_query->query_vars))
  {

    $feed_uri = 'http://fannewscast.com/services/getcontent/?catid=1&full=true&id='
      . $wp_query->query_vars['fnc_entry_id']
      . '&appid=' . get_option('fnc_appid');

    $xml_source = fnc_file_get_contents_curl($feed_uri);

      if (!$xml_source) {
           return 'Unable to connect to http://fannewscast.com.  Please check connectivity with your hosting provider.';
      }

    if ( ! class_exists( 'DOMDocument' ) )
    {
        return 'Error DOMDocument noe exist';
    }
    $dom = new DOMDocument;
    $success = $dom->loadXML( $xml_source );
    $x = fnc_domnode_to_array($dom);
   // var_dump($x['getContentResponse']['entryResults']['entry']);
    if (count($x['getContentResponse']['entryResults']['entry']))
    {
      $vars = $x['getContentResponse']['entryResults']['entry'];
    }

    //$post = new stdClass();
    $post = $wp_query->post;
    $post->ID= -99; // fake ID, hehe
    $post->post_content = strip_tags($vars['abstract'], '<br>');
    $post->post_excerpt = 'an excerpt';
    $post->post_status ='publish';
    $post->post_date = null;
    $post->post_title = $vars['title'];
    $post->post_type = 'page';
    $post->filter = 'raw';
    $post->comment_status = 'close';
    $wp_query->queried_object = $post;
    $wp_query->post = $post;
    $wp_query->found_posts = 1;
    $wp_query->post_count = 1;
    $wp_query->max_num_pages = 1;
    $wp_query->is_page = 1;
    $wp_query->is_404 = false;
    $wp_query->posts = array($post);
    $wp_query->page = 1;
    $wp_query->is_post = false;

  }
}

add_action('wp_ajax_fnc_refresh', 'fnc_content_refresh');
add_action('wp_ajax_nopriv_fnc_refresh', 'fnc_content_refresh');

function fnc_content_refresh() {
  global $wpdb; // this is how you get access to the database

  parse_str(stripslashes($_POST['atts']), $atts1);
  parse_str(stripslashes(parse_url($_POST['href'], PHP_URL_QUERY)), $href);

  foreach ($href as $key => $value)
  {
    $_REQUEST[stripslashes($key)] = stripslashes($value);
    $href[$key] = str_replace('&', '%26', $value);
  }
  $_SERVER['REQUEST_URI'] = $_POST['loc'] . '?' . build_query($href);

  $atts = array();
  foreach ($atts1 as $key => $value)
  {
    $atts[stripslashes($key)] = stripslashes($value);
  }

  echo fnc_content($atts);

  die();
}

function fnc_file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}


function fnc_domnode_to_array($node) {
    $output = array();

    switch ($node->nodeType) {
        case XML_CDATA_SECTION_NODE:
        case XML_TEXT_NODE:
            $output = trim($node->textContent);
            break;
        case XML_DOCUMENT_NODE:
        case XML_ELEMENT_NODE:
            for ($i = 0, $m = $node->childNodes->length; $i < $m; $i++) {
                $child = $node->childNodes->item($i);

                $v = fnc_domnode_to_array($child);
                if (isset($child->tagName)) {
                    $t = $child->tagName;
                    if (!isset($output[$t])) {
                        $output[$t] = array();
                    }
                    if (empty($v)) {

                        $v = $v == "0" ? "0" : "";
                    }
                    $output[$t][] = $v;
                } elseif ($v || $v === "0") {

                    $output = (string) $v;
                }
            }
          //  if (is_array($output) ) {
                if ($node->attributes->length) {
                    if (!is_array($output)) {
                        $output = array('value' => $output);
                    }
                    $a = array();
                    foreach ($node->attributes as $attrName => $attrNode) {
                        $a[$attrName] = (string) $attrNode->value;
                    }
                    $output['@attributes'] = $a;
                }
                 if (is_array($output) ) {
                foreach ($output as $t => $v) {
                    if (is_array($v) && count($v) == 1 && $t != '@attributes') {
                        $output[$t] = $v[0];
                    }
                }
            }
            break;
    }
    return $output;
}

?>
