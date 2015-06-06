<?php

namespace phpOMS\DataStorage\Database\Query;

class Builder
{

// region Class Fields

    public $columns  = [];

    public $distinct = false;

    public $from     = [];

    //<editor-fold desc="Compile components for grammar compiler">

    public    $joins      = [];

    public    $wheres     = [];

    public    $groups     = [];

    public    $orders     = [];

    public    $limit      = null;

    public    $offset     = null;

    public    $unions     = [];

    public    $lock       = false;

    protected $connection = null;

    protected $grammar    = null;

    protected $type       = null;

    //</editor-fold>

    protected $unionLimit  = null;

    protected $unionOffset = null;

    protected $unionOrders = [];

    protected $operators   = [
        '=',
        '<',
        '>',
        '<=',
        '>=',
        '<>',
        '!=',
        'like',
        'like binary',
        'not like',
        'between',
        'ilike',
        '&',
        '|',
        '^',
        '<<',
        '>>',
        'rlike',
        'regexp',
        'not regexp',
        '~',
        '~*',
        '!~',
        '!~*',
        'similar to',
        'not similar to',
    ];

    protected $queryType   = \phpOMS\DataStorage\Database\Query\QueryType::SELECT;

// endregion

    public function __construct($connection, $grammar)
    {
        $this->connection = $connection;
        $this->grammar    = $grammar;
    }

    public function select($columns = ['*'], $table = null, $alias = null)
    {
        $this->type = \phpOMS\DataStorage\Database\Query\QueryType::SELECT;

        if(isset($table)) {
            $this->columns[$table] = $columns;
        } else {
            $this->columns += $columns;
        }

        return $this;
    }

    public function selectSub($query, $as)
    {
        if($query instanceof \Closure) {
            $callback = $query;

            $callback($query = $this->newQuery());
        }

        if($query instanceof self) {
            $query = $query->toSql();
        } elseif(is_string($query)) {
        } else {
            // todo: handle error
        }

        return $this->selectRaw(['(' . $query . ') as ' . $as]);
    }

    public function newQuery()
    {
        return new static($this->connection, $this->grammar);
    }

    public function toSql()
    {
        return $this->grammar->compileQuery();
    }

    public function selectRaw($expression)
    {
        $this->addSelect($expression);

        return $this;
    }

    public function addSelect($columns = ['*'], $table = null, $alias = null)
    {
        if(isset($table)) {
            $this->columns[$table] = $columns;
        } else {
            $this->columns += $columns;
        }
    }

    public function distinct()
    {
        $this->distinct = true;

        return $this;
    }

    public function from($table)
    {
        $this->from += $table;

        return $this;
    }

    public function orWhere($column, $operator = null, $value = null)
    {
        return $this->where($column, $operator, $value, 'or');
    }

    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
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

    public function whereBetween()
    {
    }

    public function orWhereBetween()
    {
    }

    public function whereNotBetween()
    {
    }

    public function orWhereNotBetween()
    {
    }

    public function whereSub()
    {
    }

    public function whereIn()
    {
    }

    public function orWhereIn()
    {
    }

    public function whereNotIn()
    {
    }

    public function orWhereNotIn()
    {
    }

    public function whereInSub()
    {
    }

    public function whereNull()
    {
    }

    public function orWhereNull()
    {
    }

    public function whereDateTime()
    {
    }

    public function whereDate()
    {
    }

    public function whereYear()
    {
    }

    public function whereMonth()
    {
    }

    public function whereDay()
    {
    }

    public function groupBy()
    {
    }

    public function newest()
    {
    }

    public function oldest()
    {
    }

    public function offset()
    {
    }

    public function limit()
    {
    }

    public function union()
    {
    }

    public function lock()
    {
    }

    public function lockUpdate()
    {
    }

    public function __toString()
    {
        return '';
    }

    public function find()
    {
    }

    public function count()
    {
    }

    public function exists()
    {
    }

    public function min()
    {
    }

    public function max()
    {
    }

    public function sum()
    {
    }

    public function avg()
    {
    }

    public function get()
    {
        return $this;
    }

    public function insert()
    {
        $this->type = \phpOMS\DataStorage\Database\Query\QueryType::INSERT;

        return $this;
    }

    public function update()
    {
        $this->type = \phpOMS\DataStorage\Database\Query\QueryType::UPDATE;

        return $this;
    }

    public function increment()
    {
    }

    public function decrement()
    {
    }

    public function delete()
    {
        $this->type = \phpOMS\DataStorage\Database\Query\QueryType::DELETE;

        return $this;
    }

    public function create()
    {
        return $this;
    }

    public function drop()
    {
        return $this;
    }

    public function raw()
    {
        return $this;
    }

    public function join($table1, $table2, $column1, $opperator, $column2)
    {
        return $this;
    }

    public function joinWhere()
    {
    }

    public function leftJoin()
    {
    }

    public function leftJoinWhere()
    {
    }

    public function rightJoin()
    {
    }

    public function rightJoinWhere()
    {
    }

    public function orderBy()
    {
        return $this;
    }

    public function rollback()
    {
        return $this;
    }

    public function startTransaction()
    {
        return $this;
    }

    public function commit()
    {
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }
}
