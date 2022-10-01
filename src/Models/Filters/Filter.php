<?php

namespace Taskday\Models\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use ReflectionClass;

abstract class Filter
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * Filter constructor.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get all the available filter methods.
     *
     * @return array
     */
    protected function getFilterMethods()
    {
        $class = new ReflectionClass(static::class);

        $methods = array_map(function ($method) use ($class) {
            if ($method->class === $class->getName()) {
                return $method->name;
            }
            return null;
        }, $class->getMethods());

        return array_filter($methods);
    }

    /**
     * Get all the filters that can be applied.
     *
     * @return array
     */
    protected function getFilters()
    {
        return array_filter($this->request->only($this->getFilterMethods()), function ($var) {
            return $var !== null && $var !== false && $var !== '';
        });
    }

    /**
     * Apply all the requested filters if available.
     *
     * @param  Builder  $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $name => $value) {
            $this->callFilter($name, $value);
        }

        return $this->builder;
    }

    /**
     * Call the requested filter.
     *
     * @param  string  $name
     * @param  string  $args
     */
    public function callFilter($name, $args)
    {
        if (method_exists($this, $name)) {
            if ($args !== null) {
                $this->$name($args);
            } else {
                $this->$name();
            }
        }
    }
}
