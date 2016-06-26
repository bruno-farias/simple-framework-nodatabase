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

    protected $baseDir = null;

    /**
     * Default file extension
     *
     * @var string
     */
    protected $fileExtension = '.json';


    /**
     * THe file used to store data
     *
     * @var
     */
    protected $file;

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
     * The primary key length
     *
     * @var int
     */
    protected $primaryKeyLength = 11;

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
     * @return null
     */
    public function getBaseDir()
    {
        return $this->baseDir;
    }

    /**
     * @param null $baseDir
     */
    public function setBaseDir($baseDir)
    {
        $this->baseDir = $baseDir;
    }



    /**
     * Verifies if a file used to store data exists
     *
     * @param $file
     * @return bool
     */
    public function checkFile()
    {
        return file_exists($this->getFilePath($this->file)) or die('File not exists!');
    }

    /**
     * Simple return the full file path of a file
     *
     * @param null $base
     * @return string
     */
    public function getFilePath()
    {
        if ($this->baseDir === null)
            return constant('BASE') . $this->rootDirectory .'/' . $this->file . $this->fileExtension;

        return $this->baseDir.'/' . $this->rootDirectory .'/' . $this->file . $this->fileExtension;
    }

    /**
     * Create a new empty file
     *
     * @return bool
     */
    public function createFile()
    {
        return fopen($this->getFilePath($this->file), 'w') or die('Unable to create file ' . $this->file);
    }


    /**
     * Delete a file
     *
     * @return bool
     */
    public function deleteFile()
    {
        return unlink($this->getFilePath($this->file));
    }

    /**
     * Create a new entries with the data provided
     *
     * @param $file
     * @param $newData
     * @return bool|int
     */
    public function insert($newData)
    {
        if ($this->checkFile($this->file)) {

            $data = json_decode(file_get_contents($this->getFilePath()), true);

            foreach ($newData as $item) {
                $data[] = array_merge(['id' => $this->generateId()], $item);
            }

            return file_put_contents($this->getFilePath(), json_encode($data));
        }
        return false;
    }

    private function generateId()
    {
        return \Helpers::randString($this->primaryKeyLength);
    }

    public function all()
    {
        return file_get_contents($this->getFilePath());
    }


}