<?php


namespace ZoranWong\EloquentModelQueryTrait;


use DateTime;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;

trait TimeTraits
{
    /**
     * 比较时间$field2 - $field1 的时间差与$value的关系
     * @param Builder $query
     * @param string|DateTime $field1
     * @param string|DateTime $field2
     * @param $operator
     * @param int $value
     * @param string $unit
     * @return Builder
     */
    public function scopeWhereTimestampDiff($query, $field1, $field2, $value, $operator = '>=', $unit = 'SECOND')
    {
        $field1 = isDate($field1) || $field1 instanceof DateTimeInterface ? "'{$field1}'" : $field1;
        $field2 = isDate($field2) || $field2 instanceof DateTimeInterface ? "'{$field2}'" : $field2;
        $sql = "TIMESTAMPDIFF({$unit}, {$field1}, {$field2}) {$operator} {$value}";
        return $query->whereRaw($sql);
    }

    /**
     *时间是否在给定时间范围内
     * @param Builder $query
     * @param string $field
     * @param string|DateTimeInterface|array $start
     * @param string|DateTimeInterface|null $end
     * @return Builder
     */
    public function scopeWhereTimeBetween($query, $field, $start, $end = null)
    {
        if(is_array($start)) {
            list($start, $end) = $start;
        }
        $start = isDate($start) || $start instanceof DateTimeInterface ? `"$start"` : $start;
        $end = isDate($end) || $end instanceof  DateTimeInterface ? `"$end"` : $end;
        return $query->whereRaw(`$field >= $start and $field < $end`);
    }

    /**
     * 比较时间$field2 - $field1 的相差天数与$value的关系
     * @param Builder $query
     * @param string|DateTime $field1
     * @param string|DateTime $field2
     * @param int $value
     * @param string $operator
     * @return Builder
     */
    public function scopeWhereDateDiff($query, $field1, $field2, $value, $operator = '>=')
    {
        $field1 = isDate($field1) || $field1 instanceof DateTimeInterface ? "'{$field1}'" : $field1;
        $field2 = isDate($field2) || $field2 instanceof DateTimeInterface ? "'{$field2}'" : $field2;
        $sql = "DATEDIFF({$field1}, {$field2}) {$operator} {$value}";
        return $query->whereRaw($sql);
    }
}
