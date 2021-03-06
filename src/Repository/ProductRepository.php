<?php

namespace Src\Repository;

use App\AppContainer;
use App\Database\QueryBuilder;
use PDO;

class ProductRepository extends QueryBuilder
{
    const TABLE = 'products';
    const TABLEPIVOT = 'products_characteristics';
    const ID = 'id_produs';

    public function countAll()
    {
        return $this->count(self::TABLE);
    }

    public function countAllWhereCondition($field, $value)
    {
        return $this->countWhereCondition(self::TABLE, $field, $value);
    }

    public function countAllByFiled($field, $value)
    {
        return $this->countByField(self::TABLE, $field, $value);
    }

    public function getSubset($offset, $limit)
    {
        return $this->limits(self::TABLE, $offset, $limit);
    }

    public function getSubsetOrderBy($offset, $limit)
    {
        return $this->limitsOrderBy(self::TABLE, self::ID, $offset, $limit);
    }

    public function getSubsetCondition($field, $value, $offset, $limit)
    {
        return $this->whereLimits(self::TABLE, $field, $value, self::ID, $offset, $limit);
    }

    public function insertIntoTable($parameters)
    {
        $this->insert(self::TABLE, $parameters);
    }

    public function selectAllFromTable()
    {
        return $this->selectAll(self::TABLE);
    }

    public function selectColumnFromTable($column, $field, $value)
    {
        return $this->selectColumn(self::TABLE, $column, $field, $value);
    }


    public function selectByFieldFromTable($field, $value)
    {
        return $this->selectByField(self::TABLE, $field, $value);
    }

    public function selectByFieldFromTableBetween($field, $value1, $value2)
    {
        return $this->selectByFieldBetween(self::TABLE, $field, $value1, $value2);
    }

    public function selectByFieldLikeFromTable($field, $value, $offset, $limit)
    {
        return $this->selectByFieldLike(self::TABLE, $field, $value, self::ID, $offset, $limit);
    }

    public function countSelectByFieldLikeFromTable($field, $value)
    {
        return $this->countSelectByFieldLike(self::TABLE, $field, $value);
    }

    public function getUserOfProduct($productId)
    {
        return $this->join2tables('users.username', 'users.firstname', 'users', 'products', 'users.id',
            'products.id_user', 'id_produs', $productId)[0];
    }

    public function deleteFromTable($field, $value)
    {
        $this->delete(self::TABLE, $field, $value);
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

        $sql .= implode(', ', $fieldsArray) . ' WHERE id_produs=:id_produs';
        $statement = $this->pdo->prepare($sql);

        foreach ($values as $field => $value) {
            $statement->bindValue(':' . $field, $value);
        }

        $statement->bindValue(":id_produs", $id);
        $update = $statement->execute();

    }

    public function updateTable($id, $values)
    {
        $this->updatee(self::TABLE, $id, $values);
    }


    public function getProductsFiltered($params = [], $offset, $limit)
    {
        $str = "SELECT * FROM " . self::TABLE;
        $prices = [];
        if (array_key_exists('arrayPrices', $params)) {
            $prices = $params['arrayPrices'];
            unset($params['arrayPrices']);
        }

        $str .= $this->getFilters($params);
        $str .= " WHERE 1";
        $str .= $this->getPrices($prices);

        $str .= " ORDER BY " . self::ID . " DESC limit {$offset}, {$limit}";
        $statement = $this->pdo->prepare($str);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countProductsFiltered($params = [])
    {
        $str = "SELECT COUNT(*) FROM " . self::TABLE;
        $prices = [];
        if (array_key_exists('arrayPrices', $params)) {
            $prices = $params['arrayPrices'];
            unset($params['arrayPrices']);
        }

        $str .= $this->getFilters($params);
        $str .= " WHERE 1";
        $str .= $this->getPrices($prices);
        $statement = $this->pdo->prepare($str);

        $statement->execute();

        return $statement->fetchColumn();
    }

    public function getPrices($prices)
    {
        $str = "";
        if (!empty($prices)) {
            $str .= " AND (";

            for ($i = 0; $i < count($prices); $i++) {
                $price = $prices[$i];
                $str .= self::TABLE . " . price BETWEEN $price[0] AND $price[1]";
                if ($i < count($prices) - 1) {
                    $str .= " OR ";
                }
            }
            $str .= ")";

        }
        return $str;
    }

    public function getFilters($params)
    {
        $str = "";
        foreach ($params as $key => $param) {
            $str .= " INNER JOIN " . self::TABLEPIVOT .
                " pc$key ON " . self::TABLE . ".id_produs= pc$key.product_id ";


            if ($key == 'alimentarePlita') {
                $id = AppContainer::get('characteristicsRepository')->selectColumnFromTable('id', 'name', 'Alimentare plita');
                $str .= "AND pc$key.characteristic_id=" . $id[0]['id'] . " AND ( ";
                for ($i = 0; $i < count($param); $i++) {
                    $str .= "pc$key.value='$param[$i]'";
                    if ($i < count($param) - 1) {
                        $str .= " OR ";
                    }
                }
                $str .= ')';
            }
            if ($key == 'culori') {
                $id = AppContainer::get('characteristicsRepository')->selectColumnFromTable('id', 'name', 'Culoare');
                $str .= "AND pc$key.characteristic_id=" . $id[0]['id'] . " AND ( ";
                for ($i = 0; $i < count($param); $i++) {
                    $str .= "pc$key.value='$param[$i]'";
                    if ($i < count($param) - 1) {
                        $str .= " OR ";
                    }
                }
                $str .= ')';
            }
            if ($key == 'nrArzatoare') {
                $id = AppContainer::get('characteristicsRepository')->selectColumnFromTable('id', 'name', 'Numar arzatoare');
                $str .= "AND pc$key.characteristic_id=" . $id[0]['id'] . " AND ( ";
                for ($i = 0; $i < count($param); $i++) {
                    $str .= "pc$key.value='$param[$i]'";
                    if ($i < count($param) - 1) {
                        $str .= " OR ";
                    }
                }
                $str .= ')';
            }
            if ($key == 'aprindereElectrica') {
                $id = AppContainer::get('characteristicsRepository')->selectColumnFromTable('id', 'name', 'Aprindere electrica arzatoare');
                $str .= "AND pc$key.characteristic_id=" . $id[0]['id'] . " AND ( ";
                for ($i = 0; $i < count($param); $i++) {
                    $str .= "pc$key.value='$param[$i]'";
                    if ($i < count($param) - 1) {
                        $str .= " OR ";
                    }
                }
                $str .= ')';
            }
        }
        return $str;
    }
}
