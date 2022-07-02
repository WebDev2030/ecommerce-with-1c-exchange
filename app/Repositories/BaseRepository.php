<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * The repository associated main model.
     *
     * @var class-string
     */
    protected $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        if ($this->model) {
            $this->setModel($this->model);
        }
    }

    /**
     * Create one or more model instances from data array.
     * The use of this method suppose that your array is correctly formatted.
     *
     * @param array $data
     * @param bool  $saveMissingModelFillableAttributesToNull
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createOrUpdateMultipleFromArray(
        array $data,
        bool $saveMissingModelFillableAttributesToNull = true
    ): Collection {
        $models = new Collection();
        foreach ($data as $instanceData) {
            $models->push($this->createOrUpdateFromArray($instanceData, $saveMissingModelFillableAttributesToNull));
        }

        return $models;
    }

    /**
     * Create or update a model instance from data array.
     * The use of this method suppose that your array is correctly formatted.
     *
     * @param array $data
     * @param bool  $saveMissingModelFillableAttributesToNull
     *
     * @return Model
     */
    public function createOrUpdateFromArray(array $data, bool $saveMissingModelFillableAttributesToNull = true): Model
    {
        $primary = $this->getModelPrimaryFromArray($data);

        return $primary
            ? $this->updateByPrimary($primary, $data, $saveMissingModelFillableAttributesToNull)
            : $this->getModel()->create($data);
    }

    /**
     * Get the repository model.
     *
     * @return Model
     * @throws ModelNotFoundException
     */
    protected function getModel(): Model
    {
        if ($this->model instanceof Model) {
            return $this->model;
        }
        throw new ModelNotFoundException(
            'You must declare your repository $model attribute with an Illuminate\Database\Eloquent\Model '
            . 'namespace to use this feature.'
        );
    }

    /**
     * Set the repository model class to instantiate.
     *
     * @param string $modelClass
     *
     * @return BaseRepository
     */
    public function setModel(string $modelClass): BaseRepository
    {
        $this->model = app($modelClass);

        return $this;
    }

    /**
     * Update a model instance from its primary key.
     *
     * @param int   $primary
     * @param array $data
     * @param bool  $saveMissingModelFillableAttributesToNull
     *
     * @return Model
     */
    public function updateByPrimary(
        int $primary,
        array $data,
        bool $saveMissingModelFillableAttributesToNull = true
    ): Model {
        $instance = $this->getModel()->findOrFail($primary);
        $data = $saveMissingModelFillableAttributesToNull ? $this->setMissingFillableAttributesToNull($data) : $data;
        $instance->update($data);

        return $instance;
    }

    /**
     * Add the missing model fillable attributes with a null value.
     *
     * @param array $data
     *
     * @return array
     */
    public function setMissingFillableAttributesToNull(array $data): array
    {
        $fillableAttributes = $this->getModel()->getFillable();
        $dataWithMissingAttributesToNull = [];
        foreach ($fillableAttributes as $fillableAttribute) {
            $dataWithMissingAttributesToNull[$fillableAttribute] =
                isset($data[$fillableAttribute]) ? $data[$fillableAttribute] : null;
        }

        return $dataWithMissingAttributesToNull;
    }

    /**
     * Delete a model instance from its primary key.
     *
     * @param int $primary
     *
     * @return bool|null
     * @throws ModelNotFoundException
     */
    public function deleteByPrimary(int $primary): ?bool
    {
        return $this->getModel()->findOrFail($primary)->delete();
    }

    /**
     * Delete multiple model instances from their primary keys.
     *
     * @param array $instancePrimaries
     *
     * @return int
     * @throws ModelNotFoundException
     */
    public function deleteMultipleFromPrimaries(array $instancePrimaries): int
    {
        return $this->getModel()->destroy($instancePrimaries);
    }

    /**
     * Find one model instance from its primary key value.
     *
     * @param int  $primary
     * @param bool $throwsExceptionIfNotFound
     *
     * @return Model|null
     * @throws ModelNotFoundException
     */
    public function findOneByPrimary(int $primary, bool $throwsExceptionIfNotFound = true): ?Model
    {
        return $throwsExceptionIfNotFound
            ? $this->getModel()->findOrFail($primary)
            : $this->getModel()->find($primary);
    }

    /**
     * Find multiple model instances from a « where » parameters array.
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws ModelNotFoundException
     */
    public function findMultipleFromArray(array $data): Collection
    {
        return $this->getModel()->where($data)->get();
    }

    /**
     * Get all model instances from database.
     *
     * @param array  $columns
     * @param string $orderBy
     * @param string $orderByDirection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws ModelNotFoundException
     */
    public function getAll($columns = ['*'], string $orderBy = 'default', string $orderByDirection = 'asc'): Collection
    {
        $orderBy = $orderBy === 'default' ? $this->getModel()->getKeyName() : $orderBy;

        return $this->getModel()->orderBy($orderBy, $orderByDirection)->get($columns);
    }

    /**
     * Instantiate a model instance with an attributes array.
     *
     * @param array $data
     *
     * @return Model
     * @throws ModelNotFoundException
     */
    public function make(array $data): Model
    {
        return app($this->getModel()->getMorphClass())->fill($data);
    }

    /**
     * Get the model unique storage instance or create one.
     *
     * @return Model
     */
    public function modelUniqueInstance(): Model
    {
        $modelInstance = $this->getModel()->first();
        if (! $modelInstance) {
            $modelInstance = $this->getModel()->create([]);
        }

        return $modelInstance;
    }

    /**
     * Find multiple model instances from an array of ids.
     *
     * @param array $primaries
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findMultipleFromPrimaries(array $primaries): Collection
    {
        return $this->getModel()->findMany($primaries);
    }
}
