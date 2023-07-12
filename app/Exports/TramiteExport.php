<?php

namespace App\Exports;

use App\Models\Tramite;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class TramiteExport implements FromCollection,  WithProperties, WithDrawings, ShouldAutoSize, WithEvents, WithCustomStartCell, WithColumnWidths, WithHeadings, WithMapping
{

    public $servicio_id;
    public $usuario_id;
    public $tipo_servicio;
    public $solicitante;
    public $estado;
    public $fecha1;
    public $fecha2;


    public function __construct($estado, $servicio, $usuario, $tipo_servicio, $solicitante, $fecha1, $fecha2)
    {
        $this->servicio_id = $servicio;
        $this->usuario_id = $usuario;
        $this->tipo_servicio = $tipo_servicio;
        $this->solicitante = $solicitante;
        $this->estado = $estado;
        $this->fecha1 = $fecha1;
        $this->fecha2 = $fecha2;

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tramite::with('servicio', 'creadoPor', 'actualizadoPor')
                        ->when(isset($this->servicio_id) && $this->servicio_id != "", function($q){
                            return $q->where('id_servicio', $this->servicio_id);
                        })
                        ->when(isset($this->usuario_id) && $this->usuario_id != "", function($q){
                            return $q->where('creado_por', $this->usuario_id);
                        })
                        ->when(isset($this->estado) && $this->estado != "", function($q){
                            return $q->where('estado', $this->estado);
                        })
                        ->when(isset($this->tipo_servicio) && $this->tipo_servicio != "", function($q){
                            return $q->where('tipo_servicio', $this->tipo_servicio);
                        })
                        ->when(isset($this->solicitante) && $this->solicitante != "", function($q){
                            return $q->where('solicitante', $this->solicitante);
                        })
                        ->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59'])
                        ->get();
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath(storage_path('app/public/img/logo2.png'));
        $drawing->setHeight(90);
        $drawing->setOffsetX(10);
        $drawing->setOffsetY(10);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function headings(): array
    {
        return [
            'Número de control',
            'Estado',
            'Servicio',
            'Solicitante',
            'Folio real',
            'Tomo',
            'Registro',
            'Monto',
            'Tipo de servicio',
            'Número de oficio',
            'Tomo gravamen',
            'Registro gravamen',
            'Distrito',
            'Sección',
            'Número de paginas',
            'Número de inmuebles',
            'Número de escritura',
            'Notaria',
            'Valor de la propiedad',
            'Fecha de entrega',
            'Fecha de pago',
            'Documento de pago',
            'Linea de captura',
            'Movimiento registral',
            'Observaciones',
            'Registrado por',
            'Registrado en',
            'Actualizado por',
            'Actualizado en',
        ];
    }

    public function map($tramite): array
    {
        return [
            $tramite->numero_control,
            $tramite->estado,
            $tramite->servicio->nombre,
            $tramite->solicitante . ' / ' . $tramite->nombre_solicitante,
            $tramite->folio_real ?? 'N/A',
            $tramite->tomo ?? 'N/A',
            $tramite->registro ?? 'N/A',
            $tramite->monto,
            $tramite->tipo_servicio,
            $tramite->numero_oficio ?? 'N/A',
            $tramite->tomo_gravamen ?? 'N/A',
            $tramite->registro_gravamen ?? 'N/A',
            $tramite->distrito,
            $tramite->seccion,
            $tramite->numero_paginas ?? 'N/A',
            $tramite->numero_inmuebles ?? 'N/A',
            $tramite->numero_escritura ?? 'N/A',
            $tramite->numero_notaria . $tramite->nombre_notario ?? '',
            $tramite->valor_propiedad ?? 'N/A',
            $tramite->fecha_entrega ?? 'N/A',
            $tramite->fecha_pago ?? 'N/A',
            $tramite->documento_de_pago ?? 'N/A',
            $tramite->linea_de_captura,
            $tramite->movimiento_registral ?? 'N/A',
            $tramite->observaciones ?? 'N/A',
            $tramite->creadoPor->name,
            $tramite->created_at,
            $tramite->actualizadoPor->name ?? 'N/A',
            $tramite->updated_at,
        ];
    }

    public function properties(): array
    {
        return [
            'creator'        => auth()->user()->name,
            'title'          => 'Reporte de Faltas (Sistema de Gestión Personal)',
            'company'        => 'Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->mergeCells('A1:Z1');
                $event->sheet->setCellValue('A1', "Instituto Registral Y Catastral Del Estado De Michoacán De Ocampo\nReporte de trámites (Sistema Trámites)\n" . now()->format('d-m-Y'));
                $event->sheet->getStyle('A1')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A1:Z1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 13
                    ],
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    ],
                ]);
                $event->sheet->getRowDimension('1')->setRowHeight(90);
                $event->sheet->getStyle('A2:Z2')->applyFromArray([
                        'font' => [
                            'bold' => true
                        ]
                    ]
                );
            },
        ];
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function columnWidths(): array
    {
        return [
            'E' => 20,
            'F' => 20,

        ];
    }

}
