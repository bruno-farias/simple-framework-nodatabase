<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 25/06/16
 * Time: 02:00
 */

namespace LightSpeed\Models;


use LightSpeed\Repositories\Contracts\ValidateDataInterface;

abstract class Model
{

    /**
     * The folder associated with the model
     *
     * @var
     */
    protected $rootDirectory = 'data';

    /**
     * Default file extension
     *
     * @var string
     */
    protected $fileExtension = '.json';

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 15;

    /**
     * The primary key for the model
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat;

    /**
     * Property to validate data
     *
     * @var ValidateDataInterface
     */
    protected $validate;

    /**
     * Verifies if a file used to store data exists
     *
     * @param $file
     * @return bool
     */
    public function checkFile($file)
    {
        return file_exists($this->getFilePath($file)) or die('File not exists!');
    }

    /**
     * Simple return the full file path of a file
     *
     * @param $file
     * @return string
     */
    public function getFilePath($file)
    {
        return $this->rootDirectory .'/' . $file . $this->fileExtension;
    }

    /**
     * Create a new empty file
     *
     * @param $file
     * @return bool
     */
    public function createFile($file)
    {
        return fopen($this->getFilePath($file), 'w') or die('Unable to create file ' . $file);
    }


    /**
     * Delete a file
     *
     * @param $file
     * @return bool
     */
    public function deleteFile($file)
    {
        return unlink($this->getFilePath($file));
    }

    /**
     * Create a new entries with the data provided
     *
     * @param $file
     * @param $newData
     * @return bool|int
     */
    public function insert($file, $newData)
    {
        if ($this->checkFile($file)) {

            $data = json_decode(file_get_contents($this->getFilePath($file)), true);

            $data[] = $newData;

            return file_put_contents($this->getFilePath($file), json_encode($data));
        }
        return false;
    }


}