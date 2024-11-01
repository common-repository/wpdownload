<?php
class Dwpl_Data_Export
{
 
  public function dwpl_generate_csv($dwpl_data_export,$filename)
  {
        if (ob_get_contents()) { ob_clean();}
        ob_start(); 
        $csvFile = $this->dwpl_data_generate_csv($dwpl_data_export);
        $generatedDate = date('d-m-Y');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '-' . $generatedDate . '.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');
        echo $csvFile;  
        ob_end_flush();
        //Whatever is echoed here will be in the csv file
        exit();
  }

  public function dwpl_data_generate_csv($dwpl_data_export)
  {
      $csv_output = '';
      $data = array();
      if(in_array('plugins',$dwpl_data_export))
      {
          $plugin_data = $this->dwpl_get_plugin_info();
          foreach($plugin_data as $key=>$plug)
          {
             $data[$key]= $plug;
          }
      }
      
      if(in_array('themes',$dwpl_data_export))
      {
          $theme_data = $this->dwpl_get_theme_info();
          foreach($theme_data as $key=>$plug)
          {
             $data[$key]= $plug;
          }
          //array_push($data, $theme_data);
      }
      
      if(in_array('wordpress_version',$dwpl_data_export))
      {
          $dwpl_data = $this->dwpl_get_wordpress_info();
          foreach($dwpl_data as $key=>$plug)
          {
             $data[$key]= $plug;
          }
          
      }
      
      if(in_array('php_version',$dwpl_data_export))
      {
          $php_data = $this->dwpl_get_php_info();
          foreach($php_data as $key=>$plug)
          {
             $data[$key]= $plug;
          }
          
      }
      
      if(in_array('browser_name',$dwpl_data_export))
      {
          $browser_data = $this->dwpl_get_browser_info();
          foreach($browser_data as $key=>$plug)
          {
             $data[$key]= $plug;
          }
      }
      
      return $this->dwpl_data_convert_csv($data,$csv_output,$dwpl_data_export);

  }
  
  public function dwpl_data_convert_csv($data,$csv_output,$dwpl_data_export)
  {
      $count = array();
      foreach($data as $key=>$value) 
      {
          $csv_output .= $this->dwpl_data_csv_heading($key).' ,';
          if(is_array($value))
          {
            $count[] = count($value);
          }
      }
      $csv_output .= "\n";
      
    for($i=0;$i<max($count);$i++)
    {
          
        if(in_array('plugins',$dwpl_data_export))
        {
            if(isset($data['dectivate_plugins'][$i]))
            {
                $csv_output .= $data['dectivate_plugins'][$i].' ,';
            }
            else
            {
                $csv_output .= ' ,';
            }
        }
        
        if(in_array('plugins',$dwpl_data_export))
        {
            if(isset($data['activate_plugins'][$i]))
            {
                $csv_output .= $data['activate_plugins'][$i].' ,';
            }
            else
            {
                $csv_output .= ' ,';
            }
        }
        
        if(in_array('themes',$dwpl_data_export))
        {
            if(isset($data['deactivate_theme'][$i]))
            {
                $csv_output .= $data['deactivate_theme'][$i].' ,';
            }
            else
            {
                $csv_output .= ' ,';
            }
        }
        
        if(in_array('themes',$dwpl_data_export))
        {
            if(isset($data['activate_theme'][$i]))
            {
                $csv_output .= $data['activate_theme'][$i].' ,';
            }
            else
            {
                $csv_output .= ' ,';
            }
        }
        
        if(in_array('wordpress_version',$dwpl_data_export))
        {
            if(isset($data['wordpress_version']) && !isset($wordpress_version))
            {
                $wordpress_version = true;
                $csv_output .= $data['wordpress_version'].' ,';
            }
            else
            {
                $csv_output .= ' ,';
            }
        }
          
          
        if(in_array('php_version',$dwpl_data_export))
        {
            if(isset($data['php_version']) && !isset($php_version))
            {
                $php_version = true;
                $csv_output .= $data['php_version'].' ,';
            }
            else
            {
                $csv_output .= ' ,';
            }  
        }

          
        if(in_array('browser_name',$dwpl_data_export))
        {
            if(isset($data['browser_name']) && !isset($browser_name))
            {
                $browser_name = true;
                $csv_output .= $data['browser_name'].' ,';
            }
            else
            {
                $csv_output .= ' ,';
            }
        }
          
        if(in_array('browser_name',$dwpl_data_export))
        {
            if(isset($data['browser_version']) && !isset($browser_version))
            {
                $browser_version = true;
                $csv_output .= $data['browser_version'].' ,';
            }
            else
            {
                $csv_output .= ' ,';
            }
        } 
          
          
        if(in_array('browser_name',$dwpl_data_export))
        {
            if(isset($data['os']) && !isset($os))
            {
                $os = true;
                $csv_output .= $data['os'].' ,';
            }
            else
            {
                $csv_output .= ' ,';
            }
        }
          
          $csv_output .= "\n";
          
    }
      
      return $csv_output;
      
  }
  
  public function dwpl_data_csv_heading($key)
  {
      switch($key)
      {
          case 'dectivate_plugins':
              $return = 'Inactive Plugins';
              break;
           case 'activate_plugins':
              $return = 'Active Plugins';
              break;
           case 'deactivate_theme':
              $return = 'Inactive Themes';
              break;
           case 'activate_theme':
              $return = 'Active Theme';
              break;
           case 'wordpress_version':
              $return = 'WordPress Version';
              break;
           case 'php_version':
              $return = 'PHP Version';
              break;
           case 'browser_name':
              $return = 'Browser';
              break;
           case 'browser_version':
              $return = 'Browser Version';
               break;
           case 'os':
              $return = 'OS';
              break;
          default:
              $return = $key;
              break;
      }
      
      return $return;
  }
 
  public function dwpl_get_plugin_info()
  {
        global $wpdb;
        $csv_output = '';
        if(is_multisite()) 
        {
             $apl2 = get_site_option('active_sitewide_plugins');
             $apl=get_option('active_plugins');
             foreach($apl2 as $key=> $val)
             {
                 $apl[] = $key;
             }
            $plugins=get_plugins();
            $data=array();
            foreach($plugins as $key=>$plug)
            {
                
                if(in_array($key,$apl))
                {
                    $data['activate_plugins'][] =$plug['Name'];
                }
                else
                {
                    $data['dectivate_plugins'][] = $plug['Name'];
                }
            }
        } 
        else 
        { 
            $apl=get_option('active_plugins');
            $plugins=get_plugins();
            $data=array();
            foreach($plugins as $key=>$plug)
            {
                
                if(in_array($key,$apl))
                {
                    $data['activate_plugins'][] =$plug['Name'];
                }
                else
                {
                    $data['dectivate_plugins'][] = $plug['Name'];
                }
            }
            
        }
        
        return $data;
  }

  public function dwpl_get_theme_info()
  {
        global $wpdb;
        $data=array();
        $themes = wp_get_themes();
        $current = get_template();
        foreach ( $themes as $key=>$theme ) 
        {
            $name = $theme->get('Name');
            if($current==$key)
            {
                $data['activate_theme'][] = $name;
            }
            else
            {
                $data['deactivate_theme'][] = $name;
            }

        }
        
        
        return $data;
  }
  
  public function dwpl_get_wordpress_info()
  {
      $version = get_bloginfo('version');
      $data=array();
      $data['wordpress_version'] = $version;
      return $data;
  }
  
  public function dwpl_get_php_info()
  {
      $version = phpversion();
      $data=array();
      $data['php_version'] = $version;
      return $data;
  }
  
  public function dwpl_get_browser_info()
  {
        $data=array();
        $obj = new DWPL_Browser_data();
        $data['browser_name'] = $obj->showInfo('browser');
        $data['browser_version'] = $obj->showInfo('version');

        $data['os'] =  $obj->showInfo('os');
        return $data;
  }
  
} 