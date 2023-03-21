<?php

namespace Wehaa\LiveupdateBoolean\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class LiveupdateBooleanController extends Controller
{
    public function update(NovaRequest $request)
    {
        /** @var Resource $resourceClass */
        $resourceClass = $request->resource();
        $resourceValidationRules = $resourceClass::rulesForUpdate($request);
        $fieldValidationRules = $resourceValidationRules[$request->attribute]  ?? [];

        if (!empty($fieldValidationRules)) {
            $validatedData = $request->validate(
                [
                    'value' => $fieldValidationRules,
                ]
            );
        }

        $model = $request->model()->find($request->id);
        $model->{$request->attribute} = $request->value;
        $model->save();
    }
}
