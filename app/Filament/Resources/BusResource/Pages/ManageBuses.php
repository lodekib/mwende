<?php

namespace App\Filament\Resources\BusResource\Pages;

use App\Filament\Resources\BusResource;
use Filament\Actions;
use App\Models\Driver;
use Filament\Resources\Pages\ManageRecords;

class ManageBuses extends ManageRecords
{
    protected static string $resource = BusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-o-truck')->action(function(array $data){
                $driver = Driver::where('name',$data['driver'])->first();
               $data = array_merge($data,['driver_id' => $driver->id]);
               return $this->getModel()::create($data);
            }),
        ];
    }
}
