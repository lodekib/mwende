<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusResource\Pages;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\BusResource\RelationManagers;
use App\Models\Bus;
use App\Models\Driver;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusResource extends Resource
{
    protected static ?string $model = Bus::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make()->schema([
                    TextInput::make('plate_number')->required(),
                    Select::make('condition')->options(['good' =>'good','maintenance' => 'maintenance']),
                    DatePicker::make('service_date')->required(),
                    Select::make('route')->required()->options(['Machakos - Kitui' => 'Machakos - Kitui','Kisii - Nyamira' => 'Kisii - Nyamira']),
                    TextInput::make('capacity')->required()->integer(),
                    Select::make('driver')->options(Driver::pluck('name','name'))
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->date()->size('sm'),
                TextColumn::make('plate_number')->size('sm')->searchable()->sortable(),
                TextColumn::make('condition')->badge(),
                TextColumn::make('service_date')->date(),
                TextColumn::make('route')->badge(),
                TextColumn::make('capacity')->size('sm'),
                
            ])->headerActions([
                FilamentExportHeaderAction::make('Generate Report')->label('Generate Report')->color('gray')->outlined()->disableAdditionalColumns()->disableFilterColumns()
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ManageBuses::route('/'),
        ];
    }
}
