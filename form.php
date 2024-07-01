<?php

namespace App\Filament\Providers\Resources;

use App\Filament\Providers\Resources\ResourceResource\Pages\ManageResources;
use App\Filament\Resources\ResourceResource\Pages;
use App\Filament\Resources\ResourceResource\RelationManagers;
use App\Models\Resource as ResourceModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResourceResource extends Resource
{
    protected static ?string $model = ResourceModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                      
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()->label(''),

            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ViewAction::make()->label('')->icon('eye-icon')->iconSize('xl')->tooltip('Chi tiết')
                      ->label(false)
                      ->icon('checkmark-icon')//dummy icon name
                      ->iconSize('xl'),
               

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->emptyStateHeading('Chưa có dữ liệu.');
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageResources::route('/'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
    public static function canAccess(): bool
    {
        $routeName='filament.providers.resources.resources.index';
        return checkPermission($routeName);
    }
}
