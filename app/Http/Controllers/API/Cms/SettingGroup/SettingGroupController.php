<?php

namespace App\Http\Controllers\API\Cms\SettingGroup;

use App\Http\Controllers\API\Cms\Base\BaseResourceController;
use App\Http\Controllers\API\Cms\SettingGroup\Requests\CreateSettingGroupRequest;
use App\Http\Controllers\API\Cms\SettingGroup\Requests\UpdateSettingGroupRequest;
use App\Services\SettingGroup\SettingGroupServiceCms;
use Illuminate\Http\JsonResponse;

class SettingGroupController extends BaseResourceController
{
    /**
     * SettingGroupController constructor.
     * @param SettingGroupServiceCms $service
     */
    public function __construct(SettingGroupServiceCms $service)
    {
        parent::__construct($service);
    }

    /**
     * @return JsonResponse
     */
    public function indexWithSettings(): JsonResponse
    {
        return response()->json($this->service->indexWithSettings());
    }

    /**
     * @param CreateSettingGroupRequest $request
     * @return JsonResponse
     */
    public function store(CreateSettingGroupRequest $request): JsonResponse
    {
        return response()->json($this->service->store($request));
    }

    /**
     * @param UpdateSettingGroupRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateSettingGroupRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($request, $id));
    }
}
