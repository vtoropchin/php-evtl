<?php

namespace Tests\Transformers;

use Tests\TestCase;
use Vtoropchin\Evtl\Row;
use Vtoropchin\Evtl\Transformers\JsonEncode;

class JsonEncodeTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->data = [
            new Row(['id' => '1', 'data' => ['name' => 'John Doe', 'email' => 'johndoe@email.com']]),
            new Row(['id' => '2', 'data' => ['name' => 'Jane Doe', 'email' => 'janedoe@email.com']]),
        ];
    }

    /** @test */
    public function default_options()
    {
        $expected = [
            new Row(['id' => '"1"', 'data' => '{"name":"John Doe","email":"johndoe@email.com"}']),
            new Row(['id' => '"2"', 'data' => '{"name":"Jane Doe","email":"janedoe@email.com"}']),
        ];

        $transformer = new JsonEncode;

        $this->execute($transformer, $this->data);

        $this->assertEquals($expected, $this->data);
    }

    /** @test */
    public function custom_columns()
    {
        $expected = [
            new Row(['id' => '1', 'data' => '{"name":"John Doe","email":"johndoe@email.com"}']),
            new Row(['id' => '2', 'data' => '{"name":"Jane Doe","email":"janedoe@email.com"}']),
        ];

        $transformer = new JsonEncode;

        $transformer->options(['columns' => ['data']]);

        $this->execute($transformer, $this->data);

        $this->assertEquals($expected, $this->data);
    }
}
