<?php

namespace Database\Factories;

use App\Http\Constantes;
use App\Models\Servicio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tramite>
 */
class TramiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $servicio_id = Servicio::inRandomOrder()->first();
        $solicitante = $this->faker->randomElement(Constantes::SOLICITANTES, 1);

        return [
            'estado' => $this->faker->randomElement(['nuevo', 'pagado', 'recibido', 'revision','procesando', 'finalizado', 'expirado']),
            'id_servicio' => $servicio_id->id,
            'solicitante' => $solicitante,
            'nombre_solicitante' => in_array($solicitante, ["Ventanilla", "Juzgado"]) ? $this->faker->name() : null,
            'tomo' => $this->faker->randomNumber(4),
            'tomo_bis' => $this->faker->boolean(),
            'folio_real' => $this->faker->randomNumber(4),
            'registro' => $this->faker->randomNumber(4),
            'registro_bis' => $this->faker->boolean(),
            'numero_propiedad' => $this->faker->randomNumber(4),
            'distrito' => $this->faker->numberBetween(1,19),
            'seccion' => $this->faker->randomElement(Constantes::SECCIONES, 1),
            'fecha_entrega' => now(),
            'monto' => $this->faker->randomFloat(2,126,500),
            'tipo_servicio' => $this->faker->randomElement(['Ordinario', 'Urgente', 'ExtraUrgente'], 1),
            'numero_control' => $this->faker->unique()->randomNumber(),
            'numero_escritura' => $this->faker->randomNumber(4),
            'numero_notaria' => $this->faker->randomNumber(3),
            'limite_de_pago' => now()->addDays(10),
            'linea_de_captura' => 12414232352345432532,
            'orden_de_pago' => 12414232352345432532,

        ];
    }
}
