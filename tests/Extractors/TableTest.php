<?php

namespace Tests\Extractors;

use Tests\TestCase;
use Vtoropchin\Evtl\Row;
use Vtoropchin\Evtl\Extractors\Table;

class TableTest extends TestCase
{
    /** @test */
    public function default_options()
    {
        $statement = $this->createMock('PDOStatement');
        $statement->expects($this->exactly(3))->method('fetch')->will($this->onConsecutiveCalls(['row1'], ['row2'], null));

        $query = $this->createMock('Vtoropchin\Evtl\Database\Query');
        $query->expects($this->once())->method('select')->with('table', ['*'])->will($this->returnSelf());
        $query->expects($this->once())->method('where')->with([])->will($this->returnSelf());
        $query->expects($this->once())->method('execute')->willReturn($statement);

        $manager = $this->createMock('Vtoropchin\Evtl\Database\Manager');
        $manager->expects($this->once())->method('query')->with('default')->willReturn($query);

        $extractor = new Table($manager);

        $extractor->input('table');

        $this->assertEquals([new Row(['row1']), new Row(['row2'])], iterator_to_array($extractor->extract()));
    }

    /** @test */
    public function custom_connection_columns_and_where_clause()
    {
        $statement = $this->createMock('PDOStatement');
        $statement->expects($this->exactly(3))->method('fetch')->will($this->onConsecutiveCalls(['row1'], ['row2'], null));

        $query = $this->createMock('Vtoropchin\Evtl\Database\Query');
        $query->expects($this->once())->method('select')->with('table', 'columns')->will($this->returnSelf());
        $query->expects($this->once())->method('where')->with('where')->will($this->returnSelf());
        $query->expects($this->once())->method('execute')->willReturn($statement);

        $manager = $this->createMock('Vtoropchin\Evtl\Database\Manager');
        $manager->expects($this->once())->method('query')->with('connection')->willReturn($query);

        $extractor = new Table($manager);

        $extractor->input('table');
        $extractor->options([
            'connection' => 'connection',
            'columns' => 'columns',
            'where' => 'where',
        ]);

        $this->assertEquals([new Row(['row1']), new Row(['row2'])], iterator_to_array($extractor->extract()));
    }
}
