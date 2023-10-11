<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone number')
                    ->tel()
                    ->required(),
                Forms\Components\Select::make('group_id')
                    ->relationship('group', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('days')
                            ->label('Select days')
                            ->options([
                                'sat' => 'sat',
                                'sun' => 'sun',
                                'mon' => 'mon',
                                'tue' => 'tue',
                                'wed' => 'wed',
                                'thu' => 'thu',
                                'fri' => 'fri',
                            ])
                            ->multiple()
                            ->required(),
                        Forms\Components\TimePicker::make('start_at')
                            ->required(),
                        Forms\Components\Select::make('grade_id')
                            ->relationship('grade', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->required(),
                        Forms\Components\Select::make('headquarter_id')
                            ->relationship('headquarter', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->required(),
                    ])
                    ->required(),
                Forms\Components\Select::make('grade_id')
                    ->relationship('grade', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->required(),
                Forms\Components\Select::make('parent_id')
                    ->relationship('parent', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone number')
                            ->tel()
                            ->required(),
                    ])
                    ->required(),
                Forms\Components\Checkbox::make('change_group')
                    ->label('Change Group')
                ->columnSpan("full"),
                Forms\Components\Select::make('change_group_id')
                    ->relationship('changeGroup', 'name')
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('changeGroup.name'),
                Tables\Columns\TextColumn::make('group.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('grade.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('parent.name'),

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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
