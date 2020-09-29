<?php
namespace ZoranWong\EloquentModelQueryTrait;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\DB;
/**
 * 为你的应用提供LBS服务
 * */
trait LBSTrait
{
    use SpatialTrait;
    /**
     * 多少范围内对象
     *
     * @param EloquentBuilder|QueryBuilder|static $query
     * @param Point $position 搜索范围的中心点
     * @param float $distance 距离（单位：米（m））
     * @return EloquentBuilder|QueryBuilder
     */
    public function scopeAround($query, Point $position, float $distance = 5000)
    {
        return $query->distanceSphere('position', $position, $distance);
    }

    /**
     * 添加计算的距离字段
     *
     * @param EloquentBuilder|QueryBuilder|static $query
     * @param Point $position
     * @param string $field
     * @return EloquentBuilder|QueryBuilder
     */
    public function scopeAddDistance($query, Point $position, $field = 'distance') {
        return $query->addSelect([DB::raw("st_distance_sphere(`position`, ST_GeomFromText('{$position->toWKT()}')) as `{$field}`")]);
    }
}
