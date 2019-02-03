<?php declare(strict_types=1);

namespace PerfectApp\Database;

use PDO;

/**
 * Class MysqlCrud
 * @package PerfectApp
 */
class MysqlCrud
{
    /**
     * @var \PDO
     */
    private $pdo;
    /**
     * @var string
     */
    private $table;
    /**
     * @var string
     */
    private $primaryKey;
    /**
     * @var string
     */
    private $className;
    /**
     * @var array
     */
    private $constructorArgs;

    /**
     * DatabaseTable constructor.
     *
     * @param \PDO $pdo
     * @param string $table
     * @param string $primaryKey
     * @param string $className
     * @param array $constructorArgs
     */
    public function __construct(\PDO $pdo, string $table, string $primaryKey, string $className = '\stdClass', array $constructorArgs = [])
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->className = $className;
        $this->constructorArgs = $constructorArgs;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function findById($value)
    {
        $query = 'SELECT * FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :value';
        $parameters = ['value' => $value];
        $query = $this->query($query, $parameters);
        return $query->fetchObject($this->className, $this->constructorArgs);
    }

    /**
     * @param $sql
     * @return \PDOStatement
     */
    public function pdoQuery($sql)
    {
        return $this->pdo->query($sql);
    }

    /**
     * @param $sql
     * @param array $parameters
     * @return bool|\PDOStatement
     */
    private function query($sql, $parameters = [])
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    /**
     * @param $fields
     */
    public function insert($fields)
    {
        $query = 'INSERT INTO `' . $this->table . '` (';

        foreach ($fields as $key => $value)
        {
            $query .= '`' . $key . '`,';
        }

        $query = rtrim($query, ',');
        $query .= ') VALUES (';

        foreach ($fields as $key => $value)
        {
            $query .= ':' . $key . ',';
        }

        $query = rtrim($query, ',');
        $query .= ')';

        $fields = $this->processDates($fields);

        $this->query($query, $fields);
    }

    /**
     * @param $fields
     */
    public function update($fields)
    {
        $id = $fields['id'];
        unset($fields['id']);

        $query = ' UPDATE `' . $this->table . '` SET ';

        foreach ($fields as $key => $value)
        {
            $query .= '`' . $key . '` = :' . $key . ',';
        }

        $query = rtrim($query, ',');
        $query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';

        $fields['primaryKey'] = $id;
        $fields = $this->processDates($fields);
        $this->query($query, $fields);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $parameters = [':id' => $id];
        $this->query('DELETE FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :id', $parameters);
    }

    /**
     * @param $fields
     * @return mixed
     */
    private function processDates($fields)
    {
        foreach ($fields as $key => $value)
        {
            if ($value instanceof \DateTime)
            {
                $fields[$key] = $value->format('Y-m-d');
            }
        }
        return $fields;
    }
}
