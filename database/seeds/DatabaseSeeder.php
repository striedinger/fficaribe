<?php

use Illuminate\Database\Seeder;
use HttpOz\Roles\Models\Role;
use \App\State;
use \App\Term;
use \App\User;
use \App\CostCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles
        $adminRole = Role::create([
        	'name' => 'Administrador',
        	'slug' => 'admin'
        ]);

        $asistenteRole = Role::create([
        	'name' => 'Asistente',
        	'slug' => 'asistente'
        ]);

        $evaluadorRole = Role::create([
        	'name' => 'Evaluador',
        	'slug' => 'evaluador'
        ]);

        $empresarioRole = Role::create([
        	'name' => 'Empresario',
        	'slug' => 'empresario'
        ]);

        //States
        State::create(['name' => 'Atlántico']);
        State::create(['name' => 'Bolívar']);
        State::create(['name' => 'Magdalena']);
        State::create(['name' => 'Córdoba']);
        State::create(['name' => 'Sucre']);
        State::create(['name' => 'Cesar']);
        State::create(['name' => 'La Guajira']);
        State::create(['name' => 'San Andrés']);

        //Terms
        Term::create(['name' => 'Fondo del Fomento a la Innovación 2016-I', 'active' => true]);
        Term::create(['name' => 'Fondo del Fomento a la Innovación 2016-II', 'active' => true]);

        //Users
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'phone' => '3004430338',
            'password' => Hash::make('qwerty'),
            'active' => true
        ]);
        $admin->attachRole(1);
        $empresario = User::create([
            'name' => 'Empresario',
            'email' => 'user@email.com',
            'phone' => '3004430338',
            'password' => Hash::make('qwerty'),
            'active' => true
        ]);
        $empresario->attachRole(4);

        //Cost Categories

        CostCategory::create(['name' => 'Costo del personal técnico especializado requerido para el desarrollo del proyecto y cuya participación sea necesaria para la obtención de los resultados.']);
        CostCategory::create(['name' => 'Costo del personal no calificado dedicado exclusivamente al desarrollo del proyecto.']);
        CostCategory::create(['name' => 'Insumos y materiales requeridos para el desarrollo del proyecto, que sean bienes consumibles durante la ejecución del mismo y no constituyan bienes de capital.']);
        CostCategory::create(['name' => 'Pago de servicios tecnológicos para la obtención de: modelos, metodologías, pruebas de laboratorio que sean requeridos para el desarrollo y obtención de resultados previstos por el proyecto, de manera cuantificable y verificable, y que estén claramente relacionados y valorados en el proyecto.']);
        CostCategory::create(['name' => 'Arrendamiento de equipo para investigación y desarrollo tecnológico, así como actividades de control de calidad establecido en las fases del proyecto no disponibles en las instalaciones del ente ejecutor y/o Centro de Formación del SENA. Incluye pago de servicios por alojamiento de programas informáticos (Hosting, Servidores de Aplicaciones ASP). Su ejecución debe ser demostrada a través del contrato correspondiente.']);
        CostCategory::create(['name' => 'Diseño de prototipos que incluyan innovación tecnológica o diseño de dispositivos a equipos de producción existentes, de productos y de procesos que incluyan igualmente innovación (una nueva aplicación) tecnológica con fines de actualización. Será posible el financiamiento del desarrollo de prototipos con recursos del SENA siempre y cuando los mismos al final del proyecto se queden en el SENA; de lo contrario el desarrollo deberá ser financiado con recursos de contrapartida.']);
        CostCategory::create(['name' => 'Acceso a información especializada requerida para el desarrollo y obtención de los resultados previstos por el proyecto, entre ellos acceso a nodos y redes telemáticas especializadas, adquisición de documentos y bibliografía. Estos últimos quedarán en manos del ejecutor y garantizará acceso a los mismos al SENA por un tiempo adicional equivalente al tiempo de duración del proyecto.']);
        CostCategory::create(['name' => 'Gastos de patentamiento de los resultados del proyecto o registro de propiedad industrial nacional.']);
        CostCategory::create(['name' => 'Gastos de normalización, certificación, registro y similares, provenientes de la certificación de normas técnicas especializadas de producto.']);
        CostCategory::create(['name' => 'Publicaciones de resultados del programa o proyecto, impresos o digitales.']);
        CostCategory::create(['name' => 'Gastos de administración del proyecto, entendidos como costos indirectos necesarios para la ejecución del proyecto, tales como soporte contable, administrativo, logístico, por los que se reconocerá hasta un diez por ciento (10%) del valor total del proyecto, lo cual deberá estar justificado en su formulación.']);
        CostCategory::create(['name' => 'Transferencia de tecnología al SENA, la cual contempla estrictamente los costos asociados a las actividades producto del desarrollo de la ejecución del proyecto y que beneficien la formación y en general la actividad misional de la Entidad. El valor de este rubro debe corresponder como mínimo al 3% del valor del proyecto, y el SENA podrá cofinanciar máximo hasta la mitad de dicho valor.']);
        CostCategory::create(['name' => 'Rubros presupuestales financiables, los impuestos, tasas, contribuciones y gravámenes que se causen por la adquisición de bienes muebles y servicios, necesarios para la ejecución del proyecto, incluido el gravamen a los movimientos financieros, cada uno de ellos con cargo a la fuente de recursos con que se financie el gasto o adquisición que los genere.']);
        CostCategory::create(['name' => 'Inversiones en plantas de producción y/o adecuaciones de infraestructura, requeridas para la ejecución del proyecto. Se podrá incluir el uso de equipos disponibles en las instalaciones del proponente, necesarios para el desarrollo y obtención de los resultados del proyecto, justamente valorados e identificados directamente con la naturaleza del proyecto.']);
        CostCategory::create(['name' => 'Adquisición de equipos y de software necesarios para el desarrollo y obtención de los resultados del proyecto, los cuales deberán identificarse directamente con la naturaleza del mismo.']);
        CostCategory::create(['name' => 'Viáticos y pasajes del personal de las entidades ejecutoras en el desarrollo del proyecto, exclusivamente para aquellos desplazamientos que se requieran para el desarrollo del proyecto o para cumplimiento de los resultados del mismo, y que se realicen durante su desarrollo.']);
        CostCategory::create(['name' => 'Pólizas del convenio a suscribir.']);
        CostCategory::create(['name' => 'Aportes parafiscales y aportes al Sistema General de Seguridad Social del personal dedicado al proyecto.']);

    }
}
