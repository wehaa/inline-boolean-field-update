<?php

namespace Wehaa\LiveupdateBoolean;

use Laravel\Nova\Fields\Boolean;
use Config;

class LiveupdateBoolean extends Boolean
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'liveupdate-boolean';

    /**
     * Resolve the given attribute from the given resource.
     *
     * @param  mixed  $resource
     * @param  string  $attribute
     * @return bool|null
     */
    protected function resolveAttribute($resource, $attribute): ?bool {
        $this->setResourceId(data_get($resource, $resource->getKeyName()));

        return parent::resolveAttribute($resource, $attribute);
    }

    /**
     * @param int|null $id
     *
     * @return LiveupdateBoolean
     */
    protected function setResourceId(?int $id): self {
        return $this->withMeta(['id' => $id, 'nova_path' => Config::get('nova.path')]);
    }
}
