<?php

namespace SpaceCode\Maia\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use SpaceCode\Maia\Contracts\Permission as PermissionContract;
use SpaceCode\Maia\Exceptions\PermissionDoesNotExist;
use SpaceCode\Maia\PermissionRegistrar;
use SpaceCode\Maia\Traits\HasRoles;
use SpaceCode\Maia\Traits\RefreshesPermissionCache;
//use SpaceCode\Maia\Exceptions\PermissionAlreadyExists;

class Permission extends Model implements PermissionContract
{
    use HasRoles, RefreshesPermissionCache;

    protected $guarded = ['id'];

    /**
     * Permission constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');
        parent::__construct($attributes);
        $this->setTable('permissions');
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            \SpaceCode\Maia\Models\Role::class,
            'role_has_permissions',
            'permission_id',
            'role_id'
        );
    }

    /**
     * @return MorphToMany
     */
    public function users(): MorphToMany
    {
        return $this->morphedByMany(
            getModelForGuard($this->attributes['guard_name']),
            'model',
            'model_has_permissions',
            'permission_id',
            'model_id'
        );
    }

    /**
     * @param string $name
     * @param string|null $guardName
     * @return PermissionContract
     * @throws PermissionDoesNotExist
     */
    public static function findByName(string $name, $guardName = null): PermissionContract
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);
        $permission = static::getPermissions(['name' => $name, 'guard_name' => $guardName])->first();
        if (! $permission) {
            throw PermissionDoesNotExist::create($name, $guardName);
        }
        return $permission;
    }

    /**
     * @param int $id
     * @param string|null $guardName
     * @return PermissionContract
     * @throws PermissionDoesNotExist
     */
    public static function findById(int $id, $guardName = null): PermissionContract
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);
        $permission = static::getPermissions(['id' => $id, 'guard_name' => $guardName])->first();
        if (! $permission) {
            throw PermissionDoesNotExist::withId($id, $guardName);
        }
        return $permission;
    }

    /**
     * @param string $name
     * @param string|null $guardName
     * @return PermissionContract
     */
    public static function findOrCreate(string $name, $guardName = null): PermissionContract
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);
        $permission = static::getPermissions(['name' => $name, 'guard_name' => $guardName])->first();
        if (! $permission) {
            return static::query()->create(['name' => $name, 'guard_name' => $guardName]);
        }
        return $permission;
    }

    /**
     * @param array $params
     * @return Collection
     */
    protected static function getPermissions(array $params = []): Collection
    {
        return app(PermissionRegistrar::class)
            ->setPermissionClass(static::class)
            ->getPermissions($params);
    }
}
