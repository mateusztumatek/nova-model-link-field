<?php

namespace Mateusztumatek\NovaModelLinkField\Contracts;

interface NovaIsLinkableContract
{
    /**
     * Return relative app relative link to this resource
     * @return string
     */
    public function novaLink(): string;
}
