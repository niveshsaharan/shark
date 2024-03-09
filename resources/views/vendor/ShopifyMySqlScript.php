<?php

namespace App\Nova\Metrics;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Metrics\Partition;

class PartitionMetrics extends Partition
{
    use WithCache;

    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/2';

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var string column
     */
    protected $column;

    /**
     * Set resource column
     *
     * @param $column
     *
     * @return $this
     */
    public function column($column)
    {
        $this->column = $column;

        return $this;
    }

    /**
     * Set resource model
     *
     * @param $model
     *
     * @return $this
     */
    public function model($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Set resource name
     *
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function calculate(Request $request)
    {
        $partition = $this->count($request, $this->model, $this->column, $this->column);

        $colors = [];
        $partition->value = collect($partition->value)->filter(function ($value, $key) use (&$colors) {
            $colors[$key] = '#'.substr(md5($key), 0, 6);

            return $key;
        })->toArray();

        arsort($partition->value);

        $partition->colors($colors);

        return $partition;
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'partition-metrics-by-'.Str::slug(is_string($this->model) ? $this->model : get_class($this->model)).'-'.$this->column;
    }
}
