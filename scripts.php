<?php

return [

    'enable' => function($app) {

        $util = $app['db']->getUtility();

        if ($util->tableExists('@logger') === false) {
            $util->createTable('@logger', function ($table) {

                $table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
                $table->addColumn('log_hash', 'string', ['length' => 40]);
                $table->addColumn('count', 'integer', ['length' => 10]);
                $table->addColumn('error_level', 'integer', ['length' => 3]);
                $table->addColumn('logger_name', 'string', ['length' => 24]);
                $table->addColumn('dates', 'json_array', ['notnull' => false]);
                $table->addColumn('messages', 'json_array', ['notnull' => false]);
                $table->addColumn('exception', 'json_array', ['notnull' => false]);

                $table->setPrimaryKey(['id']);
            });
        }

        if ($util->tableExists('@logger_options') === false) {
            $util->createTable('@logger_options', function ($table) {

                $table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
                $table->addColumn('log_hash', 'string', ['length' => 40]);
                $table->addColumn('details', 'json_array');

                $table->setPrimaryKey(['id']);

                $table->addUniqueIndex(['log_hash'], 'LOG_HASH');
            });
        }

    },

    'updates' => [

    ],

    'disable' => function ($app) {

    }
];

