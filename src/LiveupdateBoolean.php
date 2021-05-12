<?php

namespace Wehaa\LiveupdateBoolean;

use Laravel\Nova\Fields\Field;
use Config;

class LiveupdateBoolean extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'liveupdate-boolean';

    protected function resolveAttribute($resource, $attribute)
    {
        $this->setResourceId(data_get($resource, $resource->getKeyName()));

        return parent::resolveAttribute($resource, $attribute);
    }

    protected function setResourceId($id)
    {
        return $this->withMeta(['id' => $id, 'nova_path' => Config::get('nova.path')]);
    }
}
