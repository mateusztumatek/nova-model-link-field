<?php

namespace Mateusztumatek\NovaModelLinkField\Contracts;

use Illuminate\Support\Collection;

interface ResolveResourceWithLinkContract
{

    /**
     * @return Collection
     */
    public function getResourcesWithLinks(): Collection;

    public function exceptResources(array $array): void;
}
