<?php

namespace App\Http\Controllers;

use App\Http\Resources\StorageResource;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StorageController extends Controller
{
    /**
     * Show Storages
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return Storage::query()->paginate(10);
    }

    /**
     * Show Storage by id
     *
     * @param Storage $storage
     * @return StorageResource
     */
    public function show(Storage $storage)
    {
        return new StorageResource($storage);
    }

    /**
     * Store Storage
     *
     * @param Request $request
     * @return StorageResource|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['address' => 'required|string']);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $storage = Storage::create(['address' => $request->address]);

        return new StorageResource($storage);
    }

    /**
     * Update Storage by id
     *
     * @param Request $request
     * @param Storage $storage
     * @return StorageResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Storage $storage)
    {
        $validator = Validator::make($request->all(), ['address' => 'required|string']);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);

        $storage->update(['address' => $request->address]);

        return new StorageResource($storage);
    }

    /**
     * Destroy Storage by id
     *
     * @param \App\Models\Storage $storage
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Storage $storage)
    {
        $storage->delete();

        return response()->json(['message' => 'Storage deleted successfully.']);
    }
}
