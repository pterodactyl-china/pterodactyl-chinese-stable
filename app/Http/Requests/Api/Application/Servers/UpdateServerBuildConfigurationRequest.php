<?php

namespace Pterodactyl\Http\Requests\Api\Application\Servers;

use Pterodactyl\Models\Server;
use Illuminate\Support\Collection;

class UpdateServerBuildConfigurationRequest extends ServerWriteRequest
{
    /**
     * Return the rules to validate this request against.
     */
    public function rules(): array
    {
        $rules = Server::getRulesForUpdate($this->parameter('server', Server::class));

        return [
            'allocation' => $rules['allocation_id'],
            'oom_disabled' => $rules['oom_disabled'],

            'limits' => 'sometimes|array',
            'limits.memory' => $this->requiredToOptional('memory', $rules['memory'], true),
            'limits.swap' => $this->requiredToOptional('swap', $rules['swap'], true),
            'limits.io' => $this->requiredToOptional('io', $rules['io'], true),
            'limits.cpu' => $this->requiredToOptional('cpu', $rules['cpu'], true),
            'limits.threads' => $this->requiredToOptional('threads', $rules['threads'], true),
            'limits.disk' => $this->requiredToOptional('disk', $rules['disk'], true),

            // Legacy rules to maintain backwards compatable API support without requiring
            // a major version bump.
            //
            // @see https://github.com/pterodactyl/panel/issues/1500
            'memory' => $this->requiredToOptional('memory', $rules['memory']),
            'swap' => $this->requiredToOptional('swap', $rules['swap']),
            'io' => $this->requiredToOptional('io', $rules['io']),
            'cpu' => $this->requiredToOptional('cpu', $rules['cpu']),
            'threads' => $this->requiredToOptional('threads', $rules['threads']),
            'disk' => $this->requiredToOptional('disk', $rules['disk']),

            'add_allocations' => 'bail|array',
            'add_allocations.*' => 'integer',
            'remove_allocations' => 'bail|array',
            'remove_allocations.*' => 'integer',

            'feature_limits' => 'required|array',
            'feature_limits.databases' => $rules['database_limit'],
            'feature_limits.allocations' => $rules['allocation_limit'],
            'feature_limits.backups' => $rules['backup_limit'],
        ];
    }

    /**
     * Convert the allocation field into the expected format for the service handler.
     *
     * @return array
     */
    public function validated()
    {
        $data = parent::validated();

        $data['allocation_id'] = $data['allocation'];
        $data['database_limit'] = $data['feature_limits']['databases'] ?? null;
        $data['allocation_limit'] = $data['feature_limits']['allocations'] ?? null;
        $data['backup_limit'] = $data['feature_limits']['backups'] ?? null;
        unset($data['allocation'], $data['feature_limits']);

        // Adjust the limits field to match what is expected by the model.
        if (!empty($data['limits'])) {
            foreach ($data['limits'] as $key => $value) {
                $data[$key] = $value;
            }

            unset($data['limits']);
        }

        return $data;
    }

    /**
     * Custom attributes to use in error message responses.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'add_allocations' => '添加的分配',
            'remove_allocations' => '要删除的分配',
            'add_allocations.*' => '添加的分配',
            'remove_allocations.*' => '分配删除',
            'feature_limits.databases' => '数据库限制',
            'feature_limits.allocations' => '分配限额',
            'feature_limits.backups' => '备份限制',
        ];
    }

    /**
     * Converts existing rules for certain limits into a format that maintains backwards
     * compatability with the old API endpoint while also supporting a more correct API
     * call.
     *
     * @return array
     *
     * @see https://github.com/pterodactyl/panel/issues/1500
     */
    protected function requiredToOptional(string $field, array $rules, bool $limits = false)
    {
        if (!in_array('required', $rules)) {
            return $rules;
        }

        return (new Collection($rules))
            ->filter(function ($value) {
                return $value !== 'required';
            })
            ->prepend($limits ? 'required_with:limits' : 'required_without:limits')
            ->toArray();
    }
}
