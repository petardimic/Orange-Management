<?php
namespace phpOMS\Model;

abstract class ORM implements \JsonSerializable, \phpOMS\Contract\JsonableInterface
{
    use \phpOMS\Validation\ModelValidationTrait;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = null;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = null;

    /**
     * The primary key for the model.
     *
     * @var mixed
     */
    protected $id = null;

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
    protected $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $timestamps = true;

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

    /**
     * The query builder
     *
     * @var \phpOMS\DataStorage\Database\Query\Builder
     */
    protected $queryBuilder = null;

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    protected $created_at = 'created_at';
    protected static
        /** @noinspection PhpUnusedPrivateFieldInspection */
        $created_at_validate = [
        'isType' => ['datetime']
    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    protected $created_by = 'created_by';
    protected static
        /** @noinspection PhpUnusedPrivateFieldInspection */
        $created_by_validate = [
        'isType' => ['integer'],
        'hasLimit' => [1, PHP_INT_MAX]
    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    protected $updated_at = 'updated_at';
    protected static
        /** @noinspection PhpUnusedPrivateFieldInspection */
        $updated_at_validate = [
        'isType' => ['datetime']
    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    protected $updated_by = 'updated_by';
    protected static
        /** @noinspection PhpUnusedPrivateFieldInspection */
        $updated_by_validate = [
        'isType' => ['integer'],
        'hasLimit' => [1, PHP_INT_MAX]
    ];

    protected function query()
    {
        return new \phpOMS\DataStorage\Database\Query\Builder($this->connection);
    }

    protected function create()
    {
    }

    protected function updateOrCreate()
    {
    }

    protected function update()
    {
    }

    protected static function find()
    {
        $resultSet = (new static)->query();

        $list = null;

        foreach($resultSet as $key => $result) {
            $list[$key] = new static();
            $list[$key]->init($result);
        }

        return $list;
    }

    abstract protected function init($level = 1);

    protected static function on()
    {
    }

    protected static function all()
    {
    }

    protected static function with()
    {
    } // TODO: provide different levels of implementation (1 = least information, 3 = all information) maybe use enum?!

    protected static function delete()
    {
    }

    protected function fill($attributes)
    {
        foreach($attributes as $name => $attribute) {
            if(!property_exists(new static, $attribute)) {
                throw new \Exception('Unknown property ' . $attribute);
            }

            $this->{'set' . ucfirst($name)} = $attribute;
        }
    }
}
