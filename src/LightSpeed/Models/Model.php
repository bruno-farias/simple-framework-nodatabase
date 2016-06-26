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
     * The base directory
     *
     * @var null
     */
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
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

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
     * @return bool
     */
    public function checkFile()
    {
        return file_exists($this->getFilePath()) or die('File not exists!');
    }

    /**
     * Simple return the full file path of a file
     *
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
     * aka as CREATE TABLE
     *
     * @return bool
     */
    public function createFile()
    {
        return fopen($this->getFilePath(), 'w') or die('Unable to create file ' . $this->file);
    }


    /**
     * Delete a file
     *
     * aka DELETE TABLE
     *
     * @return bool
     */
    public function deleteFile()
    {
        return unlink($this->getFilePath());
    }

    /**
     * Preserve the file, but erases all the data inside
     *
     * @return int
     */
    public function truncate()
    {
        return file_put_contents($this->getFilePath(), "");
    }

    /**
     * Create a new entries with the data provided
     *
     * @param $newData
     * @return bool|int
     */
    public function insert($newData)
    {
        if ($this->checkFile()) {

            $data = json_decode(file_get_contents($this->getFilePath()), true);

            foreach ($newData as $item) {
                $data[] = array_merge(['id' => $this->generateId()], $item);
            }

            return file_put_contents($this->getFilePath(), json_encode($data));
        }
        return false;
    }

    /**
     * Simple generate a simple id
     *
     * Inspired on MongoDB
     *
     * @return string
     */
    private function generateId()
    {
        return \Helpers::randString($this->primaryKeyLength);
    }

    /**
     * Returns all resources available in a file
     *
     * @return string
     */
    public function all()
    {
        return file_get_contents($this->getFilePath());
    }

    /**
     * Find one or more resources based on given field and value
     *
     * @param $field
     * @param $value
     * @return string
     */
    public function where($field, $value)
    {
        $result = json_decode($this->all());
        $res = [];

        foreach ($result as $data) {
            foreach ($data as $key => $info) {
                if ($field == $key && $value == $info) {
                    $res[] = $data;
                }
            }
        }
        return json_encode($res);
    }

    /**
     * Update the data
     *
     * aka as UPDATE table SET ...
     *
     * @param $field
     * @param $value
     * @param $newValue
     * @return string
     */
    public function update($field, $value, $newValue)
    {
        $query = json_decode($this->all());
        $query = (array) $query;
        $res = [];
        $count = 0;

        foreach ($query as $data) {

            if ($data->$field == $value){
                $data->$field = $newValue;
                $count++;
            }
            $res[] = (array) $data;
        }

        $this->truncate();
        $this->insert($res);
        return json_encode($count);
    }


}