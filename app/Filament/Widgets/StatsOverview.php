<?php

namespace App\Filament\Widgets;

use App\Models\Bus;
use App\Models\Student;
use App\Models\Theparent;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{protected function getStats(): array
    {
        return [
            Stat::make('Students Enrolled', number_format(''.Student::count()))
                ->description('...')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Parents', number_format(''.Theparent::count()))
                ->description('...')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Total Buses', number_format(''.Bus::count()))
                ->description('...')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
