<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    /**
     * Show Providers
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return Provider::query()->paginate(10);
    }

    /**
     * Show Provider by id
     *
     * @param Provider $provider
     * @return ProviderResource
     */
    public function show(Provider $provider)
    {
        return new ProviderResource($provider);
    }

    /**
     * Store Provider
     *
     * @param Request $request
     * @return ProviderResource|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $provider = Provider::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return new ProviderResource($provider);
    }

    /**
     * Update Provider by id
     *
     * @param Request $request
     * @param Provider $provider
     * @return ProviderResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Provider $provider)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);

        $provider->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return new ProviderResource($provider);
    }

    /**
     * Destroy Provider by id
     *
     * @param Provider $provider
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();

        return response()->json(['message' => 'Provider deleted successfully.']);
    }
}
