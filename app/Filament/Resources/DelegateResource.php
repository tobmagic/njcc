<?php

namespace App\Filament\Resources;

use App\Models\Delegate;
use App\Filament\Resources\DelegateResource\Pages;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class DelegateResource extends Resource
{
    protected static ?string $model = Delegate::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Management';

    /**
     * The Form (For Creating/Editing)
     */
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Section::make('Delegate Details')->schema([
                Forms\Components\TextInput::make('full_name')->disabled(),
                Forms\Components\TextInput::make('email')->disabled(),
                Forms\Components\TextInput::make('phone')->disabled(),
                Forms\Components\TextInput::make('company_name')->disabled(),
                Forms\Components\TextInput::make('job_title')
                    ->label('Position/Title')
                    ->disabled(),
                Forms\Components\TextInput::make('program_name')->disabled(),
            ])->columns(2),

            Forms\Components\Section::make('Addresses & Products')->schema([
                Forms\Components\Textarea::make('organization_address')->disabled(),
                Forms\Components\Textarea::make('residential_address')->disabled(),
                Forms\Components\Textarea::make('business_products')
                    ->label('Business Products/Services')
                    ->disabled(),
            ])->columns(1),

            Forms\Components\Section::make('Admin Action')->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'verified' => 'Verified/Paid',
                        'rejected' => 'Rejected',
                    ])->required(),
                Forms\Components\Textarea::make('admin_notes'),
            ]),

            Forms\Components\Section::make('Payment Evidence')->schema([
                Forms\Components\FileUpload::make('payment_proof')
                    ->disk('public')
                    ->directory('proofs')
                    ->openable()
                    ->downloadable(),
            ]),
        ]);
    }

    /**
     * The Infolist (For Viewing)
     */
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Registration Details')
                    ->schema([
                        Infolists\Components\TextEntry::make('full_name'),
                        Infolists\Components\TextEntry::make('email'),
                        Infolists\Components\TextEntry::make('phone'),
                        Infolists\Components\TextEntry::make('program_name')->weight('bold'),
                        Infolists\Components\TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'verified' => 'success',
                                'rejected' => 'danger',
                            }),
                    ])->columns(2),

                Infolists\Components\Grid::make(2)
                    ->schema([
                        Infolists\Components\Group::make([
                            Infolists\Components\Section::make('Business Information')
                                ->schema([
                                    Infolists\Components\TextEntry::make('company_name'),
                                    Infolists\Components\TextEntry::make('job_title')->label('Position'),
                                    Infolists\Components\TextEntry::make('organization_address'),
                                    Infolists\Components\TextEntry::make('business_products')->label('Products/Services'),
                                ]),
                            Infolists\Components\Section::make('Home Information')
                                ->schema([
                                    Infolists\Components\TextEntry::make('residential_address'),
                                ]),
                        ]),
                        Infolists\Components\Group::make([
                            Infolists\Components\Section::make('Payment Receipt')
                                ->schema([
                                    Infolists\Components\ImageEntry::make('payment_proof')
                                        ->disk('public')
                                        ->size(400) // Makes it clearly visible
                                        ->extraAttributes(['class' => 'rounded-lg border']),
                                ]),
                            Infolists\Components\Section::make('Internal Admin Notes')
                                ->schema([
                                    Infolists\Components\TextEntry::make('admin_notes')->placeholder('No notes yet.'),
                                ]),
                        ]),
                    ]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('full_name')->searchable(),
            Tables\Columns\TextColumn::make('program_name')->sortable(),
            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'warning' => 'pending',
                    'success' => 'verified',
                    'danger' => 'rejected',
                ]),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Reg Date'),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(), 
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(), 
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDelegates::route('/'),
            'create' => Pages\CreateDelegate::route('/create'),
            'view' => Pages\ViewDelegate::route('/{record}'),
            'edit' => Pages\EditDelegate::route('/{record}/edit'),
        ];
    }
}