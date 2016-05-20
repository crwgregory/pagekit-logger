<?php
/**
 * Created by PhpStorm.
 * User: crwgr
 * Date: 5/20/2016
 * Time: 8:42 AM
 */

namespace Nativerank\Logger\Model;

use Pagekit\Database\ORM\ModelTrait;

/**
 * @Entity(tableClass="@logger_options")
 */
class LoggerOptionsORM implements \JsonSerializable
{
    use ModelTrait;

    /** @Column(type="integer") @Id */
    public $id;

    /** @Column(type="string") */
    public $log_hash;

    /** @Column(type="json_array") */
    public $details;
}