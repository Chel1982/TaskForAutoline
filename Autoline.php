<?php

interface FileFinder {

    /**
     * Find only files
     * @return FileFinder
     */
    public function isFile();


    /**
     * Find only directories
     * @return FileFinder
     */
    public function isDir();


    /**
     * Search in directory $dir
     * @param string $dir
     * @return FileFinder
     */
    public function inDir($dir);


    /**
     * Filter by regular expression on path
     * @param string $regularExpression
     * @return FileFinder
     */
    public function match($regularExpression);


    /**
     * Returns array of all found files/dirs (full path)
     * @return string[]
     */
    public function getList();

}


class FileFinderImplementation implements FileFinder {

    public function isFile(){
        $dir = opendir(".");
        while($name = readdir($dir)){
            if(is_file($name))
                echo $name.'<br>';
        }
        closedir($dir);
    }
    public function isDir(){
        $dir = opendir(".");
        while($name = readdir($dir)){
            if(is_dir($name))
                echo '['.$name.']<br>';
        }
        closedir($dir);

    }
    public function inDir($dir){
        global $file;
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    print  $file."<br>";
                }
                closedir($dh);
            }
        }

    }
    public function match($regularExpression){
        preg_match($regularExpression, $file, $matches);
        var_dump($matches);

    }
    public function getList(){
        $dir_content = scandir(".");
        foreach ($dir_content as $item){
            echo $item."<br>";
        }
    }
}

$dir = new FileFinderImplementation;
$dir -> inDir('/var/log/');
echo "*********************<br>";
$dir -> match('/.gz$/');
