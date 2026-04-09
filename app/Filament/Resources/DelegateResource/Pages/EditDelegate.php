<?php

namespace App\Filament\Resources\DelegateResource\Pages;

use App\Filament\Resources\DelegateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDelegate extends EditRecord
{
    protected static string $resource = DelegateResource::class;



    protected function getHeaderActions(): array
{
    return [
        \Filament\Actions\ViewAction::make(),
        \Filament\Actions\DeleteAction::make(), 
    ];
}
}
