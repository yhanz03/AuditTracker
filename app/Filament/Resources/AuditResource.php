<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Audit;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AuditResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AuditResource\RelationManagers;

class AuditResource extends Resource
{
    protected static ?string $model = Audit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('link')->required(),
                Select::make('type')
                    ->options([
                        'Identity' => 'Identity',
                        'Document' => 'Document',
                        'Lien Filing' => 'Lien Filing',
                        'Lien Audit' => 'Lien Audit',
                        'Lien Termination' => 'Lien Termination',
                        'Lien Reflection' => 'Lien Reflection',
                    ]),
                Select::make('status')
                    ->options([
                        'Completed' => 'Completed',
                        'Pending' => 'Pending',
                    ]),
                Select::make('resolution')
                    ->options([
                        'Record Found' => 'Record Found',
                        'No Record Found' => 'No Record Found',
                        'Doc Found' => 'Doc Found',
                        'No Doc Found' => 'No Doc Found',
                        'Pending Doc' => 'Pending Doc',
                        'Lien Found' => 'Lien Found',
                        'No Lien Found' => 'No Lien Found',
                        'Pending Lien' => 'Pending Lien',
                        'Lien Filed' => 'Lien Filed',
                        'Pending: LFT' => 'Pending: LFT',
                        'SOS Error' => 'SOS Error',
                        'DQI' => 'DQI',
                        'UCC1 Uploaded' => 'UCC1 Uploaded',
                    ]),
                Forms\Components\TextInput::make('ninja')
                    ->required()
                    ->default(\Illuminate\Support\Facades\Auth::user()->name),

                // Forms\Components\TextInput::make('content')->required()
                // Forms\Components\TextInput::make('content')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('shiftdate'),
                Tables\Columns\TextColumn::make('link')
                    ->color('primary')
                    ->copyable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Completed'  => 'success',
                        'Pending' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('resolution'),
                Tables\Columns\TextColumn::make('ninja')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('start'),
                Tables\Columns\TextColumn::make('end')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tat'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAudits::route('/'),
            'create' => Pages\CreateAudit::route('/create'),
            'edit' => Pages\EditAudit::route('/{record}/edit'),
        ];
    }
}
