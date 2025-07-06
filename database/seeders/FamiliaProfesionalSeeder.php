<?php

namespace Database\Seeders;

use App\Models\FamiliaProfesional;
use Illuminate\Database\Seeder;

class FamiliaProfesionalSeeder extends Seeder
{
    public function run(): void
    {

        foreach (self::$familias_profesionales as $familiaProfesional) {
            FamiliaProfesional::create($familiaProfesional);
        }
    }

        public static $familias_profesionales = array(
        array(
            'codigo' => 'ADG',
            'nombre' => 'ADMINISTRACIÓN Y GESTIÓN',
            'descripcion' => 'Formación en gestión empresarial, administración de recursos, contabilidad, recursos humanos y organización de entidades públicas y privadas.'
        ),
        array(
            'codigo' => 'AFD',
            'nombre' => 'ACTIVIDADES FÍSICAS Y DEPORTIVAS',
            'descripcion' => 'Preparación de profesionales en educación física, entrenamiento deportivo, fitness, actividades en la naturaleza y gestión de instalaciones deportivas.'
        ),
        array(
            'codigo' => 'AGA',
            'nombre' => 'AGRARIA',
            'descripcion' => 'Formación en producción agrícola, ganadera, forestal, jardinería, paisajismo y gestión sostenible de recursos naturales del sector primario.'
        ),
        array(
            'codigo' => 'ARA',
            'nombre' => 'ARTES Y ARTESANÍAS',
            'descripcion' => 'Desarrollo de habilidades en técnicas artísticas tradicionales, artesanía, cerámica, orfebrería, textil artístico y conservación del patrimonio cultural.'
        ),
        array(
            'codigo' => 'ARG',
            'nombre' => 'ARTES GRÁFICAS',
            'descripcion' => 'Formación en diseño gráfico, preimpresión, impresión, postimpresión, serigrafía, encuadernación y producción editorial en medios digitales e impresos.'
        ),
        array(
            'codigo' => 'COM',
            'nombre' => 'COMERCIO Y MARKETING',
            'descripcion' => 'Preparación en técnicas de venta, marketing digital, gestión comercial, atención al cliente, comercio electrónico y estrategias de comunicación comercial.'
        ),
        array(
            'codigo' => 'ELE',
            'nombre' => 'ELECTRICIDAD Y ELECTRÓNICA',
            'descripcion' => 'Formación en instalaciones eléctricas, sistemas electrónicos, automatismos industriales, energías renovables y mantenimiento de equipos electrotécnicos.'
        ),
        array(
            'codigo' => 'ENA',
            'nombre' => 'ENERGÍA Y AGUA',
            'descripcion' => 'Especialización en gestión de recursos hídricos, energías renovables, eficiencia energética, tratamiento de aguas y sistemas de distribución.'
        ),
        array(
            'codigo' => 'EOC',
            'nombre' => 'EDIFICACIÓN Y OBRA CIVIL',
            'descripcion' => 'Formación en construcción, proyectos de edificación, topografía, control de calidad en obras, gestión urbanística y desarrollo de infraestructuras.'
        ),
        array(
            'codigo' => 'FME',
            'nombre' => 'FABRICACIÓN MECÁNICA',
            'descripcion' => 'Preparación en mecanizado, soldadura, conformado, diseño mecánico, automatización industrial y control de calidad en procesos manufactureros.'
        ),
        array(
            'codigo' => 'HOT',
            'nombre' => 'HOSTELERÍA Y TURISMO',
            'descripcion' => 'Formación en servicios de restauración, gestión hotelera, cocina, servicios turísticos, eventos y atención al cliente en el sector servicios.'
        ),
        array(
            'codigo' => 'IEX',
            'nombre' => 'INDUSTRIAS EXTRACTIVAS',
            'descripcion' => 'Especialización en minería, canteras, sondeos, prospección geológica, explosivos y técnicas de extracción de recursos minerales.'
        ),
        array(
            'codigo' => 'IFC',
            'nombre' => 'INFORMÁTICA Y COMUNICACIONES',
            'descripcion' => 'Formación en desarrollo de software, administración de sistemas, redes informáticas, ciberseguridad, bases de datos y tecnologías emergentes.'
        ),
        array(
            'codigo' => 'IMA',
            'nombre' => 'INSTALACIÓN Y MANTENIMIENTO',
            'descripcion' => 'Preparación en mantenimiento industrial, instalaciones térmicas, frigoríficas, climatización y mantenimiento de equipos industriales.'
        ),
        array(
            'codigo' => 'IMP',
            'nombre' => 'IMAGEN PERSONAL',
            'descripcion' => 'Formación en peluquería, estética, caracterización, asesoría de imagen y técnicas de embellecimiento personal y corporal.'
        ),
        array(
            'codigo' => 'IMS',
            'nombre' => 'IMAGEN Y SONIDO',
            'descripcion' => 'Especialización en producción audiovisual, sonido, iluminación, realización de programas, postproducción y tecnologías multimedia.'
        ),
        array(
            'codigo' => 'INA',
            'nombre' => 'INDUSTRIAS ALIMENTARIAS',
            'descripcion' => 'Formación en procesado de alimentos, control de calidad alimentaria, seguridad alimentaria, tecnología de conservación y producción industrial.'
        ),
        array(
            'codigo' => 'MAM',
            'nombre' => 'MADERA, MUEBLE Y CORCHO',
            'descripcion' => 'Preparación en carpintería, ebanistería, diseño de muebles, instalación de elementos de carpintería y aprovechamiento forestal.'
        ),
        array(
            'codigo' => 'MAP',
            'nombre' => 'MARÍTIMO-PESQUERA',
            'descripcion' => 'Formación en navegación, pesca, acuicultura, cultivos marinos, transporte marítimo y mantenimiento de embarcaciones.'
        ),
        array(
            'codigo' => 'QUI',
            'nombre' => 'QUÍMICA',
            'descripcion' => 'Especialización en análisis químico, procesos químicos industriales, control de calidad, laboratorio y gestión de residuos químicos.'
        ),
        array(
            'codigo' => 'SAN',
            'nombre' => 'SANIDAD',
            'descripcion' => 'Formación en cuidados auxiliares de enfermería, emergencias sanitarias, prótesis dentales, farmacia y asistencia sanitaria.'
        ),
        array(
            'codigo' => 'SEA',
            'nombre' => 'SEGURIDAD Y MEDIO AMBIENTE',
            'descripcion' => 'Preparación en prevención de riesgos laborales, gestión ambiental, emergencias, seguridad privada y educación ambiental.'
        ),
        array(
            'codigo' => 'SSC',
            'nombre' => 'SERVICIOS SOCIOCULTURALES Y A LA COMUNIDAD',
            'descripcion' => 'Formación en educación infantil, integración social, interpretación de lengua de signos, mediación comunicativa y animación sociocultural.'
        ),
        array(
            'codigo' => 'TCP',
            'nombre' => 'TEXTIL, CONFECCIÓN Y PIEL',
            'descripcion' => 'Especialización en diseño textil, confección industrial, patronaje, curtidos, calzado y complementos de moda.'
        ),
        array(
            'codigo' => 'TMV',
            'nombre' => 'TRANSPORTE Y MANTENIMIENTO DE VEHÍCULOS',
            'descripcion' => 'Formación en mecánica automotriz, carrocería, electromecánica de vehículos, sistemas de propulsión y mantenimiento de flotas.'
        ),
        array(
            'codigo' => 'VIC',
            'nombre' => 'VIDRIO Y CERÁMICA',
            'descripcion' => 'Preparación en técnicas de transformación del vidrio, cerámica artística e industrial, moldeado y decoración de materiales cerámicos.'
        )
    );
}
