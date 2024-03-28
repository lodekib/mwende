<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParentResource\Pages;
use App\Filament\Resources\ParentResource\RelationManagers;
use App\Models\Theparent;
use Filament\Forms;
use App\Models\Zone;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParentResource extends Resource
{
    protected static ?string $model = Theparent::class;
    protected static ?string $pluralModelLabel = 'Parents';
    protected static ?string $recordTitleAttribute = 'Parents';
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make()->schema([
                    TextInput::make('name')->required(),
                    Select::make('zone')->options(Zone::pluck('bus_station', 'bus_station')),
                    TextInput::make('national_id')->required(),
                    TextInput::make('residence')->required(),
                    TextInput::make('phone_number')->required(),
                    TextInput::make('email')->required()->email(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->date()->size('sm'),
                TextColumn::make('name')->searchable()->size('sm'),
                TextColumn::make('zone')->searchable()->size('sm'),
                TextColumn::make('residence')->size('sm')->searchable()->sortable(),
                TextColumn::make('email')->size('sm'),
                TextColumn::make('phone_number')->size('sm')
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->button()
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
            'index' => Pages\ManageParents::route('/'),
        ];
    }
}
