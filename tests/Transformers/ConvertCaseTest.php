<?php

namespace Tests\Transformers;

use Tests\TestCase;
use Vtoropchin\Evtl\Row;
use Vtoropchin\Evtl\Transformers\ConvertCase;

class ConvertCaseTest extends TestCase
{
    /**
     * @var array|Row[]
     */
    protected array $dataRow;

    protected function setUp()
    {
        parent::setUp();

        $this->dataRow = [
            new Row(['id' => '1', 'name' => 'jane doe', 'email' => 'janedoe@email.com']),
            new Row(['id' => '2', 'name' => 'JOHN DOE', 'email' => 'JOHNDOE@EMAIL.COM']),
        ];
    }

    /** @test */
    public function lowercase()
    {
        $expected = [
            new Row(['id' => '1', 'name' => 'jane doe', 'email' => 'janedoe@email.com']),
            new Row(['id' => '2', 'name' => 'john doe', 'email' => 'johndoe@email.com']),
        ];

        $transformer = new ConvertCase;

        $transformer->options(['mode' => 'lower']);

        $this->execute($transformer, $this->dataRow);

        $this->assertEquals($expected, $this->dataRow);
    }

    /** @test */
    public function uppercase()
    {
        $expected = [
            new Row(['id' => '1', 'name' => 'JANE DOE', 'email' => 'JANEDOE@EMAIL.COM']),
            new Row(['id' => '2', 'name' => 'JOHN DOE', 'email' => 'JOHNDOE@EMAIL.COM']),
        ];

        $transformer = new ConvertCase;

        $transformer->options(['mode' => 'upper']);

        $this->execute($transformer, $this->dataRow);

        $this->assertEquals($expected, $this->dataRow);
    }

    /** @test */
    public function titlecase()
    {
        $expected = [
            new Row(['id' => '1', 'name' => 'Jane Doe', 'email' => 'Janedoe@Email.com']),
            new Row(['id' => '2', 'name' => 'John Doe', 'email' => 'Johndoe@Email.com']),
        ];

        $transformer = new ConvertCase;

        $transformer->options(['mode' => 'title']);

        $this->execute($transformer, $this->dataRow);

        $this->assertEquals($expected, $this->dataRow);
    }

    /** @test */
    public function custom_columns()
    {
        $expected = [
            new Row(['id' => '1', 'name' => 'jane doe', 'email' => 'janedoe@email.com']),
            new Row(['id' => '2', 'name' => 'john doe', 'email' => 'JOHNDOE@EMAIL.COM']),
        ];

        $transformer = new ConvertCase;

        $transformer->options(['columns' => ['name']]);

        $this->execute($transformer, $this->dataRow);

        $this->assertEquals($expected, $this->dataRow);
    }
}
