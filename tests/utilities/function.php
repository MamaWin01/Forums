<?php

function create($class, $attributes = [], $times = null)
{
    return $class::factory($times)->create($attributes);
}

function make($class, $attributes = [])
{
    return $class::factory()->make($attributes);
}