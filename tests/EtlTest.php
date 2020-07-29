<?php

namespace Tests;

use Vtoropchin\Evtl\Etl;
use Vtoropchin\Evtl\Container;

class EtlTest extends TestCase
{
    /** @test */
    public function extract_step()
    {
        $extractor = $this->createMock('Vtoropchin\Evtl\Extractors\Extractor');
        $extractor->expects($this->once())->method('input')->with('input')->willReturnSelf();
        $extractor->expects($this->once())->method('options')->with(['options']);

        $container = $this->createMock('Vtoropchin\Evtl\Container');
        $container->expects($this->once())->method('step')->with('step_name', 'Vtoropchin\Evtl\Extractors\Extractor')->willReturn($extractor);

        $pipeline = $this->createMock('Vtoropchin\Evtl\Pipeline');
        $pipeline->expects($this->once())->method('extractor')->with($extractor);

        $evtl = new Etl($container, $pipeline);

        $this->assertInstanceOf(Etl::class, $evtl->extract('step_name', 'input', ['options']));
    }

    /** @test */
    public function transform_step()
    {
        $transformer = $this->createMock('Vtoropchin\Evtl\Transformers\Transformer');
        $transformer->expects($this->once())->method('options')->with(['options']);

        $container = $this->createMock('Vtoropchin\Evtl\Container');
        $container->expects($this->once())->method('step')->with('step_name', 'Vtoropchin\Evtl\Transformers\Transformer')->willReturn($transformer);

        $pipeline = $this->createMock('Vtoropchin\Evtl\Pipeline');
        $pipeline->expects($this->once())->method('pipe')->with($transformer);

        $evtl = new Etl($container, $pipeline);

        $this->assertInstanceOf(Etl::class, $evtl->transform('step_name', ['options']));
    }

    /** @test */
    public function load_step()
    {
        $loader = $this->createMock('Vtoropchin\Evtl\Loaders\Loader');
        $loader->expects($this->once())->method('output')->with('output')->willReturnSelf();
        $loader->expects($this->once())->method('options')->with(['options']);

        $container = $this->createMock('Vtoropchin\Evtl\Container');
        $container->expects($this->once())->method('step')->with('step_name', 'Vtoropchin\Evtl\Loaders\Loader')->willReturn($loader);

        $pipeline = $this->createMock('Vtoropchin\Evtl\Pipeline');
        $pipeline->expects($this->once())->method('pipe')->with($loader);

        $evtl = new Etl($container, $pipeline);

        $this->assertInstanceOf(Etl::class, $evtl->load('step_name', 'output', ['options']));
    }

    /** @test */
    public function run_the_etl()
    {
        $pipeline = $this->createMock('Vtoropchin\Evtl\Pipeline');
        $pipeline->expects($this->exactly(1))->method('rewind');
        $pipeline->expects($this->exactly(3))->method('valid')->willReturnOnConsecutiveCalls(true, true, false);
        $pipeline->expects($this->exactly(2))->method('next');

        $container = $this->createMock('Vtoropchin\Evtl\Container');

        $evtl = new Etl($container, $pipeline);

        $evtl->run();
    }

    /** @test */
    public function get_an_array_of_the_etl_data()
    {
        $pipeline = $this->createMock('Vtoropchin\Evtl\Pipeline');
        $pipeline->expects($this->exactly(3))->method('valid')->willReturnOnConsecutiveCalls(true, true, false);
        $pipeline->expects($this->exactly(2))->method('key')->willReturnOnConsecutiveCalls(0, 1);
        $pipeline->expects($this->exactly(2))->method('current')->willReturnOnConsecutiveCalls('row1', 'row2');
        $pipeline->expects($this->exactly(2))->method('next');

        $container = $this->createMock('Vtoropchin\Evtl\Container');

        $evtl = new Etl($container, $pipeline);

        $this->assertEquals(['row1', 'row2'], $evtl->toArray());
    }

    /** @test */
    public function get_a_service_from_the_container()
    {
        $container = $this->createMock('Vtoropchin\Evtl\Container');
        $container->expects($this->once())->method('make')->with('service')->willReturn('instance');

        Container::setInstance($container);

        $this->assertEquals('instance', Etl::service('service'));
    }
}
