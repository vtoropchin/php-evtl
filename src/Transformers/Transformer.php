<?php

namespace Vtoropchin\Evtl\Transformers;

use Vtoropchin\Evtl\Row;
use Vtoropchin\Evtl\Step;

abstract class Transformer extends Step
{
    /**
     * Transform the given row.
     *
     * @param  \Vtoropchin\Evtl\Row  $row
     * @return void
     */
    abstract public function transform(Row $row);
}
