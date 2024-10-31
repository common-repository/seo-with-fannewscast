<?php
/*
  +-------------------------------------------------------------------+
  |																								|
  |	WordPress 3.3.2 Plugin: FanNewscast Plugin 1.0							|
  |	Copyright (c) 2012 IT Agility 									|
  |																								|
  |	File Written By:																		|
  |	- Pavel Goncharov																	|
  |																								|
  |	File Information:																		|
  |	- FanNewscast Content Api															|
  |	- wp-content/plugins/fannewscast-api/settings.php	|
  |																								|
  +-------------------------------------------------------------------+
 */


?>
<div class="wrap">
    <div style="background: transparent url(<?php echo plugins_url( 'images/icon.png' , __FILE__ ); ?>) no-repeat;" class="icon32"><br /></div>
    <h2>FanNewscast Plugin Settings</h2>
    <p>To add content use shortcode [fnc-content]</p>
  <div style="font-size: 16px; font-weight: bold; border: 1px solid rgb(187, 187, 187); padding: 20px 20px 10px 20px; border-radius: 4px 4px 4px 4px; background-color: rgb(250, 250, 250);">
    To generate short codes or filter your content channel(s) just <a href="http://fannewscast.com/account/channels/" target="_new">click here</a>.
    <p style="font-size: 12px; font-weight: normal;">Don't have a login? Request one <a target="_new" href="http://fannewscast.com/solutions/seo/wordpress/">now.</a></p>
  </div>


    <form method="post" action="<?php echo admin_url('admin.php?noheader=true&page=' . plugin_basename(__FILE__)); ?>">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label>ShortCode Cheat Sheet:</label></th>
                    <td>
                        query <br/>
                        range<br/>
                        sortby <br/>
                        ck <br/>
                        search (yes/no)<br/>
                        sortmenu (yes/no)<br/>
                        sortitems (format "key=Label;key=Label" ) <span class="description">Example: [fnc-content sortitems="topweek=Week;topyear=Year 2012"]</span>

                    </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div style="border-bottom: 1px solid #ccc; width: 100%"></div>
                    <h3>Configuration<h3>
                  </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Enter AppId:</label></th>
                    <td><input type="text" class="regular-text" value="<?php echo stripslashes(get_option('fnc_appid')); ?>"  name="appid">
                      <span class="description">Don't have one?  Request your AppId <a href="http://fannewscast.com/solutions/seo/wordpress/" target="_new">on FanNewscast</a></span>
                    </td>
                </tr>
                <tr valign="top">
                  <th scope="row"><label>Default Content Key <span class="description">(optional)</span>:</label></th>
                  <td><input type="text" class="regular-text" value="<?php echo stripslashes(get_option('fnc_ck')); ?>"  name="ck">
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Default Display Options</label></th>
                    <td>
                      <input type="checkbox" <?php echo stripslashes(get_option('fnc_search')) == 'yes' ? 'checked="checked"' : '' ?> name="search" value="ON" /> Show Search Bar<br />
                      <input type="checkbox" <?php echo stripslashes(get_option('fnc_sortmenu')) == 'yes' ? 'checked="checked"' : '' ?> name="sortmenu" value="ON" /> Show Sort Menu Options<br />
                      <input type="checkbox" <?php echo stripslashes(get_option('fnc_ajax')) == 'yes' ? 'checked="checked"' : '' ?> name="ajax" value="ON" />  Force Sticky Urls <span class="description">(no Ajax on pagination and search calls)<span>

                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label>Default Range</label></th>
                    <td>
                      <select name="range">
                        <?php foreach(array(5, 10, 15, 20) as $value): ?>
                        <option value="<?php echo $value ?>" <?php echo stripslashes(get_option('fnc_range')) == $value ? 'selected="selected"' : ''; ?>><?php echo $value ?></option>
                        <?php endforeach; ?>
                      </select>
                        <span class="description">The number of results to show for the given query. You can use shortcode [fnc-content range=""]</span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label>List Template</label></th>
                    <td><textarea class="large-text code" name="list_template"><?php echo stripslashes(get_option('fnc_list_template')); ?></textarea>
                        <span class="description">
                            <a class="button" href="<?php echo admin_url('admin.php?noheader=true&page=' . plugin_basename(__FILE__) . '&setdefault=fnc_list_template'); ?>">Restore default</a></span></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label>Search Template</label></th>
                    <td><textarea class="large-text code" name="searchbox_template"><?php echo stripslashes(get_option('fnc_searchbox_template')); ?></textarea>
                        <span class="description">
                            <a class="button" href="<?php echo admin_url('admin.php?noheader=true&page=' . plugin_basename(__FILE__) . '&setdefault=fnc_searchbox_template'); ?>">Restore default</a></span></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label>Sorting Menu Template</label></th>
                    <td><textarea class="large-text code" name="sort_template"><?php echo stripslashes(get_option('fnc_sort_template')); ?></textarea>
                        <span class="description">
                            <a class="button" href="<?php echo admin_url('admin.php?noheader=true&page=' . plugin_basename(__FILE__) . '&setdefault=fnc_sort_template'); ?>">Restore default</a></span></td>
                </tr>



                <tr valign="top">
                    <th scope="row"><label>Entry Template</label></th>
                    <td><textarea class="large-text code" name="entry_template"><?php echo stripslashes(get_option('fnc_entry_template')); ?></textarea>
                        <span class="description">
                            <a class="button" href="<?php echo admin_url('admin.php?noheader=true&page=' . plugin_basename(__FILE__) . '&setdefault=fnc_entry_template'); ?>">Restore default</a></span></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label>Image Template</label></th>
                    <td><textarea class="large-text code" name="img_template"><?php echo stripslashes(get_option('fnc_img_template')); ?></textarea>
                        <span class="description">
                            <a class="button" href="<?php echo admin_url('admin.php?noheader=true&page=' . plugin_basename(__FILE__) . '&setdefault=fnc_img_template'); ?>">Restore default</a></span></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label>YouTube Image Template</label></th>
                    <td><textarea class="large-text code" name="yt_img_template"><?php echo stripslashes(get_option('fnc_yt_img_template')); ?></textarea>
                        <span class="description">
                            <a class="button" href="<?php echo admin_url('admin.php?noheader=true&page=' . plugin_basename(__FILE__) . '&setdefault=fnc_yt_img_template'); ?>">Restore default</a></span></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label>Social Rank Template</label></th>
                    <td><textarea class="large-text code" name="social_template"><?php echo stripslashes(get_option('fnc_social_template')); ?></textarea>
                        <span class="description">
                            <a class="button" href="<?php echo admin_url('admin.php?noheader=true&page=' . plugin_basename(__FILE__) . '&setdefault=fnc_social_template'); ?>">Restore default</a></span></td>
                </tr>



                <tr valign="top">
                    <th scope="row"><label>No Results Template</label></th>
                    <td><textarea class="large-text code" name="noitems_template"><?php echo stripslashes(get_option('fnc_noitems_template')); ?></textarea>
                        <span class="description">
                            <a class="button" href="<?php echo admin_url('admin.php?noheader=true&page=' . plugin_basename(__FILE__) . '&setdefault=fnc_noitems_template'); ?>">Restore default</a></span></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label>CSS Styles</label></th>
                    <td><textarea class="large-text code" name="css"><?php echo stripslashes(get_option('fnc_css')); ?></textarea>
                        <span class="description">
                            <a class="button" href="<?php echo admin_url('admin.php?noheader=true&page=' . plugin_basename(__FILE__) . '&setdefault=fnc_css'); ?>">Restore default</a>
                        </span></td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" name="Submit" class="button" value="Save Changes" />
        </p>
    </form>
</div>