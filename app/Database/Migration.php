<?php
/**
 * Created by PhpStorm.
 * Date: 11/03/16
 * Time: 01:04
 */

namespace Utnianos\Core\Database;


use Utnianos\Core\Database\Schema\Blueprint;

class Migration extends \Illuminate\Database\Migrations\Migration
{
    /**
     * @var \Illuminate\Database\Schema\Builder
     */
    protected $schema;

    public function __construct()
    {
        // get custom schema object
        $this->schema = \DB::connection()->getSchemaBuilder();

        // bind new blueprint class
        $this->schema->blueprintResolver(function($table, $callback) {
            return new Blueprint($table, $callback);
        });

    }

}