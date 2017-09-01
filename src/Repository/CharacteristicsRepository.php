<?php

namespace Src\Repository;

use App\Database\QueryBuilder as QueryBuilder;

class CharacteristicsRepository extends QueryBuilder
{
    const TABLE = 'characteristics';

    public function countAll()
    {
        return $this->count(self::TABLE);
    }

    public function getSubset($offset, $limit)
    {
        return $this->limits(self::TABLE, $offset, $limit);
    }

    public function insertIntoTable($parameters)
    {
        $this->insert(self::TABLE, $parameters);
    }

    public function selectAllFromTable()
    {
        return $this->selectAll(self::TABLE);
    }

    public function selectByFieldFromTable($field, $value)
    {
        return $this->selectByField(self::TABLE, $field, $value);
    }

    public function selectColumnFromTable($column, $field, $value)
{
    return $this->selectColumn(self::TABLE, $column, $field, $value);
}

    public function deleteFromTable($field, $value)
    {
        $this->delete(self::TABLE, $field, $value);
    }

    public function updateTable($id, $values)
    {
        $this->update(self::TABLE, $id, $values);
    }

}