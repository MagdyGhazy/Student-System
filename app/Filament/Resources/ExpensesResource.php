<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpensesResource\Pages;
use App\Filament\Resources\ExpensesResource\RelationManagers;
use App\Models\Expenses;
use App\Models\Student;
use App\Models\StudentExpenses;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpensesResource extends Resource
{
    protected static ?string $model = Expenses::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make("amount")
                    ->numeric()
                    ->extraAttributes([
                        "step" => "0.01"
                    ])
                    ->required(),
                Forms\Components\DateTimePicker::make('day')
                    ->maxDate(now()->addDay())
                    ->required(),
                Forms\Components\Select::make('month')
                    ->label('Select month')
                    ->options([
                        'Jan' => 'Jan',
                        'Feb' => 'Feb',
                        'Mar' => 'Mar',
                        'Apr' => 'Apr',
                        'May' => 'May',
                        'Jun' => 'Jun',
                        'Jul' => 'Jul',
                        'Aug' => 'Aug',
                        'Sep' => 'Sep',
                        'Oct' => 'Oct',
                        'Nov' => 'Nov',
                        'Dec' => 'Dec',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('day')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('month')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpenses::route('/create'),
            'edit' => Pages\EditExpenses::route('/{record}/edit'),
        ];
    }
}
