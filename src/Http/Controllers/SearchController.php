<?php

namespace Mateusztumatek\NovaModelLinkField\Http\Controllers;

use Mateusztumatek\NovaModelLinkField\Contracts\ResolveResourceWithLinkContract;
use Mateusztumatek\NovaModelLinkField\Http\Requests\SearchRequest;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Mateusztumatek\NovaModelLinkField\Services\ResolveReourcesWithLinksService;
use Mateusztumatek\NovaModelLinkField\Services\SearchService;

class SearchController extends Controller
{

    /**
     * Handle search request
     * @param SearchRequest $request
     * @param ResolveResourceWithLinkContract $resourcesResolverService
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function search(SearchRequest $request, ResolveResourceWithLinkContract $resourcesResolverService)
    {
        if ($request->exceptResources) {
            $resourcesResolverService->exceptResources($request->exceptResources);
        }
        $searchService = app()->make(SearchService::class);
        if($request->store_type) $searchService->setLinkTypes($request->store_type);
        return response()->json($searchService->searchModelsByText($request->term ?? ''));
    }
}
