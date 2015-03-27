<?php

namespace phpOMS\DataStorage\Database\Query;

class Builder {
    protected $operators = array(
        '=', '<', '>', '<=', '>=', '<>', '!=',
        'like', 'like binary', 'not like', 'between', 'ilike',
        '&', '|', '^', '<<', '>>',
        'rlike', 'regexp', 'not regexp',
        '~', '~*', '!~', '!~*', 'similar to',
        'not similar to',
    );

    protected $wheres = [];

    public function __construct($connection) {

    }

    public function select($columns, $table = null, $alias = null) {}

    public function from() {}

    public function where($column, $operator = null, $value = null, $boolean = 'and') {
        // TODO: handle $column is nested where
        // TODO: handle $value is nested where
        // TODO: handle $value is null -> operator NULL
        if(isset($operator) && !in_array($operator, $this->operators)) {
            throw new \Exception('Unknown operator.');
        }

        if(is_array($column)) {

        }

        $this->wheres[] = ['column' => $column, 'operator' => $operator, 'value' => $operator, 'boolean' => $boolean];

        return $this;
    }

    public function orWhere($column, $operator = null, $value = null, $boolean = 'and') {
        return $this->where($column, $operator, $value, 'or');
    }

    public function whereBetween() {}
    public function orWhereBetween() {}
    public function whereNotBetween() {}
    public function orWhereNotBetween() {}
    public function whereSub() {}
    public function whereIn() {}
    public function orWhereIn() {}
    public function whereNotIn() {}
    public function orWhereNotIn() {}
    public function whereInSub() {}
    public function whereNull() {}
    public function orWhereNull() {}
    public function whereDateTime() {}
    public function whereDate() {}
    public function whereYear() {}
    public function whereMonth() {}
    public function whereDay() {}

    public function groupBy() {}
    public function newest() {}
    public function oldest() {}

    public function offset() {}
    public function limit() {}

    public function union() {}

    public function lock() {}
    public function lockUpdate() {}

    public function __toString() {
        return '';
    }

    public function find() {}

    public function count() {}
    public function exists() {}

    public function min() {}
    public function max() {}
    public function sum() {}
    public function avg() {}


    public function get() {
        return $this;
    }

    public function insert() {
        return $this;
    }

    public function update() {
        return $this;
    }

    public function increment() {}
    public function decrement() {}

    public function delete() {
        return $this;
    }

    public function create() {
        return $this;
    }

    public function drop() {
        return $this;
    }

    public function raw() {
        return $this;
    }

    public function join($table1, $table2, $column1, $opperator, $column2) {
        return $this;
    }

    public function joinWhere() {}

    public function leftJoin() {}
    public function leftJoinWhere() {}
    public function rightJoin() {}
    public function rightJoinWhere() {}

    public function orderBy() {
        return $this;
    }

    public function rollback() {
        return $this;
    }

    public function startTransaction() {
        return $this;
    }

    public function commit() {
        return $this;
    }
}
