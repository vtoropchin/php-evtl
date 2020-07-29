<?php

namespace Tests\Transformers;

use Tests\TestCase;
use Vtoropchin\Evtl\Row;
use Vtoropchin\Evtl\Transformers\JsonDecode;

class JsonDecodeTest extends TestCase
{
    /**
     * @var array|Row[]
     */
    protected array $dataRow;

    protected function setUp()
    {
        parent::setUp();

        $this->dataRow = [
            new Row(['id' => '"1"', 'data' => '{"name":"John Doe","email":"johndoe@email.com"}']),
            new Row(['id' => '"2"', 'data' => '{"name":"Jane Doe","email":"janedoe@email.com"}']),
        ];
    }

    /** @test */
    public function default_options()
    {
        $expected = [
            new Row(['id' => '1', 'data' => (object) ['name' => 'John Doe', 'email' => 'johndoe@email.com']]),
            new Row(['id' => '2', 'data' => (object) ['name' => 'Jane Doe', 'email' => 'janedoe@email.com']]),
        ];

        $transformer = new JsonDecode;

        $this->execute($transformer, $this->dataRow);

        $this->assertEquals($expected, $this->dataRow);
    }

    /** @test */
    public function converting_objects_to_associative_arrays()
    {
        $expected = [
            new Row(['id' => '1', 'data' => ['name' => 'John Doe', 'email' => 'johndoe@email.com']]),
            new Row(['id' => '2', 'data' => ['name' => 'Jane Doe', 'email' => 'janedoe@email.com']]),
        ];

        $transformer = new JsonDecode;

        $transformer->options(['assoc' => true]);

        $this->execute($transformer, $this->dataRow);

        $this->assertEquals($expected, $this->dataRow);
    }

    /** @test */
    public function custom_columns()
    {
        $expected = [
            new Row(['id' => '"1"', 'data' => (object) ['name' => 'John Doe', 'email' => 'johndoe@email.com']]),
            new Row(['id' => '"2"', 'data' => (object) ['name' => 'Jane Doe', 'email' => 'janedoe@email.com']]),
        ];

        $transformer = new JsonDecode;

        $transformer->options(['columns' => ['data']]);

        $this->execute($transformer, $this->dataRow);

        $this->assertEquals($expected, $this->dataRow);
    }
}
