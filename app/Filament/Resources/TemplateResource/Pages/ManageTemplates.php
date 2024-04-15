<?php

namespace App\Filament\Resources\TemplateResource\Pages;

use App\Filament\Resources\TemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTemplates extends ManageRecords
{
    protected static string $resource = TemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    //Define un patrón de expresión regular para encontrar las variables entre corchetes
                    $patron = "/\{\{[a-zA-Z_áéíóúÁÉÍÓÚñÑ\-\s]+\}\}/u";

                    // Encuentra todas las coincidencias de variables en el texto
                    preg_match_all($patron, $data['contract'], $coincidencias);

                    $data['variables'] = array_unique($coincidencias[0]);

                    return $data;
                }),
        ];
    }
}
