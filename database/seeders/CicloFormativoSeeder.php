<?php

namespace Database\Seeders;

use App\Models\CicloFormativo;
use App\Models\FamiliaProfesional;
use Illuminate\Database\Seeder;

class CicloFormativoSeeder extends Seeder
{
    public function run(): void
    {
        $familiasProfesionalesIds = FamiliaProfesional::pluck('id', 'codigo')->toArray();
        foreach (self::$ciclos_formativos as $cicloFormativo) {
            $cicloFormativo['familia_profesional_id'] = $familiasProfesionalesIds[$cicloFormativo['codigo_familia']];
            unset($cicloFormativo['codigo_familia']);
            CicloFormativo::create($cicloFormativo);
        }
    }

    public static $ciclos_formativos = array(
        // ACTIVIDADES FÍSICAS Y DEPORTIVAS (AFD)
        array(
            'codigo_familia' => 'AFD',
            'grado' => 'medio',
            'codigo' => 'ACEC2',
            'nombre' => 'Técnico en Actividades Ecuestres',
            'descripcion' => 'Formación en cuidado, manejo y entrenamiento de caballos, así como en actividades ecuestres deportivas y terapéuticas.'
        ),
        array(
            'codigo_familia' => 'AFD',
            'grado' => 'superior',
            'codigo' => 'ACFI3',
            'nombre' => 'Técnico Superior en Acondicionamiento Físico',
            'descripcion' => 'Especialización en diseño y supervisión de programas de entrenamiento físico, fitness y readaptación funcional.'
        ),
        array(
            'codigo_familia' => 'AFD',
            'grado' => 'basico',
            'codigo' => 'ACID1',
            'nombre' => 'Profesional Básico en Acceso y Conservación en Instalaciones Deportivas',
            'descripcion' => 'Formación básica en mantenimiento y conservación de espacios e instalaciones deportivas.'
        ),
        array(
            'codigo_familia' => 'AFD',
            'grado' => 'superior',
            'codigo' => 'EASO3',
            'nombre' => 'Técnico Superior en Enseñanza y Animación Sociodeportiva',
            'descripcion' => 'Capacitación para la enseñanza de actividades físico-deportivas y la organización de eventos deportivos recreativos.'
        ),
        array(
            'codigo_familia' => 'AFD',
            'grado' => 'medio',
            'codigo' => 'GMTL2',
            'nombre' => 'Técnico en Guía en el Medio Natural y de Tiempo Libre',
            'descripcion' => 'Formación en conducción de grupos en actividades de senderismo, orientación y deportes en la naturaleza.'
        ),

        // ADMINISTRACIÓN Y GESTIÓN (ADG)
        array(
            'codigo_familia' => 'ADG',
            'grado' => 'superior',
            'codigo' => 'ADFI3',
            'nombre' => 'Técnico Superior en Administración y Finanzas',
            'descripcion' => 'Especialización en gestión contable, financiera, fiscal y administrativa de empresas y organizaciones.'
        ),
        array(
            'codigo_familia' => 'ADG',
            'grado' => 'superior',
            'codigo' => 'ASDI3',
            'nombre' => 'Técnico Superior en Asistencia a la Dirección',
            'descripcion' => 'Formación en apoyo ejecutivo, organización de eventos, comunicación empresarial y gestión de agendas directivas.'
        ),
        array(
            'codigo_familia' => 'ADG',
            'grado' => 'medio',
            'codigo' => 'GADM2',
            'nombre' => 'Técnico en Gestión Administrativa',
            'descripcion' => 'Capacitación en tareas administrativas, atención al cliente, archivo, facturación y trámites burocráticos.'
        ),
        array(
            'codigo_familia' => 'ADG',
            'grado' => 'basico',
            'codigo' => 'INOF1',
            'nombre' => 'Profesional Básico en Informática de Oficina',
            'descripcion' => 'Formación básica en aplicaciones ofimáticas, tratamiento de datos y soporte informático básico.'
        ),
        array(
            'codigo_familia' => 'ADG',
            'grado' => 'basico',
            'codigo' => 'SEAD1',
            'nombre' => 'Profesional Básico en Servicios Administrativos',
            'descripcion' => 'Capacitación básica en operaciones administrativas simples y atención al público.'
        ),

        // AGRARIA (AGA)
        array(
            'codigo_familia' => 'AGA',
            'grado' => 'basico',
            'codigo' => 'ACAG1',
            'nombre' => 'Profesional Básico en Actividades Agropecuarias',
            'descripcion' => 'Formación básica en cuidado de animales de granja y cultivos agrícolas elementales.'
        ),
        array(
            'codigo_familia' => 'AGA',
            'grado' => 'medio',
            'codigo' => 'ACMN2',
            'nombre' => 'Técnico en Aprovechamiento y Conservación del Medio Natural',
            'descripcion' => 'Especialización en conservación de espacios naturales, repoblación forestal y gestión de fauna.'
        ),
        array(
            'codigo_familia' => 'AGA',
            'grado' => 'basico',
            'codigo' => 'AGCO1',
            'nombre' => 'Profesional Básico en Agro-jardinería y Composiciones Florales',
            'descripcion' => 'Formación básica en jardinería, floristería y mantenimiento de espacios verdes.'
        ),
        array(
            'codigo_familia' => 'AGA',
            'grado' => 'basico',
            'codigo' => 'APFO1',
            'nombre' => 'Profesional Básico en Aprovechamientos Forestales',
            'descripcion' => 'Capacitación básica en trabajos forestales, corta y manipulación de madera.'
        ),
        array(
            'codigo_familia' => 'AGA',
            'grado' => 'superior',
            'codigo' => 'GASA3',
            'nombre' => 'Técnico Superior en Ganadería y Asistencia en Sanidad Animal',
            'descripcion' => 'Formación avanzada en gestión ganadera, reproducción animal y apoyo veterinario.'
        ),
        array(
            'codigo_familia' => 'AGA',
            'grado' => 'superior',
            'codigo' => 'GFMN3',
            'nombre' => 'Técnico Superior en Gestión Forestal y del Medio Natural',
            'descripcion' => 'Especialización en planificación y gestión sostenible de recursos forestales y espacios naturales.'
        ),
        array(
            'codigo_familia' => 'AGA',
            'grado' => 'medio',
            'codigo' => 'JAFO2',
            'nombre' => 'Técnico en Jardinería y Floristería',
            'descripcion' => 'Formación en diseño, instalación y mantenimiento de jardines, así como en arte floral.'
        ),
        array(
            'codigo_familia' => 'AGA',
            'grado' => 'superior',
            'codigo' => 'PAMR3',
            'nombre' => 'Técnico Superior en Paisajismo y Medio Rural',
            'descripcion' => 'Capacitación en diseño paisajístico, restauración ambiental y planificación territorial rural.'
        ),
        array(
            'codigo_familia' => 'AGA',
            'grado' => 'medio',
            'codigo' => 'PRAE2',
            'nombre' => 'Técnico en Producción Agroecológica',
            'descripcion' => 'Especialización en agricultura ecológica, sostenible y respetuosa con el medio ambiente.'
        ),
        array(
            'codigo_familia' => 'AGA',
            'grado' => 'medio',
            'codigo' => 'PRAP2',
            'nombre' => 'Técnico en Producción Agropecuaria',
            'descripcion' => 'Formación integral en gestión de explotaciones agrícolas y ganaderas.'
        ),

        // ARTES Y ARTESANÍAS (ARA)
        array(
            'codigo_familia' => 'ARA',
            'grado' => 'superior',
            'codigo' => 'ARFA3',
            'nombre' => 'Técnico Superior en Artista Fallero y Construcción de Escenografías',
            'descripcion' => 'Especialización en diseño y construcción de fallas, escenografías teatrales y elementos decorativos.'
        ),

        // ARTES GRÁFICAS (ARG)
        array(
            'codigo_familia' => 'ARG',
            'grado' => 'basico',
            'codigo' => 'ARGR1',
            'nombre' => 'Profesional Básico en Artes Gráficas',
            'descripcion' => 'Formación básica en técnicas de impresión, encuadernación y manipulados gráficos.'
        ),
        array(
            'codigo_familia' => 'ARG',
            'grado' => 'superior',
            'codigo' => 'DEPM3',
            'nombre' => 'Técnico Superior en Diseño y Edición de Publicaciones Impresas y Multimedia',
            'descripcion' => 'Especialización en diseño editorial, maquetación digital y producción multimedia.'
        ),
        array(
            'codigo_familia' => 'ARG',
            'grado' => 'superior',
            'codigo' => 'DGPG3',
            'nombre' => 'Técnico Superior en Diseño y Gestión de la Producción Gráfica',
            'descripcion' => 'Formación en planificación y control de procesos de producción gráfica industrial.'
        ),
        array(
            'codigo_familia' => 'ARG',
            'grado' => 'medio',
            'codigo' => 'IMGR2',
            'nombre' => 'Técnico en Impresión Gráfica',
            'descripcion' => 'Capacitación en técnicas de impresión offset, digital y serigrafía.'
        ),
        array(
            'codigo_familia' => 'ARG',
            'grado' => 'medio',
            'codigo' => 'PIAG2',
            'nombre' => 'Técnico en Post-impresión y Acabados Gráficos',
            'descripcion' => 'Especialización en encuadernación, troquelado, plastificado y acabados de productos gráficos.'
        ),
        array(
            'codigo_familia' => 'ARG',
            'grado' => 'medio',
            'codigo' => 'PRID2',
            'nombre' => 'Técnico en Pre-impresión Digital',
            'descripcion' => 'Formación en preparación de archivos digitales, pruebas de color y planificación de impresión.'
        ),

        // COMERCIO Y MARKETING (COM)
        array(
            'codigo_familia' => 'COM',
            'grado' => 'medio',
            'codigo' => 'ACCO2',
            'nombre' => 'Técnico en Actividades Comerciales',
            'descripcion' => 'Formación en técnicas de venta, merchandising, atención al cliente y gestión de puntos de venta.'
        ),
        array(
            'codigo_familia' => 'COM',
            'grado' => 'superior',
            'codigo' => 'COIN3',
            'nombre' => 'Técnico Superior en Comercio Internacional',
            'descripcion' => 'Especialización en operaciones de importación-exportación, logística internacional y financiación del comercio exterior.'
        ),
        array(
            'codigo_familia' => 'COM',
            'grado' => 'medio',
            'codigo' => 'COPA2',
            'nombre' => 'Técnico en Comercialización de Productos Alimentarios',
            'descripcion' => 'Capacitación específica en venta y promoción de productos del sector alimentario.'
        ),
        array(
            'codigo_familia' => 'COM',
            'grado' => 'superior',
            'codigo' => 'GVEC3',
            'nombre' => 'Técnico Superior en Gestión de Ventas y Espacios Comerciales',
            'descripcion' => 'Formación avanzada en gestión comercial, organización de equipos de venta y diseño de espacios comerciales.'
        ),
        array(
            'codigo_familia' => 'COM',
            'grado' => 'superior',
            'codigo' => 'MAPU3',
            'nombre' => 'Técnico Superior en Marketing y Publicidad',
            'descripcion' => 'Especialización en estrategias de marketing digital, publicidad, investigación de mercados y comunicación comercial.'
        ),
        array(
            'codigo_familia' => 'COM',
            'grado' => 'basico',
            'codigo' => 'SECO1',
            'nombre' => 'Profesional Básico en Servicios Comerciales',
            'descripcion' => 'Formación básica en tareas auxiliares de venta y reposición en establecimientos comerciales.'
        ),
        array(
            'codigo_familia' => 'COM',
            'grado' => 'superior',
            'codigo' => 'TRLO3',
            'nombre' => 'Técnico Superior en Transporte y Logística',
            'descripcion' => 'Capacitación en gestión de almacenes, distribución, planificación de rutas y operaciones logísticas.'
        ),
        // ==========================================
        // ELECTRICIDAD Y ELECTRÓNICA (ELE)
        // ==========================================
        array(
            'codigo_familia' => 'ELE',
            'grado' => 'superior',
            'codigo' => 'AURI3',
            'nombre' => 'Técnico Superior en Automatización y Robótica Industrial',
            'descripcion' => 'Especialización en sistemas automáticos industriales, robótica, programación de PLCs y mantenimiento de líneas de producción automatizadas.'
        ),
        array(
            'codigo_familia' => 'ELE',
            'grado' => 'superior',
            'codigo' => 'CIOP3',
            'nombre' => 'Curso de Especialización en Ciberseguridad en Entornos de las Tecnologías de Operación',
            'descripcion' => 'Formación avanzada en protección de sistemas industriales, SCADA, redes OT y seguridad en entornos de automatización.'
        ),
        array(
            'codigo_familia' => 'ELE',
            'grado' => 'medio',
            'codigo' => 'CIOT2',
            'nombre' => 'Curso de Especialización en Dispositivos Conectados a Internet (IoT)',
            'descripcion' => 'Capacitación en Internet de las Cosas, sensores inteligentes, conectividad inalámbrica y sistemas embebidos.'
        ),
        array(
            'codigo_familia' => 'ELE',
            'grado' => 'basico',
            'codigo' => 'ELEL1',
            'nombre' => 'Profesional Básico en Electricidad y Electrónica',
            'descripcion' => 'Formación básica en instalaciones eléctricas domiciliarias, montaje de circuitos y mantenimiento eléctrico elemental.'
        ),
        array(
            'codigo_familia' => 'ELE',
            'grado' => 'superior',
            'codigo' => 'EMCL3',
            'nombre' => 'Técnico Superior en Electromedicina Clínica',
            'descripcion' => 'Especialización en mantenimiento y calibración de equipos médicos electrónicos, rayos X, resonancias y tecnología hospitalaria.'
        ),
        array(
            'codigo_familia' => 'ELE',
            'grado' => 'medio',
            'codigo' => 'IMSC2',
            'nombre' => 'Curso de Especialización en Instalación y Mantenimiento de Sistemas de Energía Solar Fotovoltaica',
            'descripcion' => 'Formación específica en instalación, configuración y mantenimiento de sistemas de energía solar fotovoltaica.'
        ),
        array(
            'codigo_familia' => 'ELE',
            'grado' => 'medio',
            'codigo' => 'INEA2',
            'nombre' => 'Técnico en Instalaciones Eléctricas y Automáticas',
            'descripcion' => 'Capacitación en instalaciones eléctricas de baja tensión, domótica, automatismos y sistemas de control eléctrico.'
        ),
        array(
            'codigo_familia' => 'ELE',
            'grado' => 'medio',
            'codigo' => 'INTE2',
            'nombre' => 'Técnico en Instalaciones de Telecomunicaciones',
            'descripcion' => 'Formación en instalación y mantenimiento de sistemas de telecomunicaciones, antenas, fibra óptica y redes de comunicación.'
        ),
        array(
            'codigo_familia' => 'ELE',
            'grado' => 'medio',
            'codigo' => 'IREG2',
            'nombre' => 'Curso de Especialización en Implementación de Redes 5G',
            'descripcion' => 'Especialización en despliegue, configuración y optimización de redes de quinta generación móvil.'
        ),
        array(
            'codigo_familia' => 'ELE',
            'grado' => 'superior',
            'codigo' => 'MAEL3',
            'nombre' => 'Técnico Superior en Mantenimiento Electrónico',
            'descripcion' => 'Formación avanzada en diagnóstico y reparación de equipos electrónicos industriales, instrumentación y sistemas de control.'
        ),
        array(
            'codigo_familia' => 'ELE',
            'grado' => 'superior',
            'codigo' => 'ROCO3',
            'nombre' => 'Curso de Especialización en Robótica Colaborativa',
            'descripcion' => 'Capacitación en robots colaborativos (cobots), programación avanzada de robots industriales y sistemas de visión artificial.'
        ),
        array(
            'codigo_familia' => 'ELE',
            'grado' => 'superior',
            'codigo' => 'SELA3',
            'nombre' => 'Técnico Superior en Sistemas Electrotécnicos y Automatizados',
            'descripcion' => 'Especialización en sistemas eléctricos industriales complejos, automatización de procesos y eficiencia energética.'
        ),
        array(
            'codigo_familia' => 'ELE',
            'grado' => 'superior',
            'codigo' => 'SITF3',
            'nombre' => 'Curso de Especialización en Sistemas de Señalización y Telecomunicaciones Ferroviarias',
            'descripcion' => 'Formación específica en sistemas de seguridad ferroviaria, señalización digital y comunicaciones del transporte ferroviario.'
        ),
        array(
            'codigo_familia' => 'ELE',
            'grado' => 'superior',
            'codigo' => 'STEI3',
            'nombre' => 'Técnico Superior en Sistemas de Telecomunicaciones e Informáticos',
            'descripcion' => 'Capacitación integral en redes de telecomunicaciones, sistemas informáticos y convergencia tecnológica IT/OT.'
        ),

        // ==========================================
        // ENERGÍA Y AGUA (ENA)
        // ==========================================
        array(
            'codigo_familia' => 'ENA',
            'grado' => 'superior',
            'codigo' => 'AUEN3',
            'nombre' => 'Curso de Especialización en Auditoría Energética',
            'descripcion' => 'Formación avanzada en análisis de eficiencia energética, certificación energética de edificios y optimización de consumos.'
        ),
        array(
            'codigo_familia' => 'ENA',
            'grado' => 'superior',
            'codigo' => 'CEEL3',
            'nombre' => 'Técnico Superior en Centrales Eléctricas',
            'descripcion' => 'Especialización en operación y mantenimiento de centrales de generación eléctrica, turbinas y sistemas de distribución.'
        ),
        array(
            'codigo_familia' => 'ENA',
            'grado' => 'superior',
            'codigo' => 'EEST3',
            'nombre' => 'Técnico Superior en Eficiencia Energética y Energía Solar Térmica',
            'descripcion' => 'Capacitación en sistemas de ahorro energético, instalaciones solares térmicas y gestión energética sostenible.'
        ),
        array(
            'codigo_familia' => 'ENA',
            'grado' => 'superior',
            'codigo' => 'ENRE3',
            'nombre' => 'Técnico Superior en Energías Renovables',
            'descripcion' => 'Formación integral en energía eólica, solar fotovoltaica, biomasa, hidroeléctrica y otras fuentes renovables.'
        ),
        array(
            'codigo_familia' => 'ENA',
            'grado' => 'superior',
            'codigo' => 'GEAG3',
            'nombre' => 'Técnico Superior en Gestión del Agua',
            'descripcion' => 'Especialización en tratamiento de aguas potables y residuales, redes de distribución y gestión de recursos hídricos.'
        ),
        array(
            'codigo_familia' => 'ENA',
            'grado' => 'medio',
            'codigo' => 'REAG2',
            'nombre' => 'Técnico en Redes y Estaciones de Tratamiento de Agua',
            'descripcion' => 'Formación en operación de plantas potabilizadoras, depuradoras, mantenimiento de redes y control de calidad del agua.'
        ),

        // ==========================================
        // EDIFICACIÓN Y OBRA CIVIL (EOC)
        // ==========================================
        array(
            'codigo_familia' => 'EOC',
            'grado' => 'medio',
            'codigo' => 'CONS2',
            'nombre' => 'Técnico en Construcción',
            'descripcion' => 'Formación en ejecución de obras de construcción, albañilería, estructuras, instalaciones y control de calidad en edificación.'
        ),
        array(
            'codigo_familia' => 'EOC',
            'grado' => 'superior',
            'codigo' => 'OCOC3',
            'nombre' => 'Técnico Superior en Organización y Control de Obras de Construcción',
            'descripcion' => 'Especialización en planificación de obras, control de costes, gestión de equipos y seguimiento de proyectos constructivos.'
        ),
        array(
            'codigo_familia' => 'EOC',
            'grado' => 'medio',
            'codigo' => 'OIDR2',
            'nombre' => 'Técnico en Obras de Interior, Decoración y Rehabilitación',
            'descripcion' => 'Capacitación en reformas integrales, decoración de espacios, rehabilitación de edificios y interiorismo.'
        ),
        array(
            'codigo_familia' => 'EOC',
            'grado' => 'superior',
            'codigo' => 'PRED3',
            'nombre' => 'Técnico Superior en Proyectos de Edificación',
            'descripcion' => 'Formación en desarrollo de proyectos arquitectónicos, cálculos estructurales, mediciones y presupuestos de edificación.'
        ),
        array(
            'codigo_familia' => 'EOC',
            'grado' => 'superior',
            'codigo' => 'PROC3',
            'nombre' => 'Técnico Superior en Proyectos de Obra Civil',
            'descripcion' => 'Especialización en diseño de infraestructuras, carreteras, puentes, redes de saneamiento y topografía avanzada.'
        ),
        array(
            'codigo_familia' => 'EOC',
            'grado' => 'basico',
            'codigo' => 'REMA1',
            'nombre' => 'Profesional Básico en Reforma y Mantenimiento de Edificios',
            'descripcion' => 'Formación básica en trabajos de albañilería, pintura, fontanería básica y mantenimiento general de edificios.'
        ),

        // ==========================================
        // FABRICACIÓN MECÁNICA (FME)
        // ==========================================
        array(
            'codigo_familia' => 'FME',
            'grado' => 'medio',
            'codigo' => 'CMMP2',
            'nombre' => 'Técnico en Conformado por Moldeo de Metales y Polímeros',
            'descripcion' => 'Formación en procesos de fundición, moldeo por inyección, conformado de metales y polímeros industriales.'
        ),
        array(
            'codigo_familia' => 'FME',
            'grado' => 'superior',
            'codigo' => 'COME3',
            'nombre' => 'Técnico Superior en Construcciones Metálicas',
            'descripcion' => 'Especialización en diseño y montaje de estructuras metálicas, soldadura especializada y control de calidad metalúrgico.'
        ),
        array(
            'codigo_familia' => 'FME',
            'grado' => 'superior',
            'codigo' => 'DIFM3',
            'nombre' => 'Técnico Superior en Diseño en Fabricación Mecánica',
            'descripcion' => 'Capacitación en diseño CAD/CAM, desarrollo de productos mecánicos, simulación y prototipado industrial.'
        ),
        array(
            'codigo_familia' => 'FME',
            'grado' => 'superior',
            'codigo' => 'FAAD3',
            'nombre' => 'Curso de Especialización en Fabricación Aditiva',
            'descripcion' => 'Formación avanzada en impresión 3D industrial, tecnologías de fabricación aditiva y postprocesado de piezas.'
        ),
        array(
            'codigo_familia' => 'FME',
            'grado' => 'basico',
            'codigo' => 'FAEM1',
            'nombre' => 'Profesional Básico en Fabricación de Elementos Metálicos',
            'descripcion' => 'Formación básica en corte, dobrado, soldadura básica y montaje de elementos metálicos simples.'
        ),
        array(
            'codigo_familia' => 'FME',
            'grado' => 'basico',
            'codigo' => 'FAMO1',
            'nombre' => 'Profesional Básico en Fabricación y Montaje',
            'descripcion' => 'Capacitación básica en operaciones de fabricación mecánica, montaje de conjuntos y control dimensional básico.'
        ),
        array(
            'codigo_familia' => 'FME',
            'grado' => 'basico',
            'codigo' => 'IEME1',
            'nombre' => 'Profesional Básico en Instalaciones Electrotécnicas y Mecánica',
            'descripcion' => 'Formación básica combinada en instalaciones eléctricas básicas y operaciones mecánicas elementales.'
        ),
        array(
            'codigo_familia' => 'FME',
            'grado' => 'superior',
            'codigo' => 'MCIA3',
            'nombre' => 'Curso de Especialización en Materiales Compuestos en la Industria Aeroespacial',
            'descripcion' => 'Especialización en fibra de carbono, materiales compuestos avanzados y técnicas de fabricación aeronáutica.'
        ),
        array(
            'codigo_familia' => 'FME',
            'grado' => 'medio',
            'codigo' => 'MECA2',
            'nombre' => 'Técnico en Mecanizado',
            'descripcion' => 'Formación en operaciones de torneado, fresado, taladrado, programación CNC y control de calidad dimensional.'
        ),
        array(
            'codigo_familia' => 'FME',
            'grado' => 'medio',
            'codigo' => 'MESA2',
            'nombre' => 'Técnico en Montaje de Estructuras e Instalación de Sistemas Aeronáuticos',
            'descripcion' => 'Capacitación en montaje de fuselajes, sistemas aviónicos, controles de vuelo y mantenimiento aeronáutico.'
        ),
        array(
            'codigo_familia' => 'FME',
            'grado' => 'superior',
            'codigo' => 'PPFM3',
            'nombre' => 'Técnico Superior en Programación de la Producción en Fabricación Mecánica',
            'descripcion' => 'Especialización en planificación industrial, gestión de la producción, lean manufacturing y optimización de procesos.'
        ),
        array(
            'codigo_familia' => 'FME',
            'grado' => 'superior',
            'codigo' => 'PPMP3',
            'nombre' => 'Técnico Superior en Programación de la Producción en Moldeo de Metales y Polímeros',
            'descripcion' => 'Formación en gestión de procesos de moldeo, control de producción en fundición y optimización de líneas de moldeo.'
        ),
        array(
            'codigo_familia' => 'FME',
            'grado' => 'medio',
            'codigo' => 'SOCA2',
            'nombre' => 'Técnico en Soldadura y Calderería',
            'descripcion' => 'Capacitación en técnicas de soldadura avanzada, conformado de chapas, montaje de estructuras soldadas y calderería.'
        ),

        // ==========================================
        // HOSTELERÍA Y TURISMO (HOT)
        // ==========================================
        array(
            'codigo_familia' => 'HOT',
            'grado' => 'basico',
            'codigo' => 'ALLA1',
            'nombre' => 'Profesional Básico en Alojamiento y Lavandería',
            'descripcion' => 'Formación básica en servicios de pisos, limpieza hotelera, lavandería y mantenimiento de alojamientos turísticos.'
        ),
        array(
            'codigo_familia' => 'HOT',
            'grado' => 'superior',
            'codigo' => 'AVGE3',
            'nombre' => 'Técnico Superior en Agencias de Viajes y Gestión de Eventos',
            'descripcion' => 'Especialización en planificación de viajes, organización de eventos, marketing turístico y gestión de agencias de viajes.'
        ),
        array(
            'codigo_familia' => 'HOT',
            'grado' => 'medio',
            'codigo' => 'COGA2',
            'nombre' => 'Técnico en Cocina y Gastronomía',
            'descripcion' => 'Formación en técnicas culinarias, elaboración de menús, organización de cocinas y seguridad alimentaria.'
        ),
        array(
            'codigo_familia' => 'HOT',
            'grado' => 'medio',
            'codigo' => 'COPA2_HOT',
            'nombre' => 'Técnico en Comercialización de Productos Alimentarios',
            'descripcion' => 'Capacitación específica en venta y promoción de productos gastronómicos y alimentarios del sector hostelero.'
        ),
        array(
            'codigo_familia' => 'HOT',
            'grado' => 'basico',
            'codigo' => 'CORE1',
            'nombre' => 'Profesional Básico en Cocina y Restauración',
            'descripcion' => 'Formación básica en preparaciones culinarias simples, servicio de mesa y operaciones auxiliares de restauración.'
        ),
        array(
            'codigo_familia' => 'HOT',
            'grado' => 'superior',
            'codigo' => 'DICO3',
            'nombre' => 'Técnico Superior en Dirección de Cocina',
            'descripcion' => 'Especialización en gestión de cocinas profesionales, creatividad culinaria, control de costes y liderazgo de equipos.'
        ),
        array(
            'codigo_familia' => 'HOT',
            'grado' => 'superior',
            'codigo' => 'DISR3',
            'nombre' => 'Técnico Superior en Dirección de Servicios de Restauración',
            'descripcion' => 'Formación en gestión integral de restaurantes, protocolo de servicio, sumillería y experiencia gastronómica.'
        ),
        array(
            'codigo_familia' => 'HOT',
            'grado' => 'superior',
            'codigo' => 'GEAT3',
            'nombre' => 'Técnico Superior en Gestión de Alojamientos Turísticos',
            'descripcion' => 'Capacitación en administración hotelera, recepción, housekeeping, revenue management y atención al cliente.'
        ),
        array(
            'codigo_familia' => 'HOT',
            'grado' => 'superior',
            'codigo' => 'GIAT3',
            'nombre' => 'Técnico Superior en Guía, Información y Asistencias Turísticas',
            'descripcion' => 'Especialización en guía turística, interpretación del patrimonio, idiomas aplicados al turismo y asistencia a turistas.'
        ),
        array(
            'codigo_familia' => 'HOT',
            'grado' => 'medio',
            'codigo' => 'PABA2',
            'nombre' => 'Curso de Especialización en Panadería y Bollería Artesanales',
            'descripcion' => 'Formación especializada en técnicas artesanales de panadería, bollería tradicional y productos de pastelería.'
        ),
        array(
            'codigo_familia' => 'HOT',
            'grado' => 'basico',
            'codigo' => 'PAPA1',
            'nombre' => 'Profesional Básico en Actividades de Panadería y Pastelería',
            'descripcion' => 'Capacitación básica en elaboración de panes, dulces simples y operaciones auxiliares de panadería.'
        ),
        array(
            'codigo_familia' => 'HOT',
            'grado' => 'medio',
            'codigo' => 'SERE2',
            'nombre' => 'Técnico en Servicios de Restauración',
            'descripcion' => 'Formación en servicio de sala, protocolo de restauración, maridaje básico y atención especializada al cliente.'
        ),

        // ==========================================
        // INDUSTRIAS EXTRACTIVAS (IEX)
        // ==========================================
        array(
            'codigo_familia' => 'IEX',
            'grado' => 'medio',
            'codigo' => 'EXSO2',
            'nombre' => 'Técnico en Excavaciones y Sondeos',
            'descripcion' => 'Formación en técnicas de perforación, sondeos geotécnicos, manejo de explosivos y operaciones de excavación.'
        ),
        array(
            'codigo_familia' => 'IEX',
            'grado' => 'medio',
            'codigo' => 'PINA2',
            'nombre' => 'Técnico en Piedra Natural',
            'descripcion' => 'Capacitación en extracción, transformación y colocación de piedra natural, cantería y restauración patrimonial.'
        ),

        // INFORMÁTICA Y COMUNICACIONES (IFC)
        array(
            'codigo_familia' => 'IFC',
            'grado' => 'superior',
            'codigo' => 'ASIR3',
            'nombre' => 'Técnico Superior en Administración de Sistemas Informáticos en Red',
            'descripcion' => 'Especialización en administración de servidores, redes informáticas, seguridad y sistemas operativos.'
        ),
        array(
            'codigo_familia' => 'IFC',
            'grado' => 'superior',
            'codigo' => 'CIIN3',
            'nombre' => 'Curso de Especialización en Ciberseguridad en Entornos de las Tecnologías de la Información',
            'descripcion' => 'Formación avanzada en protección de sistemas, análisis de vulnerabilidades y respuesta a incidentes de seguridad.'
        ),
        array(
            'codigo_familia' => 'IFC',
            'grado' => 'superior',
            'codigo' => 'DAPM3',
            'nombre' => 'Técnico Superior en Desarrollo de Aplicaciones Multiplataforma',
            'descripcion' => 'Capacitación en programación de aplicaciones para múltiples plataformas usando Java, C#, Python y tecnologías móviles.'
        ),
        array(
            'codigo_familia' => 'IFC',
            'grado' => 'superior',
            'codigo' => 'DAPW3',
            'nombre' => 'Técnico Superior en Desarrollo de Aplicaciones Web',
            'descripcion' => 'Formación en desarrollo web full-stack, incluyendo HTML, CSS, JavaScript, PHP, bases de datos y frameworks modernos.'
        ),
        array(
            'codigo_familia' => 'IFC',
            'grado' => 'superior',
            'codigo' => 'DVRV3',
            'nombre' => 'Curso de Especialización en Desarrollo de Videojuegos y Realidad Virtual',
            'descripcion' => 'Especialización en programación de videojuegos, motores gráficos, realidad virtual y realidad aumentada.'
        ),
        array(
            'codigo_familia' => 'IFC',
            'grado' => 'superior',
            'codigo' => 'IABD3',
            'nombre' => 'Curso de Especialización en Inteligencia Artificial y Big Data',
            'descripcion' => 'Formación avanzada en machine learning, análisis de datos masivos, Python, R y herramientas de IA.'
        ),
        array(
            'codigo_familia' => 'IFC',
            'grado' => 'basico',
            'codigo' => 'INCO1',
            'nombre' => 'Profesional Básico en Informática y Comunicaciones',
            'descripcion' => 'Formación básica en montaje de equipos, instalación de software y mantenimiento informático elemental.'
        ),
        array(
            'codigo_familia' => 'IFC',
            'grado' => 'medio',
            'codigo' => 'SMIR2',
            'nombre' => 'Técnico en Sistemas Microinformáticos y Redes',
            'descripcion' => 'Capacitación en instalación, configuración y mantenimiento de sistemas informáticos y redes locales.'
        ),

        // ==========================================
        // INSTALACIÓN Y MANTENIMIENTO (IMA)
        // ==========================================
        array(
            'codigo_familia' => 'IMA',
            'grado' => 'superior',
            'codigo' => 'DIMI3',
            'nombre' => 'Curso de Especialización en Digitalización del Mantenimiento Industrial',
            'descripcion' => 'Formación avanzada en mantenimiento 4.0, IoT industrial, mantenimiento predictivo y digitalización de procesos.'
        ),
        array(
            'codigo_familia' => 'IMA',
            'grado' => 'superior',
            'codigo' => 'DPTF3',
            'nombre' => 'Técnico Superior en Desarrollo de Proyectos de Instalaciones Térmicas y de Fluidos',
            'descripcion' => 'Especialización en diseño de instalaciones de climatización, calefacción, fontanería y sistemas de fluidos.'
        ),
        array(
            'codigo_familia' => 'IMA',
            'grado' => 'superior',
            'codigo' => 'FAIN3',
            'nombre' => 'Curso de Especialización en Fabricación Inteligente',
            'descripcion' => 'Capacitación en Industria 4.0, sistemas ciber-físicos, fabricación inteligente y mantenimiento avanzado.'
        ),
        array(
            'codigo_familia' => 'IMA',
            'grado' => 'basico',
            'codigo' => 'FAMO1',
            'nombre' => 'Profesional Básico en Fabricación y Montaje',
            'descripcion' => 'Formación básica en operaciones de montaje, ensamblaje de componentes y mantenimiento elemental.'
        ),
        array(
            'codigo_familia' => 'IMA',
            'grado' => 'medio',
            'codigo' => 'INFC2',
            'nombre' => 'Técnico en Instalaciones Frigoríficas y de Climatización',
            'descripcion' => 'Formación en instalación y mantenimiento de sistemas de refrigeración, aire acondicionado y climatización.'
        ),
        array(
            'codigo_familia' => 'IMA',
            'grado' => 'medio',
            'codigo' => 'INPC2',
            'nombre' => 'Técnico en Instalaciones de Producción de Calor',
            'descripcion' => 'Capacitación en calderas, sistemas de calefacción, energía solar térmica y biomasa.'
        ),
        array(
            'codigo_familia' => 'IMA',
            'grado' => 'medio',
            'codigo' => 'MAEL2',
            'nombre' => 'Técnico en Mantenimiento Electromecánico',
            'descripcion' => 'Formación en mantenimiento de equipos industriales, sistemas electromecánicos y maquinaria productiva.'
        ),
        array(
            'codigo_familia' => 'IMA',
            'grado' => 'basico',
            'codigo' => 'MAVI1',
            'nombre' => 'Profesional Básico en Mantenimiento de Viviendas',
            'descripcion' => 'Capacitación básica en fontanería, electricidad doméstica, pintura y reparaciones menores en viviendas.'
        ),
        array(
            'codigo_familia' => 'IMA',
            'grado' => 'superior',
            'codigo' => 'MEIN3',
            'nombre' => 'Técnico Superior en Mecatrónica Industrial',
            'descripcion' => 'Especialización en sistemas automatizados, robótica industrial, programación de PLCs y mantenimiento avanzado.'
        ),
        array(
            'codigo_familia' => 'IMA',
            'grado' => 'superior',
            'codigo' => 'MITF3',
            'nombre' => 'Técnico Superior en Mantenimiento de Instalaciones Térmicas y de Fluidos',
            'descripcion' => 'Formación avanzada en mantenimiento de instalaciones térmicas, sistemas de fluidos y eficiencia energética.'
        ),
        array(
            'codigo_familia' => 'IMA',
            'grado' => 'superior',
            'codigo' => 'MOIN3',
            'nombre' => 'Curso de Especialización en Modelado de la Información en la Construcción (BIM)',
            'descripcion' => 'Capacitación en metodología BIM, modelado 3D, gestión de proyectos constructivos y tecnologías digitales.'
        ),

        // ==========================================
        // IMAGEN PERSONAL (IMP)
        // ==========================================
        array(
            'codigo_familia' => 'IMP',
            'grado' => 'superior',
            'codigo' => 'AIPC3',
            'nombre' => 'Técnico Superior en Asesoría de Imagen Personal y Corporativa',
            'descripcion' => 'Especialización en consultoría de imagen, protocolo empresarial, personal shopper y comunicación no verbal.'
        ),
        array(
            'codigo_familia' => 'IMP',
            'grado' => 'superior',
            'codigo' => 'CMPR3',
            'nombre' => 'Técnico Superior en Caracterización y Maquillaje Profesional',
            'descripcion' => 'Formación en maquillaje artístico, caracterización para espectáculos, efectos especiales y prótesis.'
        ),
        array(
            'codigo_familia' => 'IMP',
            'grado' => 'superior',
            'codigo' => 'EDPE3',
            'nombre' => 'Técnico Superior en Estilismo y Dirección de Peluquería',
            'descripcion' => 'Capacitación en técnicas avanzadas de peluquería, colorimetría, gestión de salones y tendencias capilares.'
        ),
        array(
            'codigo_familia' => 'IMP',
            'grado' => 'medio',
            'codigo' => 'ESBE2',
            'nombre' => 'Técnico en Estética y Belleza',
            'descripcion' => 'Formación en tratamientos faciales, corporales, depilación, manicura, pedicura y técnicas de relajación.'
        ),
        array(
            'codigo_familia' => 'IMP',
            'grado' => 'superior',
            'codigo' => 'ESIB3',
            'nombre' => 'Técnico Superior en Estética Integral y Bienestar',
            'descripcion' => 'Especialización en tratamientos estéticos avanzados, aparatología estética, medicina estética y wellness.'
        ),
        array(
            'codigo_familia' => 'IMP',
            'grado' => 'medio',
            'codigo' => 'PCNC2',
            'nombre' => 'Técnico en Peluquería y Cosmética Capilar',
            'descripcion' => 'Capacitación en corte, peinado, coloración, tratamientos capilares y técnicas de peluquería profesional.'
        ),
        array(
            'codigo_familia' => 'IMP',
            'grado' => 'basico',
            'codigo' => 'PEES1',
            'nombre' => 'Profesional Básico en Peluquería y Estética',
            'descripcion' => 'Formación básica en servicios auxiliares de peluquería, estética y cuidado personal elemental.'
        ),
        array(
            'codigo_familia' => 'IMP',
            'grado' => 'superior',
            'codigo' => 'TEBI3',
            'nombre' => 'Técnico Superior en Termalismo y Bienestar',
            'descripcion' => 'Especialización en balneoterapia, talasoterapia, spa, hidroterapia y turismo de salud y bienestar.'
        ),

        // ==========================================
        // IMAGEN Y SONIDO (IMS)
        // ==========================================
        array(
            'codigo_familia' => 'IMS',
            'grado' => 'superior',
            'codigo' => 'AJEI3',
            'nombre' => 'Técnico Superior en Animación 3D, Juegos y Entornos Interactivos',
            'descripcion' => 'Formación en modelado 3D, animación digital, desarrollo de videojuegos y realidad virtual.'
        ),
        array(
            'codigo_familia' => 'IMS',
            'grado' => 'superior',
            'codigo' => 'AUSU3',
            'nombre' => 'Curso de Especialización en Audiodescripción y Subtitulación',
            'descripcion' => 'Especialización en accesibilidad audiovisual, audiodescripción para invidentes y subtitulado profesional.'
        ),
        array(
            'codigo_familia' => 'IMS',
            'grado' => 'superior',
            'codigo' => 'ICTI3',
            'nombre' => 'Técnico Superior en Iluminación, Captación y Tratamiento de Imagen',
            'descripcion' => 'Capacitación en fotografía profesional, vídeo, iluminación técnica y postproducción audiovisual.'
        ),
        array(
            'codigo_familia' => 'IMS',
            'grado' => 'superior',
            'codigo' => 'PAES3',
            'nombre' => 'Técnico Superior en Producción de Audiovisuales y Espectáculos',
            'descripcion' => 'Formación en gestión de producción, coordinación de equipos, presupuestos y logística audiovisual.'
        ),
        array(
            'codigo_familia' => 'IMS',
            'grado' => 'superior',
            'codigo' => 'RAES3',
            'nombre' => 'Técnico Superior en Realización de Proyectos Audiovisuales y Espectáculos',
            'descripcion' => 'Especialización en dirección audiovisual, realización multicámara, edición y narrativa audiovisual.'
        ),
        array(
            'codigo_familia' => 'IMS',
            'grado' => 'superior',
            'codigo' => 'SAES3',
            'nombre' => 'Técnico Superior en Sonido para Audiovisuales y Espectáculos',
            'descripcion' => 'Capacitación en grabación, mezcla, masterización, sonorización en directo y diseño sonoro.'
        ),
        array(
            'codigo_familia' => 'IMS',
            'grado' => 'medio',
            'codigo' => 'VDJS2',
            'nombre' => 'Técnico en Video Disc-jockey y Sonido',
            'descripcion' => 'Formación en mezcla musical, sonorización de eventos, equipos de audio y animación musical.'
        ),

        // ==========================================
        // INDUSTRIAS ALIMENTARIAS (INA)
        // ==========================================
        array(
            'codigo_familia' => 'INA',
            'grado' => 'medio',
            'codigo' => 'ACOV2',
            'nombre' => 'Técnico en Aceites de Oliva y Vinos',
            'descripcion' => 'Especialización en elaboración de aceite de oliva, enología, cata, análisis sensorial y control de calidad.'
        ),
        array(
            'codigo_familia' => 'INA',
            'grado' => 'medio',
            'codigo' => 'ELPA2',
            'nombre' => 'Técnico en Elaboración de Productos Alimenticios',
            'descripcion' => 'Formación en procesado de alimentos, conservación, envasado, seguridad alimentaria y tecnología alimentaria.'
        ),
        array(
            'codigo_familia' => 'INA',
            'grado' => 'basico',
            'codigo' => 'INAL1',
            'nombre' => 'Profesional Básico en Industrias Alimentarias',
            'descripcion' => 'Capacitación básica en operaciones auxiliares de elaboración de alimentos y manipulación alimentaria.'
        ),
        array(
            'codigo_familia' => 'INA',
            'grado' => 'basico',
            'codigo' => 'PAPA1_INA',
            'nombre' => 'Profesional Básico en Actividades de Panadería y Pastelería',
            'descripcion' => 'Formación básica en elaboración de productos de panadería, bollería y pastelería industrial.'
        ),
        array(
            'codigo_familia' => 'INA',
            'grado' => 'medio',
            'codigo' => 'PARC2',
            'nombre' => 'Técnico en Panadería, Repostería y Confitería',
            'descripcion' => 'Capacitación en técnicas artesanales e industriales de panadería, repostería y confitería profesional.'
        ),
        array(
            'codigo_familia' => 'INA',
            'grado' => 'superior',
            'codigo' => 'PCIA3',
            'nombre' => 'Técnico Superior en Procesos y Calidad en la Industria Alimentaria',
            'descripcion' => 'Especialización en gestión de calidad alimentaria, APPCC, auditorías, innovación y desarrollo de productos.'
        ),
        array(
            'codigo_familia' => 'INA',
            'grado' => 'superior',
            'codigo' => 'VITI3',
            'nombre' => 'Técnico Superior en Vitivinicultura',
            'descripcion' => 'Formación avanzada en cultivo de vid, elaboración de vinos, gestión de bodegas y comercialización vinícola.'
        ),

        // ==========================================
        // MADERA, MUEBLE Y CORCHO (MAM)
        // ==========================================
        array(
            'codigo_familia' => 'MAM',
            'grado' => 'basico',
            'codigo' => 'CAMU1',
            'nombre' => 'Profesional Básico en Carpintería y Mueble',
            'descripcion' => 'Formación básica en trabajos de carpintería, montaje de muebles y operaciones auxiliares con madera.'
        ),
        array(
            'codigo_familia' => 'MAM',
            'grado' => 'medio',
            'codigo' => 'CAMU2',
            'nombre' => 'Técnico en Carpintería y Mueble',
            'descripcion' => 'Capacitación en fabricación de muebles, carpintería de armar, ebanistería y acabados de madera.'
        ),
        array(
            'codigo_familia' => 'MAM',
            'grado' => 'superior',
            'codigo' => 'DIAM3',
            'nombre' => 'Técnico Superior en Diseño y Amueblamiento',
            'descripcion' => 'Especialización en diseño de muebles, interiorismo, desarrollo de productos y proyectos de amueblamiento.'
        ),
        array(
            'codigo_familia' => 'MAM',
            'grado' => 'medio',
            'codigo' => 'INAM2',
            'nombre' => 'Técnico en Instalación y Amueblamiento',
            'descripcion' => 'Formación en montaje e instalación de muebles, carpintería de obra y elementos de amueblamiento.'
        ),
        array(
            'codigo_familia' => 'MAM',
            'grado' => 'medio',
            'codigo' => 'PTMA2',
            'nombre' => 'Técnico en Procesado y Transformación de la Madera',
            'descripcion' => 'Capacitación en aserrado, secado, tratamiento y transformación industrial de la madera.'
        ),
        // ==========================================
        // MARÍTIMO-PESQUERA (MAP)
        // ==========================================
        array(
            'codigo_familia' => 'MAP',
            'grado' => 'basico',
            'codigo' => 'ACMA1',
            'nombre' => 'Profesional Básico en Actividades Marítimo-Pesqueras',
            'descripcion' => 'Formación básica en pesca, maricultura, operaciones portuarias y actividades auxiliares marítimas.'
        ),
        array(
            'codigo_familia' => 'MAP',
            'grado' => 'superior',
            'codigo' => 'ACUI3',
            'nombre' => 'Técnico Superior en Acuicultura',
            'descripcion' => 'Especialización en cultivo de especies acuáticas, gestión de piscifactorías, biotecnología marina y sostenibilidad.'
        ),
        array(
            'codigo_familia' => 'MAP',
            'grado' => 'medio',
            'codigo' => 'CUAC2',
            'nombre' => 'Técnico en Cultivos Acuícolas',
            'descripcion' => 'Formación en producción de peces, moluscos, crustáceos, control sanitario y gestión de instalaciones acuícolas.'
        ),
        array(
            'codigo_familia' => 'MAP',
            'grado' => 'medio',
            'codigo' => 'MCMB2',
            'nombre' => 'Técnico en Mantenimiento y Control de la Maquinaria de Buques y Embarcaciones',
            'descripcion' => 'Capacitación en motores marinos, sistemas de propulsión, mantenimiento naval y mecánica de embarcaciones.'
        ),
        array(
            'codigo_familia' => 'MAP',
            'grado' => 'basico',
            'codigo' => 'MEDR1',
            'nombre' => 'Profesional Básico en Mantenimiento de Embarcaciones Deportivas y de Recreo',
            'descripcion' => 'Formación básica en reparación de cascos, mantenimiento de motores y sistemas auxiliares náuticos.'
        ),
        array(
            'codigo_familia' => 'MAP',
            'grado' => 'medio',
            'codigo' => 'NPLI2',
            'nombre' => 'Técnico en Navegación y Pesca de Litoral',
            'descripcion' => 'Capacitación en navegación costera, técnicas de pesca, seguridad marítima y normativa pesquera.'
        ),
        array(
            'codigo_familia' => 'MAP',
            'grado' => 'superior',
            'codigo' => 'OMMB3',
            'nombre' => 'Técnico Superior en Organización del Mantenimiento de Maquinaria de Buques y Embarcaciones',
            'descripcion' => 'Especialización en gestión del mantenimiento naval, planificación de reparaciones y supervisión técnica.'
        ),
        array(
            'codigo_familia' => 'MAP',
            'grado' => 'medio',
            'codigo' => 'OSHI2',
            'nombre' => 'Técnico en Operaciones Subacuáticas e Hiperbáricas',
            'descripcion' => 'Formación en buceo profesional, soldadura subacuática, cámaras hiperbáricas y trabajos submarinos.'
        ),
        array(
            'codigo_familia' => 'MAP',
            'grado' => 'superior',
            'codigo' => 'TMPA3',
            'nombre' => 'Técnico Superior en Transporte Marítimo y Pesca de Altura',
            'descripcion' => 'Especialización en navegación oceánica, gestión de flotas pesqueras, logística marítima y comercio internacional.'
        ),

        // ==========================================
        // QUÍMICA (QUI)
        // ==========================================
        array(
            'codigo_familia' => 'QUI',
            'grado' => 'superior',
            'codigo' => 'CUCE3',
            'nombre' => 'Curso de Especialización en Cultivos Celulares',
            'descripcion' => 'Formación avanzada en biotecnología, cultivo de células, técnicas de laboratorio y producción biofarmacéutica.'
        ),
        array(
            'codigo_familia' => 'QUI',
            'grado' => 'superior',
            'codigo' => 'FPFB3',
            'nombre' => 'Técnico Superior en Fabricación de Productos Farmacéuticos, Biotecnológicos y Afines',
            'descripcion' => 'Especialización en producción farmacéutica, biotecnología, control de calidad y normativa de medicamentos.'
        ),
        array(
            'codigo_familia' => 'QUI',
            'grado' => 'superior',
            'codigo' => 'LACC3',
            'nombre' => 'Técnico Superior en Laboratorio de Análisis y de Control de Calidad',
            'descripcion' => 'Capacitación en análisis químico, microbiológico, instrumental analítico y gestión de calidad en laboratorios.'
        ),
        array(
            'codigo_familia' => 'QUI',
            'grado' => 'medio',
            'codigo' => 'OPLA2',
            'nombre' => 'Técnico en Operaciones de Laboratorio',
            'descripcion' => 'Formación en técnicas básicas de laboratorio, preparación de muestras, análisis rutinarios y seguridad química.'
        ),
        array(
            'codigo_familia' => 'QUI',
            'grado' => 'medio',
            'codigo' => 'PLQI2',
            'nombre' => 'Técnico en Planta Química',
            'descripcion' => 'Capacitación en operaciones de procesos químicos industriales, control de plantas y seguridad en industria química.'
        ),
        array(
            'codigo_familia' => 'QUI',
            'grado' => 'superior',
            'codigo' => 'QUIN3',
            'nombre' => 'Técnico Superior en Química Industrial',
            'descripcion' => 'Especialización en procesos químicos complejos, investigación y desarrollo, optimización industrial y gestión química.'
        ),

        // ==========================================
        // SANIDAD (SAN)
        // ==========================================
        array(
            'codigo_familia' => 'SAN',
            'grado' => 'superior',
            'codigo' => 'ANPAC3',
            'nombre' => 'Técnico Superior en Anatomía Patológica y Citodiagnóstico',
            'descripcion' => 'Especialización en técnicas histológicas, citología, necropsias, procesado de muestras y diagnóstico anatómico.'
        ),
        array(
            'codigo_familia' => 'SAN',
            'grado' => 'superior',
            'codigo' => 'AUPR3',
            'nombre' => 'Técnico Superior en Audiología Protésica',
            'descripcion' => 'Formación en adaptación de audífonos, evaluación audiológica, tecnología auditiva y rehabilitación auditiva.'
        ),
        array(
            'codigo_familia' => 'SAN',
            'grado' => 'superior',
            'codigo' => 'DADSA3',
            'nombre' => 'Técnico Superior en Documentación y Administración Sanitarias',
            'descripcion' => 'Capacitación en gestión hospitalaria, historia clínica electrónica, codificación sanitaria y administración de salud.'
        ),
        array(
            'codigo_familia' => 'SAN',
            'grado' => 'medio',
            'codigo' => 'EMSA2',
            'nombre' => 'Técnico en Emergencias Sanitarias',
            'descripcion' => 'Formación en soporte vital, transporte sanitario, atención prehospitalaria y situaciones de emergencia.'
        ),
        array(
            'codigo_familia' => 'SAN',
            'grado' => 'medio',
            'codigo' => 'FAPA2',
            'nombre' => 'Técnico en Farmacia y Parafarmacia',
            'descripcion' => 'Capacitación en dispensación de medicamentos, atención farmacéutica, productos sanitarios y educación sanitaria.'
        ),
        array(
            'codigo_familia' => 'SAN',
            'grado' => 'superior',
            'codigo' => 'HIGBU3',
            'nombre' => 'Técnico Superior en Higiene Bucodental',
            'descripcion' => 'Especialización en prevención oral, técnicas de higiene dental, educación sanitaria bucodental y asistencia dental.'
        ),
        array(
            'codigo_familia' => 'SAN',
            'grado' => 'superior',
            'codigo' => 'IDMN3',
            'nombre' => 'Técnico Superior en Imagen para el Diagnóstico y Medicina Nuclear',
            'descripcion' => 'Formación en radiodiagnóstico, TAC, resonancia magnética, medicina nuclear y protección radiológica.'
        ),
        array(
            'codigo_familia' => 'SAN',
            'grado' => 'superior',
            'codigo' => 'LACB3',
            'nombre' => 'Técnico Superior en Laboratorio Clínico y Biomédico',
            'descripcion' => 'Especialización en análisis clínicos, microbiología, inmunología, hematología y bioquímica clínica.'
        ),
        array(
            'codigo_familia' => 'SAN',
            'grado' => 'superior',
            'codigo' => 'OPAP3',
            'nombre' => 'Técnico Superior en Ortoprótesis y Productos de Apoyo',
            'descripcion' => 'Capacitación en diseño y adaptación de prótesis, órtesis, ayudas técnicas y productos de apoyo funcional.'
        ),
        array(
            'codigo_familia' => 'SAN',
            'grado' => 'superior',
            'codigo' => 'PRDE3',
            'nombre' => 'Técnico Superior en Prótesis Dentales',
            'descripcion' => 'Formación en diseño y fabricación de prótesis dentales, implantología, CAD/CAM dental y materiales odontológicos.'
        ),
        array(
            'codigo_familia' => 'SAN',
            'grado' => 'superior',
            'codigo' => 'RADO3',
            'nombre' => 'Técnico Superior en Radioterapia y Dosimetría',
            'descripcion' => 'Especialización en tratamientos radioterápicos, planificación dosimétrica, aceleradores lineales y radioprotección.'
        ),

        // ==========================================
        // SEGURIDAD Y MEDIO AMBIENTE (SEA)
        // ==========================================
        array(
            'codigo_familia' => 'SEA',
            'grado' => 'superior',
            'codigo' => 'CEPC3',
            'nombre' => 'Técnico Superior en Coordinación de Emergencias y Protección Civil',
            'descripcion' => 'Formación en gestión de emergencias, protección civil, planes de evacuación y coordinación de servicios de rescate.'
        ),
        array(
            'codigo_familia' => 'SEA',
            'grado' => 'superior',
            'codigo' => 'EDCA3',
            'nombre' => 'Técnico Superior en Educación y Control Ambiental',
            'descripcion' => 'Especialización en gestión ambiental, educación ecológica, control de contaminación y sostenibilidad.'
        ),
        array(
            'codigo_familia' => 'SEA',
            'grado' => 'medio',
            'codigo' => 'EPCI2',
            'nombre' => 'Técnico en Emergencias y Protección Civil',
            'descripcion' => 'Capacitación en prevención de riesgos, primeros auxilios, extinción de incendios y atención en emergencias.'
        ),
        array(
            'codigo_familia' => 'SEA',
            'grado' => 'superior',
            'codigo' => 'QSAM3',
            'nombre' => 'Técnico Superior en Química y Salud Ambiental',
            'descripcion' => 'Formación en análisis ambiental, control de contaminantes, toxicología ambiental y salud pública.'
        ),

        // ==========================================
        // SERVICIOS SOCIOCULTURALES Y A LA COMUNIDAD (SSC)
        // ==========================================
        array(
            'codigo_familia' => 'SSC',
            'grado' => 'basico',
            'codigo' => 'ADLE1',
            'nombre' => 'Profesional Básico en Actividades Domésticas y Limpieza de Edificios',
            'descripcion' => 'Formación básica en servicios de limpieza, mantenimiento doméstico y servicios auxiliares de hogar.'
        ),
        array(
            'codigo_familia' => 'SSC',
            'grado' => 'superior',
            'codigo' => 'ASTU3',
            'nombre' => 'Técnico Superior en Animación Sociocultural y Turística',
            'descripcion' => 'Especialización en dinamización comunitaria, turismo cultural, animación de grupos y gestión sociocultural.'
        ),
        array(
            'codigo_familia' => 'SSC',
            'grado' => 'superior',
            'codigo' => 'EDIN3',
            'nombre' => 'Técnico Superior en Educación Infantil',
            'descripcion' => 'Formación en atención educativa de niños de 0-6 años, desarrollo infantil, metodologías pedagógicas y familia.'
        ),
        array(
            'codigo_familia' => 'SSC',
            'grado' => 'superior',
            'codigo' => 'FMSS3',
            'nombre' => 'Técnico Superior en Formación para la Movilidad Segura y Sostenible',
            'descripcion' => 'Capacitación en educación vial, seguridad en el transporte, movilidad sostenible y prevención de accidentes.'
        ),
        array(
            'codigo_familia' => 'SSC',
            'grado' => 'superior',
            'codigo' => 'INSO3',
            'nombre' => 'Técnico Superior en Integración Social',
            'descripcion' => 'Especialización en trabajo social, integración de colectivos vulnerables, mediación social y programas de inserción.'
        ),
        array(
            'codigo_familia' => 'SSC',
            'grado' => 'superior',
            'codigo' => 'MECO3',
            'nombre' => 'Técnico Superior en Mediación Comunicativa',
            'descripcion' => 'Formación en interpretación de lengua de signos, mediación para personas sordociegas y comunicación accesible.'
        ),
        array(
            'codigo_familia' => 'SSC',
            'grado' => 'medio',
            'codigo' => 'PESD2',
            'nombre' => 'Técnico en Atención a Personas en Situación de Dependencia',
            'descripcion' => 'Capacitación en cuidado de personas dependientes, apoyo psicosocial, higiene personal y actividades de la vida diaria.'
        ),
        array(
            'codigo_familia' => 'SSC',
            'grado' => 'superior',
            'codigo' => 'PIGG3',
            'nombre' => 'Técnico Superior en Promoción de Igualdad de Género',
            'descripcion' => 'Especialización en políticas de igualdad, prevención de violencia de género, sensibilización y programas de igualdad.'
        ),

        // ==========================================
        // TEXTIL, CONFECCIÓN Y PIEL (TCP)
        // ==========================================
        array(
            'codigo_familia' => 'TCP',
            'grado' => 'basico',
            'codigo' => 'ARRE1',
            'nombre' => 'Profesional Básico en Arreglo y Reparación de Artículos Textiles y de Piel',
            'descripcion' => 'Formación básica en reparación de prendas, zurcido, arreglos de ropa y mantenimiento de artículos textiles.'
        ),
        array(
            'codigo_familia' => 'TCP',
            'grado' => 'medio',
            'codigo' => 'CACM2',
            'nombre' => 'Técnico en Calzado y Complementos de Moda',
            'descripcion' => 'Capacitación en diseño y fabricación de calzado, bolsos, cinturones y complementos de moda.'
        ),
        array(
            'codigo_familia' => 'TCP',
            'grado' => 'medio',
            'codigo' => 'COMO2',
            'nombre' => 'Técnico en Confección y Moda',
            'descripcion' => 'Formación en patronaje, corte, confección, acabados textiles y procesos de producción en la industria textil.'
        ),
        array(
            'codigo_familia' => 'TCP',
            'grado' => 'superior',
            'codigo' => 'DPCC3',
            'nombre' => 'Técnico Superior en Diseño y Producción de Calzado y Complementos',
            'descripcion' => 'Especialización en diseño de calzado, desarrollo de productos, procesos industriales y gestión de colecciones.'
        ),
        array(
            'codigo_familia' => 'TCP',
            'grado' => 'superior',
            'codigo' => 'DTTP3',
            'nombre' => 'Técnico Superior en Diseño Técnico en Textil y Piel',
            'descripcion' => 'Formación en diseño textil, desarrollo de tejidos, tecnología de materiales y innovación en textiles técnicos.'
        ),
        array(
            'codigo_familia' => 'TCP',
            'grado' => 'medio',
            'codigo' => 'FEPT2',
            'nombre' => 'Técnico en Fabricación y Ennoblecimiento de Productos Textiles',
            'descripcion' => 'Capacitación en hilatura, tejeduría, tintado, estampación y acabados textiles industriales.'
        ),
        array(
            'codigo_familia' => 'TCP',
            'grado' => 'superior',
            'codigo' => 'PAMO3',
            'nombre' => 'Técnico Superior en Patronaje y Moda',
            'descripcion' => 'Especialización en patronaje industrial, escalado, diseño de moda, prototipado y desarrollo de colecciones.'
        ),
        array(
            'codigo_familia' => 'TCP',
            'grado' => 'basico',
            'codigo' => 'TACO1',
            'nombre' => 'Profesional Básico en Tapicería y Cortinaje',
            'descripcion' => 'Formación básica en tapizado de muebles, confección de cortinas y elementos decorativos textiles.'
        ),
        array(
            'codigo_familia' => 'TCP',
            'grado' => 'superior',
            'codigo' => 'VMES3',
            'nombre' => 'Técnico Superior en Vestuario a Medida y de Espectáculos',
            'descripcion' => 'Capacitación en alta costura, vestuario teatral, caracterización y confección artesanal especializada.'
        ),

        // ==========================================
        // TRANSPORTE Y MANTENIMIENTO DE VEHÍCULOS (TMV)
        // ==========================================
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'superior',
            'codigo' => 'APDR3',
            'nombre' => 'Curso de Especialización en Aeronaves Pilotadas de Forma Remota-Drones',
            'descripcion' => 'Formación avanzada en pilotaje de drones, aplicaciones profesionales, normativa aeronáutica y sistemas RPAS.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'superior',
            'codigo' => 'AUTO3',
            'nombre' => 'Técnico Superior en Automoción',
            'descripcion' => 'Especialización en diagnóstico avanzado, sistemas electrónicos del automóvil, gestión de talleres y nuevas tecnologías.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'medio',
            'codigo' => 'CARR2',
            'nombre' => 'Técnico en Carrocería',
            'descripcion' => 'Formación en reparación de carrocerías, chapa y pintura, restauración de vehículos y técnicas de embellecimiento.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'medio',
            'codigo' => 'CVTC2',
            'nombre' => 'Técnico en Conducción de Vehículos de Transporte por Carretera',
            'descripcion' => 'Capacitación en conducción profesional, transporte de mercancías y viajeros, logística y seguridad vial.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'medio',
            'codigo' => 'ELMA2',
            'nombre' => 'Técnico en Electromecánica de Maquinaria',
            'descripcion' => 'Formación en mantenimiento de maquinaria agrícola, industrial y de obras públicas.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'medio',
            'codigo' => 'ELVA2',
            'nombre' => 'Técnico en Electromecánica de Vehículos Automóviles',
            'descripcion' => 'Capacitación en mecánica del automóvil, sistemas eléctricos, diagnóstico y reparación de vehículos.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'superior',
            'codigo' => 'MAAP3',
            'nombre' => 'Técnico Superior en Mantenimiento Aeromecánico de Aviones con Motor de Pistón',
            'descripcion' => 'Especialización en mantenimiento de aviación ligera, motores de pistón, sistemas de aeronaves pequeñas.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'superior',
            'codigo' => 'MAAT3',
            'nombre' => 'Técnico Superior en Mantenimiento Aeromecánico de Aviones con Motor de Turbina',
            'descripcion' => 'Formación en mantenimiento de aviación comercial, motores de turbina, sistemas complejos de aeronaves.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'medio',
            'codigo' => 'MAER2',
            'nombre' => 'Técnico en Mantenimiento de Embarcaciones de Recreo',
            'descripcion' => 'Capacitación en reparación y mantenimiento de embarcaciones deportivas, motores marinos y sistemas náuticos.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'superior',
            'codigo' => 'MAHP3',
            'nombre' => 'Técnico Superior en Mantenimiento Aeromecánico de Helicópteros con Motor de Pistón',
            'descripcion' => 'Especialización en mantenimiento de helicópteros ligeros, rotores, transmisiones y sistemas específicos.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'superior',
            'codigo' => 'MAHT3',
            'nombre' => 'Técnico Superior en Mantenimiento Aeromecánico de Helicópteros con Motor de Turbina',
            'descripcion' => 'Formación en mantenimiento de helicópteros comerciales, sistemas complejos y turbinas de helicópteros.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'superior',
            'codigo' => 'MAMR3',
            'nombre' => 'Curso de Especialización en Mantenimiento Avanzado de Sistemas de Material Rodante Ferroviario',
            'descripcion' => 'Especialización en trenes de alta velocidad, material rodante ferroviario y sistemas de tracción eléctrica.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'basico',
            'codigo' => 'MAVE1',
            'nombre' => 'Profesional Básico en Mantenimiento de Vehículos',
            'descripcion' => 'Formación básica en operaciones auxiliares de mantenimiento de vehículos, limpieza y tareas elementales.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'medio',
            'codigo' => 'MEME2',
            'nombre' => 'Técnico en Mantenimiento de Estructuras de Madera y Mobiliario de Embarcaciones de Recreo',
            'descripcion' => 'Capacitación en carpintería naval, restauración de embarcaciones de madera y mobiliario náutico.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'medio',
            'codigo' => 'MESA2_TMV',
            'nombre' => 'Técnico en Montaje de Estructuras e Instalación de Sistemas Aeronáuticos',
            'descripcion' => 'Formación en montaje de fuselajes, instalación de sistemas aeronáuticos y ensamblaje de aeronaves.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'medio',
            'codigo' => 'MMRF2',
            'nombre' => 'Técnico en Mantenimiento de Material Rodante Ferroviario',
            'descripcion' => 'Capacitación en mantenimiento de trenes, material ferroviario, sistemas de tracción y seguridad ferroviaria.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'superior',
            'codigo' => 'MSEA3',
            'nombre' => 'Técnico Superior en Mantenimiento de Sistemas Electrónicos y Aviónicos en Aeronaves',
            'descripcion' => 'Especialización en aviónica, sistemas electrónicos de vuelo, navegación y comunicaciones aeronáuticas.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'medio',
            'codigo' => 'MVHE2',
            'nombre' => 'Curso de Especialización en Mantenimiento de Vehículos Híbridos y Eléctricos',
            'descripcion' => 'Formación en tecnologías de vehículos eléctricos, sistemas híbridos, baterías y puntos de recarga.'
        ),
        array(
            'codigo_familia' => 'TMV',
            'grado' => 'superior',
            'codigo' => 'SVHE3',
            'nombre' => 'Curso de Especialización en Mantenimiento y Seguridad en Sistemas de Vehículos Híbridos y Eléctricos',
            'descripcion' => 'Especialización avanzada en seguridad en alta tensión, diagnóstico de vehículos eléctricos y sistemas inteligentes.'
        ),

        // ==========================================
        // VIDRIO Y CERÁMICA (VIC)
        // ==========================================
        array(
            'codigo_familia' => 'VIC',
            'grado' => 'superior',
            'codigo' => 'DFPC3',
            'nombre' => 'Técnico Superior en Desarrollo y Fabricación de Productos Cerámicos',
            'descripcion' => 'Especialización en diseño cerámico, procesos industriales, control de calidad y desarrollo de nuevos materiales cerámicos.'
        ),
        array(
            'codigo_familia' => 'VIC',
            'grado' => 'medio',
            'codigo' => 'FAPC2',
            'nombre' => 'Técnico en Fabricación de Productos Cerámicos',
            'descripcion' => 'Formación en procesos de fabricación cerámica, moldeo, cocción, esmaltado y acabados cerámicos.'
        ),
        array(
            'codigo_familia' => 'VIC',
            'grado' => 'basico',
            'codigo' => 'VIAL1',
            'nombre' => 'Profesional Básico en Vidriería y Alfarería',
            'descripcion' => 'Capacitación básica en técnicas de vidriería, alfarería tradicional, moldeo y decoración cerámica artesanal.'
        )
    );

}
