<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/06/16
 * Time: 02:00
 */

namespace LightSpeed\Models;


abstract class Model
{

    /**
     * The folder associated with the model
     *
     * @var
     */
    protected $rootDirectory = 'data';

    protected $fileExtension = '.json';

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 15;

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat;

    public function checkFile($file)
    {
        return file_exists($this->rootDirectory . '/' . $file.$this->fileExtension);
    }

    public function createFile($file)
    {
        return fopen($this->rootDirectory .'/'. $file.$this->fileExtension, 'w') or die('Unable to create file ' . $file);
    }

    public function deleteFile($file)
    {
        return unlink($this->rootDirectory .'/'. $file.$this->fileExtension);
    }

    public function insert($file, $data)
    {
        return false;
    }


}