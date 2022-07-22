<?php

namespace Mateusztumatek\NovaModelLinkField\Services;

use Illuminate\Support\Collection;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;
use Laravel\Nova\Resource;
use Mateusztumatek\NovaModelLinkField\Contracts\NovaIsLinkableContract;
use Mateusztumatek\NovaModelLinkField\Contracts\ResolveResourceWithLinkContract;

class ResolveReourcesWithLinksService implements ResolveResourceWithLinkContract
{

    /**
     * This resources will not be taken in search
     * @var array
     */
    protected $exceptResources = [];

    /**
     * @param $uri_key
     * @return Resource
     */
    private function getResourceBasedOnClassName($uri_key): Resource
    {
        return Nova::resourceInstanceForKey($uri_key);
    }

    /**
     * Get Available nova resources that can be linkable
     * @return Collection
     */
    public function getResourcesWithLinks(): Collection
    {
        $request = new NovaRequest();
        $links_resources = collect(Nova::resourceInformation($request))->map(function ($item) {
            return $this->getResourceBasedOnClassName($item['uriKey']);
        })
            ->filter(function ($resourceInstance) {
                return $resourceInstance->searchable();
            })->filter(function ($resourceInstance) {
                $implements = class_implements($resourceInstance->model());
                if (isset($implements[NovaIsLinkableContract::class])) {
                    return true;
                }
                return false;
            })
            ->filter(function ($resourceInstance) {
                if (in_array(get_class($resourceInstance), $this->exceptResources)) return false;
                return true;
            })->values();
        return $links_resources;
    }

    /**
     * Set resources that shouldnt be taken in search
     * @param array $array
     * @return void
     */
    public function exceptResources(array $array): void
    {
        $this->exceptResources = $array;
    }
}
