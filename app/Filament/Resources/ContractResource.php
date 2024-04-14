<?php

namespace App\Filament\Resources;

use App\Filament\Field\TinyEditor;
use App\Filament\Resources\ContractResource\Pages;
use App\Filament\Resources\ContractResource\RelationManagers;
use App\Models\Contract;
use App\Models\Variable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContractResource extends Resource
{
    protected static ?string $model = Contract::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $variables = Variable::select('title', 'value')->where('active', true)->get()->toArray();

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TinyEditor::make('contract')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('uploads')
                    ->profile('default')
                    ->columnSpan('full')
                    ->maxHeight(500)
                    ->required()
                    ->reactive()
                    ->setCustomConfigs(
                        [
                            'mergetags_prefix' => '{{',
                            'mergetags_suffix' => '}}',
                            'mergetags_list'   => $variables,
                        ]
                    )
                    ->afterStateUpdated(function ($state, callable $set) {
                        //Define un patrón de expresión regular para encontrar las variables entre corchetes
                        $patron = "/\{\{[a-zA-Z]+\}\}/";

                        // Encuentra todas las coincidencias de variables en el texto
                        preg_match_all($patron, $state, $coincidencias);

                        // agrega los valores de las variables al arreglo
                        $set('variables', array_unique($coincidencias));
                    }),
                Forms\Components\Textarea::make('variables')
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageContracts::route('/'),
        ];
    }
}
