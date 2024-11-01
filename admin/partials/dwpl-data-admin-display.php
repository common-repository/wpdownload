<?php
if(filter_input(INPUT_POST,'download_site_info'))
{
    $retrieved_nonce = filter_input(INPUT_POST,'_wpnonce');
    if (!wp_verify_nonce($retrieved_nonce, 'dwpl_download_list' ) ) die( __('Failed security check','dwpl-data') );
    if(current_user_can('manage_options'))
    {
        $dwpl_data_export = filter_input(INPUT_POST, 'dwpl_data_export', FILTER_DEFAULT , FILTER_REQUIRE_ARRAY);
        $export = new Dwpl_Data_Export();
        $export->dwpl_generate_csv($dwpl_data_export,'site-info');
    }
}
?>

<script>
function dwpl_data_check_plugin()
{
    var checked = jQuery("#export_site_information input:checked").length > 0;
    if (!checked){
         alert('<?php _e('An empty file cannot be generated. Please check at least one checkbox to generate the file.','dwpl-data');?>');
    return false;
    }
    
   
}    
</script>
<div class="wrap">
<h1><?php _e('Export Site Information','dwpl-data');?></h1>
<p><?php _e('Clicking on the "Download File" button below will download a CSV file. The File will only contain the information you have selected using the checkboxes below.','dwpl-data');?></p> 

<h2><?php _e('Choose what information to export','dwpl-data');?></h2>
<form method="post" name="export_site_information" id="export_site_information">
<fieldset>
    <p><label><input type="checkbox" name="dwpl_data_export[]" value="plugins" checked="checked"><?php _e('Plugins','dwpl-data');?></label></p>
<p class="description" id="all-content-desc"><?php _e('This option will include list of all plugins on your site, activated as well as deactivated.','dwpl-data');?> </p>

<p><label><input type="checkbox" name="dwpl_data_export[]" value="themes" checked="checked"><?php _e('Themes','dwpl-data');?></label></p>
<p class="description" id="all-content-desc"><?php _e('This option will include list of all themes on your site, activated as well as deactivated.','dwpl-data');?> </p>

<p><label><input type="checkbox" name="dwpl_data_export[]" value="wordpress_version" checked="checked"><?php _e('Wordpress Version','dwpl-data');?></label></p>
<p class="description" id="all-content-desc"><?php _e('This option will include the current version of your WordPress.','dwpl-data');?> </p>

<p><label><input type="checkbox" name="dwpl_data_export[]" value="php_version" checked="checked"><?php _e('PHP Version','dwpl-data');?></label></p>
<p class="description" id="all-content-desc"><?php _e('This option will include the current version of PHP on your server.','dwpl-data');?> </p>

<p><label><input type="checkbox" name="dwpl_data_export[]" value="browser_name" checked="checked"><?php _e('Browser Name & Version','dwpl-data');?></label></p>
<p class="description" id="all-content-desc"><?php _e("This option will include the browser's name you are using, and its version number.","dwpl-data");?> </p>

</fieldset>
<?php wp_nonce_field('dwpl_download_list'); ?>
    <p class="submit"><input type="submit" name="download_site_info" id="download_site_info" class="button button-primary" onclick="return dwpl_data_check_plugin()" value="Download File"></p>
</form>
</div>
<?php
