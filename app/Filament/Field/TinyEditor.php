<?php

namespace App\Filament\Field;


use AmidEsfahani\FilamentTinyEditor\TinyEditor as TinyEditorParent;

class TinyEditor extends TinyEditorParent
{
    protected array $customConfigs = [];

    /**
     * @param  array  $customConfigs
     * @return $this
     */
    public function setCustomConfigs(array $customConfigs): static
    {
        $this->customConfigs = $customConfigs;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomConfigs(): string
    {
        return str_replace('"', "'", json_encode($this->customConfigs));
    }
}
