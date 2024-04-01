<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DriverResource\Pages;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\DriverResource\RelationManagers;
use App\Models\Driver;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DriverResource extends Resource
{
    protected static ?string $model = Driver::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make()->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('national_id')->required()->unique(),
                    TextInput::make('email')->required()->unique(),
                    TextInput::make('phone_number')->tel()->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')->unique(ignoreRecord: true)->required()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->date()->size('sm'),
                TextColumn::make('name')->searchable()->sortable()->size('sm'),
                TextColumn::make('national_id')->searchable()->sortable()->size('sm'),
                TextColumn::make('email')->searchable()->sortable()->size('sm'),
                TextColumn::make('phone_number')->searchable()->sortable()->size('sm')
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
            'index' => Pages\ManageDrivers::route('/'),
        ];
    }
}
