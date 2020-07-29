<?php

namespace Tests;

use Vtoropchin\Evtl\Loaders\Loader;
use Vtoropchin\Evtl\Transformers\Transformer;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function execute($step, $data)
    {
        if ($step instanceof Transformer) {
            $method = 'transform';
        }

        if ($step instanceof Loader) {
            $method = 'load';
        }

        $step->initialize();

        foreach ($data as $row) {
            $step->$method($row);
        }

        $step->finalize();
    }
}
