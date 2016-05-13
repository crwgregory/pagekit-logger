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
                $table->addColumn('logger_name', 'text');
                $table->addColumn('dates', 'json_array');
                $table->addColumn('log', 'json_array');

                $table->setPrimaryKey(['id']);

                $table->addUniqueIndex(['log_hash'], 'LOG_HASH');
                $table->addIndex(['error_level'], 'ERROR_LEVEL');
                $table->addIndex(['logger_name'], 'LOGGER_NAME');
            });
        }

    },

    'updates' => [

    ],

    'disable' => function ($app) {

    }
];

