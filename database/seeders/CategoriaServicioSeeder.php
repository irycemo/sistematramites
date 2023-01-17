<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Seeder;
use App\Models\CategoriaServicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriaServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria = CategoriaServicio::create(['nombre' => 'Certificaciones', 'concepto' => '20501', 'seccion' => '0']);

        $categoria->servicios()->saveMany([
                                    new Servicio([
                                        'nombre' => 'Gravamen o libertad de gravamen hasta por 10 años',
                                        'tipo' => 'fija',
                                        'ordinario' => 229,
                                        'urgente' => 458,
                                        'extra_urgente' => 687,
                                        'operacion_principal' => "2403",
                                        'operacion_parcial' => "0595"
                                    ]),
                                    new Servicio([
                                        'nombre' => 'Gravamen o libertad de gravamen de 10 hasta 20 años',
                                        'tipo' => 'fija',
                                        'ordinario' => 280,
                                        'urgente' => 560,
                                        'extra_urgente' => 840,
                                        'operacion_principal' => "2403",
                                        'operacion_parcial' => "0610"
                                    ]),
                                    new Servicio([
                                        'nombre' => 'Gravamen o libertad de gravamen de más de 20 años',
                                        'tipo' => 'fija',
                                        'ordinario' => 561,
                                        'urgente' => 1122,
                                        'extra_urgente' => 1683,
                                        'operacion_principal' => "2403",
                                        'operacion_parcial' => "0605"
                                    ]),
                                    new Servicio([
                                        'nombre' => 'Exsitencia o inexsitencia de gravamenes o anotaciones preventivas',
                                        'tipo' => 'fija',
                                        'ordinario' => 757,
                                        'urgente' => 1514,
                                        'extra_urgente' => 2271,
                                        'operacion_principal' => "2403",
                                        'operacion_parcial' => "0620"
                                    ]),
                                    new Servicio([
                                        'nombre' => 'Propiedad o negativos de propiedad',
                                        'tipo' => 'fija',
                                        'ordinario' => 229,
                                        'urgente' => 458,
                                        'extra_urgente' => 687,
                                        'operacion_principal' => "2403",
                                        'operacion_parcial' => "0625"
                                    ]),
                                    new Servicio([
                                        'nombre' => 'Propiedad con medidas y linderos',
                                        'tipo' => 'fija',
                                        'ordinario' => 280,
                                        'urgente' => 560,
                                        'extra_urgente' => 840,
                                        'operacion_principal' => "2403",
                                        'operacion_parcial' => "0630"
                                    ]),
                                    new Servicio([
                                        'nombre' => 'Historía registral hasta 5 antecedentes',
                                        'tipo' => 'fija',
                                        'ordinario' => 727,
                                        'operacion_principal' => "2403",
                                        'operacion_parcial' => "0635"
                                    ]),
                                    new Servicio([
                                        'nombre' => 'Historía registral hasta 5 antecedentes, por cada uno adicional',
                                        'tipo' => 'fija',
                                        'ordinario' => 727,
                                        'operacion_principal' => "2403",
                                        'operacion_parcial' => "0640"
                                    ]),
                                    new Servicio([
                                        'nombre' => 'Copias certificadas (por página)',
                                        'tipo' => 'fija',
                                        'ordinario' => 45,
                                        'urgente' => 90,
                                        'extra_urgente' => 135,
                                        'operacion_principal' => "2403",
                                        'operacion_parcial' => "0645"
                                    ]),
                                    new Servicio([
                                        'nombre' => 'Copias simples (por página)',
                                        'tipo' => 'fija',
                                        'ordinario' => 25,
                                        'urgente' => 50,
                                        'extra_urgente' => 75,
                                        'operacion_principal' => "2403",
                                        'operacion_parcial' => "0650"
                                    ]),
                                    new Servicio([
                                        'nombre' => 'Reproducciones certificadas de testimonios de escrituras, hasta por 5 hojas',
                                        'tipo' => 'fija',
                                        'ordinario' => 485,
                                        'operacion_principal' => "2403",
                                        'operacion_parcial' => "0655"
                                    ]),
                                    new Servicio([
                                        'nombre' => 'Reproducciones certificadas de testimonios de escrituras por cada hoja',
                                        'tipo' => 'fija',
                                        'ordinario' => 485,
                                        'operacion_principal' => "2403",
                                        'operacion_parcial' => "0660"
                                    ]),
                                    new Servicio([
                                        'nombre' => 'Aclaraciones adminisrativas de inscripciones por cada una',
                                        'tipo' => 'fija',
                                        'ordinario' => 467,
                                        'operacion_principal' => "2403",
                                        'operacion_parcial' => "0665"
                                    ])
                                ]);

        $categoria = CategoriaServicio::create(['nombre' => 'Comercio', 'concepto' => '20507', 'seccion' => '6']);

        $categoria->servicios()->saveMany([
                                            new Servicio([
                                                'nombre' => 'Escrituras constitutivas',
                                                'tipo' => 'uma',
                                                'umas' => 8,
                                                'ordinario' => 770,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0775"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Actos de emisión de bonos y obligaciones de sociedades mercantiles',
                                                'tipo' => 'uma',
                                                'umas' => 8,
                                                'ordinario' => 770,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Actas en que se haga constar aumento de capital',
                                                'tipo' => 'uma',
                                                'umas' => 8,
                                                'ordinario' => 770,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Inscripción de gravámenes relativos a garantías prendiarias',
                                                'tipo' => 'uma',
                                                'umas' => 8,
                                                'ordinario' => 770,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Cancelaciones de inscripciones de comercio',
                                                'tipo' => '50%',
                                                'ordinario' => 385,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Depósito de balances o inscripciones de los mismos, actas de asambleas de socios o de consejo',
                                                'tipo' => 'fija',
                                                'ordinario' => 324,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Actas de disolución o liquidación de sociedades por cada una de las formas codificadas',
                                                'tipo' => 'fija',
                                                'ordinario' => 324,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Poderes y sustitución de los mismos',
                                                'tipo' => 'fija',
                                                'ordinario' => 517,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0"

                                            ]),
                                            new Servicio([
                                                'nombre' => 'Sentencias sobre emancipación para ejercer el comercio, habilitación de edad, licencia de matrimonio y renovación de la misma',
                                                'tipo' => 'fija',
                                                'ordinario' => 132,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0"

                                            ]),
                                            new Servicio([
                                                'nombre' => 'Incripción y cancelación de contratos de corresponsalias',
                                                'tipo' => 'fija',
                                                'ordinario' => 107,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0"

                                            ]),
                                            new Servicio([
                                                'nombre' => 'Sentencias sobre declaraciones de quiebra o en que se admita la  liquidación judicial',
                                                'tipo' => 'fija',
                                                'ordinario' => 201,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0"

                                            ]),
                                            new Servicio([
                                                'nombre' => 'Actos autorizados por el secretario de gobierno',
                                                'tipo' => 'fija',
                                                'ordinario' => 691,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0"

                                            ]),
                                            new Servicio([
                                                'nombre' => 'Constacia o retificación de documentos y firmas',
                                                'tipo' => 'fija',
                                                'ordinario' => 691,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0"

                                            ]),
                                            new Servicio([
                                                'nombre' => 'Inscripción de otros documentos en el registro de comercio',
                                                'tipo' => 'fija',
                                                'ordinario' => 183,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0"

                                            ]),
                                            new Servicio([
                                                'nombre' => 'Por la historia de las inscripcioines de títulos de comercio, por el término que se solicite y hasta cinco antecedentes',
                                                'tipo' => 'fija',
                                                'ordinario' => 727,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0"

                                            ]),
                                        ]);

        $categoria = CategoriaServicio::create(['nombre' => 'Inscripciones - Propiedad', 'concepto' => '20502', 'seccion' => '1']);

        $categoria->servicios()->saveMany([
                                            new Servicio([
                                                'nombre' => 'Inmuebles rústicos',
                                                'tipo' => 'uma',
                                                'umas' => 5.5,
                                                'ordinario' => 529,
                                                'urgente' => 1058,
                                                'extra_urgente' => 1587,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0675"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Inmuebles urbanos',
                                                'tipo' => 'uma',
                                                'umas' => 16,
                                                'ordinario' => 1540,
                                                'urgente' => 3080,
                                                'extra_urgente' => 4620,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0670"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Habitacional sin exder $878,007.50',
                                                'tipo' => 'uma',
                                                'umas' => 11,
                                                'ordinario' => null,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0680"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Habitacional excediendo $878,007.50',
                                                'tipo' => 'uma',
                                                'umas' => 11,
                                                'ordinario' => null,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0685"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Fusión de predios',
                                                'tipo' => 'fija',
                                                'ordinario' => 462,
                                                'urgente' => 924,
                                                'extra_urgente' => 1386,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0690"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Servidumbres',
                                                'tipo' => 'fija',
                                                'ordinario' => 462,
                                                'urgente' => 924,
                                                'extra_urgente' => 1386,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0695"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Plano habitacional recidencial',
                                                'tipo' => 'fija',
                                                'ordinario' => 76,
                                                'urgente' => 152,
                                                'extra_urgente' => 228,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0720"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Plano habitacional tipo medio',
                                                'tipo' => 'fija',
                                                'ordinario' => 30,
                                                'urgente' => 60,
                                                'extra_urgente' => 90,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0700"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Plano habitacional popular',
                                                'tipo' => 'fija',
                                                'ordinario' => 30,
                                                'urgente' => 60,
                                                'extra_urgente' => 90,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0705"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Plano habitacional campestre',
                                                'tipo' => 'fija',
                                                'ordinario' => 110,
                                                'urgente' => 220,
                                                'extra_urgente' => 330,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0710"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Plano habitacional rústico',
                                                'tipo' => 'fija',
                                                'ordinario' => 76,
                                                'urgente' => 152,
                                                'extra_urgente' => 228,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0715"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Plano industrial y comercial',
                                                'tipo' => 'fija',
                                                'ordinario' => 214,
                                                'urgente' => 428,
                                                'extra_urgente' => 642,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0725"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Propiedad en condominio habitacional',
                                                'tipo' => 'fija',
                                                'ordinario' => 76,
                                                'urgente' => 152,
                                                'extra_urgente' => 228,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0735"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Propiedad en condominio habitacional - local comercial',
                                                'tipo' => 'fija',
                                                'ordinario' => 124,
                                                'urgente' => 248,
                                                'extra_urgente' => 372,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0730"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Subdivisiones',
                                                'tipo' => 'fija',
                                                'ordinario' => 76,
                                                'urgente' => 152,
                                                'extra_urgente' => 228,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "1720"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Ratificación de documentos y firmas ante RPP',
                                                'tipo' => 'fija',
                                                'ordinario' => 229,
                                                'urgente' => 458,
                                                'extra_urgente' => 687,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0770"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Cuando se aporten bienes inmuebles',
                                                'tipo' => 'fija',
                                                'ordinario' => 727,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "1740"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Cuando se aporten bienes distintos',
                                                'tipo' => 'fija',
                                                'ordinario' => 727,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "1745"
                                            ]),
                                        ]);

        $categoria = CategoriaServicio::create(['nombre' => 'Inscripciones - Gravamenes', 'concepto' => '20510', 'seccion' => '2']);

        $categoria->servicios()->saveMany([
                                            new Servicio([
                                                'nombre' => 'Documentos relativos a grvámenes de bienes inmuebles',
                                                'tipo' => 'uma',
                                                'umas' => 16,
                                                'ordinario' => 1540,
                                                'urgente' => 3080,
                                                'extra_urgente' => 4620,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "1750"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Cesión de derechos litigosos de crédito',
                                                'tipo' => 'uma',
                                                'umas' => 16,
                                                'ordinario' => 1540,
                                                'urgente' => 3080,
                                                'extra_urgente' => 4620,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "1755"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'División de hipoteca',
                                                'tipo' => 'uma',
                                                'umas' => 6,
                                                'ordinario' => 577,
                                                'urgente' => 1540,
                                                'extra_urgente' => 1731,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "2140"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Reestructura de créditos o convenios modificatorios',
                                                'tipo' => 'fija',
                                                'ordinario' => 462,
                                                'urgente' => 924,
                                                'extra_urgente' => 1386,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "2145"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Convenio modificatorio donde se reforme cualquier claúsula del contrato',
                                                'tipo' => 'fija',
                                                'ordinario' => 462,
                                                'urgente' => 924,
                                                'extra_urgente' => 1386,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "2145"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Créditos para la adquisición de vivienda de interés social',
                                                'tipo' => 'uma',
                                                'umas' => 8,
                                                'ordinario' => 770,
                                                'urgente' => 1540,
                                                'extra_urgente' => 2310,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "2155"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Créditos para la adquisición de vivienda popular',
                                                'tipo' => 'uma',
                                                'umas' => 10.5,
                                                'ordinario' => 1010,
                                                'urgente' => 2020,
                                                'extra_urgente' => 3030,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "2540"
                                            ]),
                                        ]);

        $categoria = CategoriaServicio::create(['nombre' => 'Cancelación - Gravamenes', 'concepto' => '20510', 'seccion' => '2']);

        $categoria->servicios()->saveMany([
                                            new Servicio([
                                                'nombre' => 'Cancelación de documentos relativos a gravámenes de bienes inmuebles',
                                                'tipo' => '50%',
                                                'ordinario' => 770,
                                                'urgente' => 1540,
                                                'extra_urgente' => 2310,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "1760"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Cancelación de cesión de derechos litigosos de crédito',
                                                'tipo' => '50%',
                                                'ordinario' => 770,
                                                'urgente' => 1540,
                                                'extra_urgente' => 2310,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "1755"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Cancelación de grávamen de división de hipoteca',
                                                'tipo' => '50%',
                                                'ordinario' => 289,
                                                'urgente' => 578,
                                                'extra_urgente' => 867,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "oendiente"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Cancelación de reestructura de créditos garantizados con bienes inmuebles, o convenios modificatorios a los contratos de crédito',
                                                'tipo' => '50%',
                                                'ordinario' => 265,
                                                'urgente' => 530,
                                                'extra_urgente' => 795,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "0725"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Cancelación de convenio modificatorio donde se reforme cualquier claúsula del contrato',
                                                'tipo' => '50%',
                                                'ordinario' => 231,
                                                'urgente' => 462,
                                                'extra_urgente' => 693,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "1760"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Cancelación de créditos para la adquisición de vivienda de interés social',
                                                'tipo' => '50%',
                                                'ordinario' => 385,
                                                'urgente' => 770,
                                                'extra_urgente' => 1155,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "1760"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Cancelación de créditos para la adquisición de vivienda popular',
                                                'tipo' => '50%',
                                                'ordinario' => 505,
                                                'urgente' => 1010,
                                                'extra_urgente' => 1515,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "1760"
                                            ]),
                                        ]);

        $categoria = CategoriaServicio::create(['nombre' => 'Varios , Sentencias, Arrendamientos, Avisos Preventivos', 'concepto' => '20505', 'seccion' => '5']);

        $categoria->servicios()->saveMany([
                                            new Servicio([
                                                'nombre' => 'Por la inscripción de varios',
                                                'tipo' => 'fija',
                                                'ordinario' => 462,
                                                'urgente' => 924,
                                                'extra_urgente' => 1386,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "1765"
                                            ]),
                                            new Servicio([
                                                'nombre' => 'Testimonios notariales, y los avisos preventivos',
                                                'tipo' => 'fija',
                                                'ordinario' => 462,
                                                'urgente' => 924,
                                                'extra_urgente' => 1386,
                                                'operacion_principal' => "2403",
                                                'operacion_parcial' => "1765"

                                            ]),
                                        ]);
    }
}
