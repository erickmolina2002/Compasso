<?php

namespace App\Filament\Resources\MedicalAppointmentResource\Pages;

use App\Filament\Resources\MedicalAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicalAppointment extends EditRecord
{
    protected static string $resource = MedicalAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
