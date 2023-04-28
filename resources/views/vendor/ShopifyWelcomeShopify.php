<?php

namespace App\Nova\Metrics;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Metrics\Trend;

class TrendMetrics extends Trend
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
        $this->column = $column ?: $this->model->getCreatedAtColumn();

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
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->countByDays($request, $this->model, $this->column)
            ->showLatestValue();
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            15 => '15 Days',
            30 => '30 Days',
            60 => '60 Days',
            90 => '90 Days',
            180 => '180 Days',
            365 => '365 Days',
        ];
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'trend-'.Str::slug(is_string($this->model) ? $this->model : get_class($this->model)).'-per-day';
    }
}
