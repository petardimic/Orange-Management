<?php

namespace phpOMS\DataStorage\Database\Query\Grammar;

class Grammar extends \phpOMS\DataStorage\Database\Grammar
{
    protected $selectComponents = [
        'aggregate',
        'columns',
        'from',
        'joins',
        'wheres',
        'groups',
        'havings',
        'orders',
        'limit',
        'offset',
        'unions',
        'lock',
    ];

    public function compileQuery()
    {
    }

    public function compileSelect($query)
    {
        return trim(
            implode(' ',
                array_filter(
                    $this->compileComponents($query),
                    function ($value) {
                        return (string) $value !== '';
                    }
                )
            )
        );
    }

    protected function compileComponents($query)
    {
        $sql = [];

        /* Loop all possible query components and if they exist compile them. */
        foreach($this->selectComponents as $component) {
            if(!isset($query->{$component})) {
                $sql[$component] = $this->{'compile' . ucfirst($component)}($query, $query->{$component});
            }
        }

        return $sql;
    }

    protected function compileColumns($query, $columns)
    {
        return ($query->distinct ? 'SELECT DISTINCT ' : 'SELECT ') . $this->columnize($columns);
    }

    protected function compileFrom($query, $table)
    {
        return 'FROM ' . implode(', ', $table);
    }

    /* compileFrom with sub functionality
    protected function compileFrom($query, $table) {
        if(is_array($table)) {
            return rtrim('FROM ' . array_map(function($value){
                if($value instanceof \phpOMS\DataStorage\Database\Query\Builder) {
                    return $value->toSQL() . ',';
                } else {
                    return $value . ',';
                }
            }, $table), ',');
        } elseif($table instanceof \phpOMS\DataStorage\Database\Query\Builder) {
            return 'FROM (' . $table->toSQL() . ') '
        } else {
            return 'FROM ' . $table;
        }
    }*/

    protected function compileWheres($query, $wheres)
    {
        $sql = [];

        foreach($query->wheres as $where) {
            $sql[] = $where['boolean'] . ' ' . $this->{'where' . $where['type']}($query, $where);
        }

        if(isset($sql[0])) {
            return 'WHERE ' . implode(' ', $sql);
        }

        return '';
    }

    protected function compileLimit($query, $limit)
    {
    }

    protected function compileOffset($query, $offset)
    {
    }

    public function compileInsert()
    {
    }
}
