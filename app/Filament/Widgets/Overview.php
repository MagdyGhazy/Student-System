<?php

namespace App\Filament\Widgets;

use App\Models\Expenses;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Headquarter;
use App\Models\Quiz;
use App\Models\Student;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Overview extends BaseWidget
{
    protected function getStats(): array
    {
        $currentMonth = Carbon::now()->format('m');

        return [
            Stat::make('الطلاب اللي دفعوا المصاريف',Expenses::query()->where('month', $currentMonth)->count()),
            Stat::make('الطلاب',Student::count()),
            Stat::make('الاختبارات',Quiz::count()),
            Stat::make('مجموعات',Group::count()),
            Stat::make('المراحل الدراسية',Grade::count()),
            Stat::make('الافرع',Headquarter::count()),
        ];
    }
}
