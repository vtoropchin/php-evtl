<?php

namespace Vtoropchin\Evtl\Extractors;

use Vtoropchin\Evtl\Row;
use Vtoropchin\Evtl\Database\Manager;

class Table extends Extractor
{
    /**
     * Extractor columns.
     *
     * @var array
     */
    protected $columns = ['*'];

    /**
     * The connection name.
     *
     * @var string
     */
    protected $connection = 'default';

    /**
     * The array of where clause.
     *
     * @var array
     */
    protected $where = [];

    /**
     * The database manager.
     *
     * @var \Vtoropchin\Evtl\Database\Manager
     */
    protected $db;

    /**
     * Properties that can be set via the options method.
     *
     * @var array
     */
    protected $availableOptions = [
        'columns', 'connection', 'where'
    ];

    /**
     * Create a new Table Extractor instance.
     *
     * @param  \Vtoropchin\Evtl\Database\Manager  $manager
     * @return void
     */
    public function __construct(Manager $manager)
    {
        $this->db = $manager;
    }

    /**
     * Extract data from the input.
     *
     * @return \Generator
     */
    public function extract()
    {
        $statement = $this->db
            ->query($this->connection)
            ->select($this->input, $this->columns)
            ->where($this->where)
            ->execute();

        while ($row = $statement->fetch()) {
            yield new Row($row);
        }
    }
}
