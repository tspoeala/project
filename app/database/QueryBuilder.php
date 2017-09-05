<?php

namespace App\Database;

use PDO;

class QueryBuilder
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function getInitialQuery($table)
    {
        $initialQuery = "select * from {$table}";
        return $initialQuery;
    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare($this->getInitialQuery($table));

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(',', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );
        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        } catch (Exception $e) {
            die('Whoops, something went wrong');
        }

    }

    public function delete($table, $field, $value)
    {
        $sql = 'DELETE FROM  `' . $table . '` WHERE `' . $field . '` = ' . $this->pdo->quote($value);
        $statement = $this->pdo->prepare($sql);

        $statement->execute();

    }


    public function selectByField($table, $field, $value)
    {
        $sql = 'SELECT * FROM  `' . $table . '` WHERE `' . $field . '` = ' . $this->pdo->quote($value);

        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectByFieldLike($table, $field, $value)
    {

        $sql = "SELECT * FROM  `$table` WHERE `$field` LIKE '%$value%'";

        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectColumn($table, $column, $field, $value)
    {
        $sql = 'SELECT`' . $column . '` FROM  `' . $table . '` WHERE `' . $field . '` = ' . $this->pdo->quote($value);

        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectByFieldBetween($table, $field, $value1, $value2)
    {
        $sql = "SELECT * FROM  `$table` WHERE `$field` BETWEEN $value1 AND $value2";

        $statement = $this->pdo->prepare($sql);

        $statement->execute();


        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($table, $id, $values)
    {
        $sql = 'UPDATE ' . $table . '  SET ';
        if (empty($values) && !is_array($values)) {
            return;
        }
        $fieldsArray = [];
        foreach ($values as $field => $value) {
            $fieldsArray[] = $field . '=:' . $field;
        }

        $sql .= implode(', ', $fieldsArray) . ' WHERE id=:id';
        $statement = $this->pdo->prepare($sql);

        foreach ($values as $field => $value) {
            $statement->bindValue(':' . $field, $value);
        }

        $statement->bindValue(":id", $id);
        $update = $statement->execute();

    }


    protected function count($table)
    {
        $statement = $this->pdo->prepare("select count(*) from {$table}");

        $statement->execute();
        return $statement->fetchColumn();

    }

    protected function countWhereCondition($table, $field, $value)
    {
        $statement = $this->pdo->prepare("select count(*) from {$table} WHERE {$field}={$value}");

        $statement->execute();
        return $statement->fetchColumn();
    }

    protected function countByField($table, $field, $value)
    {
        $sql = 'SELECT * FROM  `' . $table . '` WHERE `' . $field . '` = ' . $this->pdo->quote($value);
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchColumn();


    }

    public function whereLimits($table, $field, $value, $id, $offset, $limit)
    {
        /** @var int $offset */
        $statement = $this->pdo->prepare("select * from {$table} WHERE {$field} ={$value} ORDER BY {$id} DESC limit {$offset}, $limit");

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function limits($table, $offset, $limit)
    {
        /** @var int $offset */
        $statement = $this->pdo->prepare("select * from {$table} limit {$offset}, $limit");

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function limitsOrderBy($table, $id, $offset, $limit)
    {
        /** @var int $offset */
        $statement = $this->pdo->prepare("select * from {$table} ORDER BY {$id} DESC limit {$offset}, $limit");

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function join3tables($column1, $column2, $table1, $table2, $table3, $id1, $id2, $id3, $id4, $field, $value)
    {
        $query = "select {$column1},{$column2} from {$table1} JOIN {$table2} ON {$id1}={$id2} JOIN {$table3} ON {$id3}={$id4}
        WHERE {$field}={$value}";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function join2tables($column1, $column2, $table1, $table2, $id1, $id2, $field, $value)
    {
        $query = "select {$column1},{$column2} from {$table1} JOIN {$table2} ON {$id1}={$id2} WHERE {$field}={$value}";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function join2tablesLike($column1, $column2, $table1, $table2, $id1, $id2)
    {
        $query = "select DISTINCT {$column1},{$column2} from {$table1} JOIN {$table2} ON {$id1}={$id2}";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
}

