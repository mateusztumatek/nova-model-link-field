<?php

namespace Mateusztumatek\NovaModelLinkField;

use Laravel\Nova\Fields\Field;
use Mateusztumatek\NovaModelLinkField\Services\ResolveReourcesWithLinksService;

class NovaModelLinkField extends Field
{

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-model-link-field';

    /**
     * Supported store types
     * @var string[]
     */
    protected $supported_types = ['relative', 'absolute'];

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
    }

    public function exceptResources(array $resources)
    {
        return $this->withMeta(['exceptResources' => $resources]);
    }

    public function storeType(string $store_type){
        if(!in_array($store_type, $this->supported_types)) throw new \Exception('Type '.$store_type.' is not supported');
        return $this->withMeta(['storeType' => $store_type]);
    }

}
