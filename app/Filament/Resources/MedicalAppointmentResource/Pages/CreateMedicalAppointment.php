<?php

namespace App\Filament\Resources\MedicalAppointmentResource\Pages;

use App\Filament\Resources\MedicalAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMedicalAppointment extends CreateRecord
{
    protected static string $resource = MedicalAppointmentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
