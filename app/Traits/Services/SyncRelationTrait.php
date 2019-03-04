<?php

namespace App\Traits\Services;

trait SyncRelationTrait
{
    protected function syncRelation($repo, array $relations, $type, $columnRelation, $newId)
    {

        if (! $relations[1]) {
            $relations = [$relations];
        }

        foreach ($relations as $relation) {

            if ($relation['type'] != $type) {
                continue;
            }

            $attributes = $repo->getById($relation['id']);

            if ($attributes) {

                $attributes = $attributes->toArray();

                $attributes[$columnRelation] = $newId;
                $repo->update($attributes, $relation['id']);
            }
        }
    }
}