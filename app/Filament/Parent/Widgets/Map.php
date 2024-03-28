<?php

namespace App\Filament\Parent\Widgets;
use Webbingbrasil\FilamentMaps\Actions;
use Webbingbrasil\FilamentMaps\Marker;
use Webbingbrasil\FilamentMaps\Widgets\MapWidget;
use Filament\Widgets\Widget;

class Map extends MapWidget
{
    // protected static string $view = 'filament.parent.widgets.map';

    protected int | string | array $columnSpan = 2;
    
    protected bool $hasBorder = false;

    public function getMarkers(): array
    {
        return [
            Marker::make('pos2')->lat(-1.527992)->lng(37.265098)->popup('Hello Machakos!'),
        ];
    }

    public function getActions(): array
    {
        return [
            Actions\ZoomAction::make(),
            Actions\CenterMapAction::make()->zoom(20),
        ];
    }
}

