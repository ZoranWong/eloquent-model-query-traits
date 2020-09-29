<?php


namespace ZoranWong\EloquentModelQueryTrait;


use Illuminate\Database\Query\Builder;

trait SortTraits
{
    /**
     *根据指定数组数据顺序排序
     * @param Builder $query
     * @param array|string $columns
     * @param array $values
     * @param string $sort
     * @return Builder
     */
    public function scopeSortWithAssignOrder(Builder $query, $columns, $values = null, $sort = 'asc')
    {
        if(is_string($columns)) {
            $columns = [
                $columns => [is_array($values) ? $values : [$values], $sort]
            ];
        }
        $queryStr = '';
        foreach ($columns as $column => list($value, $sort)) {
            $queryStr .= $this->sortByFieldStr($column, $value, $sort);
        }
        return $query->orderByRaw($queryStr);
    }

    private function sortByFieldStr(string $field, array $values, $sort = 'asc') {
        foreach ($values as &$value) {
            $value = "'{$value}'";
        }
        $str = implode(',', $values);
        return `FIELD($field, $str) $sort`;
    }
}
