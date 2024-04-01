<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Theparent;
use App\Models\User;
use App\Models\Driver;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('roles')->relationship('roles', 'name')->reactive(),
                Select::make('name')->required()->options(function (Get $get) {
                    if ($get('roles') != null) {
                        $role = Role::find($get('roles'))->name;
                        return  $role == 'Parent' ? Theparent::pluck('name', 'name') : Driver::pluck('name', 'name');
                    }
                }),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')->password()->required()->confirmed(),
                TextInput::make('password_confirmation')->required()->password()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->date()->size('sm'),
                TextColumn::make('name')->size('sm'),
                TextColumn::make('email')->size('sm'),
                TextColumn::make('password')->size('sm'),
                TextColumn::make('role.name')->size('sm')
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
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
