<?php
namespace phpOMS\Models;

abstract class ORM implements \JsonSerializable, \phpOMS\Support\JsonableInterface {
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected static $table;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = null;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 15;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = [];

    /**
     * User exposed observable events
     *
     * @var array
     */
    protected $observables = [];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [];

    protected $queryBuilder = null;

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'created_at';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const CREATED_BY = 'created_by';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'updated_at';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_BY = 'updated_by';

    public function query() {
        return new \phpOMS\DataStorage\Database\Query\Builder($this->connection);
    }

    public function create() {}
    public function updateOrCreate() {}
    public function update() {}

    public static function find() {
        (new static)->query();
    }

    abstract public static function init();

    public static function on() {}
    public static function all() {}
    public static function with() {} // TODO: provide different levels of implementation (1 = least information, 3 = all information) maybe use enum?!
    public static function delete() {}
}