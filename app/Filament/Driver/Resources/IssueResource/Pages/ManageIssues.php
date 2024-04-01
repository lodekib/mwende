<?php

namespace App\Filament\Driver\Resources\IssueResource\Pages;

use App\Filament\Driver\Resources\IssueResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageIssues extends ManageRecords
{
    protected static string $resource = IssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->action(function(array $data){
                $data = array_merge($data,['driver_id' => auth()->id()]);
                
                return $this->getModel()::create($data);
            }),
        ];
    }
}
