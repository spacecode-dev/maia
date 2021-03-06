<?php

namespace SpaceCode\Maia\Fields;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Http\Requests\NovaRequest;
use SpaceCode\Maia\Models\Role as RoleModel;
use SpaceCode\Maia\PermissionRegistrar;
use SpaceCode\Maia\Traits\HasPermissions;

class RoleBooleanGroup extends BooleanGroup
{
    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct(
            $name,
            $attribute,
            $resolveCallback ?? static function (Collection $permissions) {
                return $permissions->mapWithKeys(function (RoleModel $role) {
                    return [$role->name => true];
                });
            }
        );
        $roleClass = app(PermissionRegistrar::class)->getRoleClass();
        $options = $roleClass::get()->pluck('name', 'name')->toArray();
        if(!Auth::user()->hasRole('developer')) {
            unset($options['developer']);
        }
        $this->options($options);
    }

    /**
     * @param NovaRequest $request
     * @param string $requestAttribute
     * @param HasPermissions $model
     * @param string $attribute
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if (! $request->exists($requestAttribute)) {
            return;
        }
        $values = collect(json_decode($request[$requestAttribute], true))
            ->filter(static function (bool $value) {
                return $value;
            })
            ->keys()
            ->toArray();
        $model->syncRoles($values);
    }
}
