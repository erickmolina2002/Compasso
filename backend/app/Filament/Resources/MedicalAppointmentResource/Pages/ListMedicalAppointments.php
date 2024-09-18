<?php

namespace App\Filament\Resources\MedicalAppointmentResource\Pages;

use App\Filament\Resources\MedicalAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicalAppointments extends ListRecords
{
    protected static string $resource = MedicalAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
