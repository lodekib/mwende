<?php

namespace App\Filament\Resources\ParentResource\Pages;

use App\Filament\Resources\ParentResource;
use Filament\Actions;
use App\Models\Zone;
use Filament\Resources\Pages\ManageRecords;

class ManageParents extends ManageRecords
{
    protected static string $resource = ParentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-o-user-group')->label('Add Parent')->action(function(array $data){
                $zone = Zone::where('bus_station',$data['zone'])->first();
                $data = array_merge($data,['zone_id' => $zone->id]);
                return $this->getModel()::create($data);
            }),
        ];
    }
}
