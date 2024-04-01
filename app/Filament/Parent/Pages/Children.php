<?php

namespace App\Filament\Parent\Pages;

use App\Models\Student;
use App\Models\Theparent;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class Children extends Page implements HasForms,HasTable
{

    use InteractsWithForms,InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    public $parent_id;
    protected static string $view = 'filament.parent.pages.children';
    public function mount(){
        $parent = Theparent::where('name',auth()->user()->name)->first();
        $this->parent_id = $parent->id;
    }
    public function table(Table $table): Table
    {
        
        return $table->query(Student::where('parent_id',$this->parent_id))->columns([
            TextColumn::make('created_at')->date()->size('sm'),
            TextColumn::make('name')->size('sm'),
            // TextColumn::make('fingerprint_pattern')->size('sm')->formatStateUsing(fn ($state) => Str::mask($state, '*', 2)),
            TextColumn::make('class')->size('sm')->searchable()->sortable(),
        ]);
    }
}
