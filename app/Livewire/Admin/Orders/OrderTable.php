<?php

namespace App\Livewire\Admin\Orders;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Orde;

class OrderTable extends DataTableComponent
{
    protected $model = Orde::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Nº orden", "id")
                ->sortable(),

            Column::make("Tickets")
                ->label(function($row){
                    return view('admin.orders.ticket', ['order' => $row]);
                }),

            Column::make("F. orden", "created_at")
                ->format(function($value){
                    return $value->format('d/m/Y');
                })
                ->sortable(),

            Column::make("total")
                ->format(function($value){
                    return "Bs. " . number_format($value, 2);
                })
                ->sortable(),

            Column::make("cantidad", "content")
                ->format(function($value){
                    return count($value);
                })
                ->sortable(),

            Column::make("estado", "status")
                ->format(function($value){
                    return $value->name;
                })
                ->sortable(),

            Column::make("Actions")
                ->label(function($row){
                    return view('admin.orders.actions', ['order' => $row]);
                })
                
        ];
    }
}
