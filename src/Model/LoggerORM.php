<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 5/13/2016
 * Time: 2:22 PM
 */

namespace Nativerank\Logger\Model;

use Pagekit\Database\ORM\ModelTrait;

/**
 * @Entity(tableClass="@logger")
 */
class LoggerORM implements \JsonSerializable
{
    use ModelTrait;

    /** @Column(type="integer") @Id */
    public $id;

    /** @Column(type="string") */
    public $log_hash;

    /** @Column(type="integer") */
    public $count;

    /** @Column(type="integer") */
    public $error_level;

    /** @Column(type="string") */
    public $logger_name;

    /** @Column(type="json_array") */
    public $dates;

    /** @Column(type="json_array") */
    public $log;
}