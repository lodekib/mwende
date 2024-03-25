<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use App\Models\Theparent;
use Filament\Resources\Pages\ManageRecords;

class ManageStudents extends ManageRecords
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-o-user-group')->action(function(array $data){
                $parent = Theparent::where('name',$data['parent_name'])->first();
                $data = array_merge($data,['parent_id' => $parent->id]);

                return $this->getModel()::create($data);
            }),
        ];
    }
}
