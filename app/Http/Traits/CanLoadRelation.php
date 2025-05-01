<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

trait CanLoadRelation {
public function loadRelation(Model | Builder | QueryBuilder $for) : Model | QueryBuilder| Builder   {
        $relations = ['employer', 'employer.jobs'];
        $include = request()->query('include');
        if(!$include) {
            return $for;
        }
        $queryRelations = array_map('trim', explode(',', $include));
        foreach ($relations as $relation) {
            $for->when($this->shouldIncludeRelation($relation, $queryRelations), fn($q) => $for instanceof Model ? $for->load($relation) :  $q->with($relation));
        }
        return $for;
    }



protected function shouldIncludeRelation(string $relation, array $queryRelations) : bool {
    // $include = request()->query('include');
    // if(!$include) {
    //     return false;
    // }
    // $relations = array_map('trim', explode(',', $include));
    return in_array($relation, $queryRelations);
}
}