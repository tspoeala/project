<?php
/**
 * Created by PhpStorm.
 * User: teodora.spoeala
 * Date: 8/17/2017
 * Time: 9:41 AM
 */

namespace Src\Repository;

use App\Database\QueryBuilder as QueryBuilder;

class ProductCharacteristicsRepository extends QueryBuilder
{
    const TABLE = 'products_characteristics';

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

    public function updatee($table, $id, $values)
    {
        $sql = 'UPDATE ' . $table . '  SET ';
        if (empty($values) && !is_array($values)) {
            return;
        }
        $fieldsArray = [];
        foreach ($values as $field => $value) {
            $fieldsArray[] = $field . '=:' . $field;
        }

        $sql .= implode(', ', $fieldsArray) . ' WHERE product_id=:product_id';
        $statement = $this->pdo->prepare($sql);

        foreach ($values as $field => $value) {
            $statement->bindValue(':' . $field, $value);
        }

        $statement->bindValue(":id_produs", $id);
        $update = $statement->execute();

    }

    public function getCharacteristics($productId)
    {
        return $this->join3tables('characteristics.name', 'products_characteristics.value',
            'characteristics', 'products_characteristics', 'products', 'characteristics.id',
            'products_characteristics.characteristic_id', 'products_characteristics.product_id', 'products.id_produs', 'id_produs', $productId);
    }


}
