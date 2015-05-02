<?php
namespace phpOMS\Model;

abstract class ORM implements \JsonSerializable, \phpOMS\Contract\JsonableInterface
{
    use \phpOMS\Validation\ModelValidationTrait;

// region Class Fields
    /**
     * The connection name for the model.
     *
     * @var \phpOMS\DataStorage\Database\Connection\ConnectionInterface
     */
    protected $connection = null;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = null;

    /**
     * The column prefix
     *
     * e.g. Tablename
     *
     * @var string
     */
    protected $columnPrefix = '';

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
     * The name of the created at.
     *
     * @var \DateTime
     */
    protected $created_at          = null;

    protected $created_at_column   = 'created_at';

    protected static
        /** @noinspection PhpUnusedPrivateFieldInspection */
              $created_at_validate = [
                  'isType' => ['datetime']
              ];

    /**
     * The id of the "updated by"
     *
     * @var int
     */
    protected $created_by          = null;

    protected $created_by_column   = 'created_by';

    protected static
        /** @noinspection PhpUnusedPrivateFieldInspection */
              $created_by_validate = [
                  'isType'   => ['integer'],
                  'hasLimit' => [1, PHP_INT_MAX]
              ];

    /**
     * The date of the updated at
     *
     * @var \DateTime
     */
    protected $updated_at          = null;

    protected $updated_at_column   = 'updated_at';

    protected static
        /** @noinspection PhpUnusedPrivateFieldInspection */
              $updated_at_validate = [
                  'isType' => ['datetime']
              ];

    /**
     * The id of the updated at
     *
     * @var int
     */
    protected $updated_by          = null;

    protected $updated_by_column   = 'updated_by';

    protected static
        /** @noinspection PhpUnusedPrivateFieldInspection */
              $updated_by_validate = [
                  'isType'   => ['integer'],
                  'hasLimit' => [1, PHP_INT_MAX]
              ];

// endregion

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

    protected function query()
    {
        return new \phpOMS\DataStorage\Database\Query\Builder($this->connection, $this->connection->getGrammar());
    }

    protected static function on()
    {
    }

    protected static function all()
    {
    }

    protected static function with()
    {
    }

    protected static function delete()
    {
    }

    protected function create()
    {
    }

    protected function updateOrCreate()
    {
    }

    protected function update()
    {
    } // TODO: provide different levels of implementation (1 = least information, 3 = all information) maybe use enum?!

    abstract protected function init($level = 1);

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
