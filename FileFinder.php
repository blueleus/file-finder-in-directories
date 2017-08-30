<?php 

/**
* File finder in directory
*/
class FileFinder
{
  /**
   * Search and return the name of the folders in a global directory.
   * @param  [String] $path [Path to global directory]
   * @return [Array]       [Folder list]
   */
  public function directoriesList($path)
  {
    $directories = array();

    if(is_dir($path))
    {
      if($dir = opendir($path))
      {
        while(($folder = readdir($dir)) !== false)
        {
          if($folder != '.' && $folder != '..' && $folder != '.htaccess')//We verify whether or not it is a directory
          {
              $directories[]=$folder; //Of being a directory we wrap it in brackets
          }
        }
        closedir($dir);
      }
    }
    return $directories;
  }

  /**
   * Finds all files in a folder and returns an array with their name.
   * @param  [String] $path [Path folder]
   * @return [Array]       [Files list]
   */
  public function fileList($pathFolder)
  {
    $files = array();

    if(is_dir($pathFolder))
    {
      if($dir = opendir($pathFolder))
      {
        while(($file = readdir($dir)) !== false)
        {
          if (!is_dir($file))//We verify whether or not it is a directory
          {
              $files[]=$file; //To be a file we wrap it in brackets
          }
        }
        closedir($dir);
      }
    }
    return $files;
  }

  /**
   * Function that shows the folder structure from the given path.
   * @param  [String] $path [Path folder]
   */
  public function getStructureDirectories($path)
  {
    echo '<ul>';

    $folders = $this->directoriesList($path);

    foreach ($folders as $folder) 
    {
      echo '<li><<strong>' . $path . '/' . $folder . '</strong></li>';

      $files = $this->fileList($path.'/'.$folder);

      foreach ($files as $file) 
      {
        echo '<li>' . $file . '</li>';
      }
    }

    echo '</ul>';
  }
}

$path = dirname(__FILE__).'/directory';

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
{
  $path = str_replace('/', '\\', $path);
}

$fileFinder = new FileFinder();
echo $fileFinder->getStructureDirectories($path);