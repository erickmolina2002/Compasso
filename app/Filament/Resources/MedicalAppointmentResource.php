<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalAppointmentResource\Pages;
use App\Models\MedicalAppointment;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\AppointmentStatusEnum;
use Filament\Tables\Filters\Filter;
use Carbon\Carbon;

class MedicalAppointmentResource extends Resource
{
    protected static ?string $model = MedicalAppointment::class;
    protected static ?string $navigationGroup = 'Consultas';
    protected static ?string $label = 'Consulta Agendada';
    protected static ?string $pluralLabel = 'Consultas Agendadas';
    protected static ?string $navigationIcon = 'heroicon-o-calendar';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Paciente')
                    ->required()
                    ->searchable()
                    ->getSearchResultsUsing(function (string $query) {
                        return \App\Models\User::where('id', 'like', "%{$query}%")
                            ->orWhere('name', 'like', "%{$query}%")
                            ->limit(50)
                            ->get()
                            ->mapWithKeys(function ($user) {
                                return [$user->id => "{$user->id} - {$user->name}"];
                            });
                    })
                    ->getOptionLabelUsing(function ($value) {
                        $user = \App\Models\User::find($value);
                        return $user ? "{$user->id} - {$user->name}" : null;
                    }),

                Forms\Components\TextInput::make('doctor')
                    ->label('Médico')
                    ->maxLength(120)
                    ->required(),

                Forms\Components\DateTimePicker::make('date')
                    ->label('Data da Consulta')
                    ->required(),

                Forms\Components\TextInput::make('reason')
                    ->label('Motivo da Consulta')
                    ->maxLength(255)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Paciente')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($state, $record) {
                        return "{$record->user_id} - {$state}";
                    }),

                Tables\Columns\TextColumn::make('doctor')
                    ->label('Médico')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('date')
                    ->label('Data da Consulta')
                    ->dateTime('d/m/Y - H:i:s')
                    ->sortable(),

                Tables\Columns\TextColumn::make('reason')
                    ->label('Motivo da Consulta')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        return AppointmentStatusEnum::getStatusLabel($state);
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filtro por nome e ID de paciente
                Filter::make('Paciente')
                    ->form([
                        Forms\Components\TextInput::make('user_id')
                            ->label('ID do Paciente')
                            ->numeric(),
                        Forms\Components\TextInput::make('user_name')
                            ->label('Nome do Paciente')
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when($data['user_id'], function (Builder $query, $id) {
                            $query->where('user_id', $id);
                        })->when($data['user_name'], function (Builder $query, $name) {
                            $query->whereHas('user', function (Builder $query) use ($name) {
                                $query->where('name', 'like', "%{$name}%");
                            });
                        });
                    }),

                Filter::make('Data da Consulta')
                    ->form([
                        Forms\Components\DatePicker::make('date')
                            ->label('Data da Consulta')
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when($data['date'], function (Builder $query, $date) {
                            $query->whereDate('date', $date);
                        });
                    }),

                Filter::make('Médico')
                    ->form([
                        Forms\Components\TextInput::make('doctor')
                            ->label('Nome do Médico')
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when($data['doctor'], function (Builder $query, $doctor) {
                            $query->where('doctor', 'like', "%{$doctor}%");
                        });
                    }),
            ])
            ->defaultSort('date', 'desc') // Ordena por data de consulta
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Relacionamentos adicionais podem ser definidos aqui
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedicalAppointments::route('/'),
            'create' => Pages\CreateMedicalAppointment::route('/create'),
            'edit' => Pages\EditMedicalAppointment::route('/{record}/edit'),
        ];
    }

//    public static function getEloquentQuery(): Builder
//    {
//        return parent::getEloquentQuery()
//            ->whereDate('date', Carbon::today());
//    }
}
