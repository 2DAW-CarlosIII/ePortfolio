<?php

namespace Database\Seeders;

use App\Models\CicloFormativo;
use App\Models\ModuloFormativo;
use Illuminate\Database\Seeder;

class ModuloFormativoSeeder extends Seeder
{
    public function run(): void
    {

        $ciclosFormativosIds = CicloFormativo::pluck('id', 'codigo')->toArray();
        foreach (self::$modulos_formativos as $moduloFormativo) {
            $moduloFormativo['ciclo_formativo_id'] = $ciclosFormativosIds[$moduloFormativo['codigo_ciclo']];
            unset($moduloFormativo['codigo_ciclo']);
            ModuloFormativo::create($moduloFormativo);
        }
    }

    public static $modulos_formativos = array(
        // ==========================================
        // TÉCNICO SUPERIOR EN DESARROLLO DE APLICACIONES WEB (DAPW3)
        // ==========================================
        array(
            'codigo_ciclo' => 'DAPW3',
            'nombre' => 'Sistemas Informáticos',
            'codigo' => '0483',
            'horas_totales' => 165,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Análisis de sistemas informáticos, instalación y configuración de sistemas operativos, virtualización y administración básica de sistemas.'
        ),
        array(
            'codigo_ciclo' => 'DAPW3',
            'nombre' => 'Bases de Datos',
            'codigo' => '0484',
            'horas_totales' => 187,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Diseño y administración de bases de datos relacionales, lenguaje SQL, normalización, procedimientos almacenados y optimización de consultas.'
        ),
        array(
            'codigo_ciclo' => 'DAPW3',
            'nombre' => 'Programación',
            'codigo' => '0485',
            'horas_totales' => 269,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Fundamentos de programación orientada a objetos, estructuras de datos, algoritmos, patrones de diseño y desarrollo de aplicaciones básicas.'
        ),
        array(
            'codigo_ciclo' => 'DAPW3',
            'nombre' => 'Lenguajes de Marcas y Sistemas de Gestión de Información',
            'codigo' => '0373',
            'horas_totales' => 133,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'HTML, CSS, XML, JSON, transformación de documentos, sistemas de gestión de contenidos y tecnologías de marcado para web.'
        ),
        array(
            'codigo_ciclo' => 'DAPW3',
            'nombre' => 'Entornos de Desarrollo',
            'codigo' => '0487',
            'horas_totales' => 99,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Herramientas de desarrollo, control de versiones, depuración, testing, documentación y metodologías de desarrollo de software.'
        ),
        array(
            'codigo_ciclo' => 'DAPW3',
            'nombre' => 'Desarrollo Web en Entorno Cliente',
            'codigo' => '0612',
            'horas_totales' => 157,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'JavaScript, DOM, eventos, AJAX, frameworks frontend, librerías de interfaz de usuario y desarrollo de aplicaciones web interactivas.'
        ),
        array(
            'codigo_ciclo' => 'DAPW3',
            'nombre' => 'Desarrollo Web en Entorno Servidor',
            'codigo' => '0613',
            'horas_totales' => 165,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'PHP, ASP.NET, frameworks backend, servicios web, APIs REST, seguridad web y desarrollo de aplicaciones server-side.'
        ),
        array(
            'codigo_ciclo' => 'DAPW3',
            'nombre' => 'Despliegue de Aplicaciones Web',
            'codigo' => '0614',
            'horas_totales' => 99,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Servidores web, virtualización, contenedores, CI/CD, monitorización y administración de aplicaciones web en producción.'
        ),
        array(
            'codigo_ciclo' => 'DAPW3',
            'nombre' => 'Diseño de Interfaces Web',
            'codigo' => '0615',
            'horas_totales' => 157,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'UX/UI, diseño responsive, accesibilidad web, usabilidad, herramientas de diseño y prototipado de interfaces web.'
        ),
        array(
            'codigo_ciclo' => 'DAPW3',
            'nombre' => 'Empresa e Iniciativa Emprendedora',
            'codigo' => '0617',
            'horas_totales' => 66,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Plan de empresa, iniciativa emprendedora, gestión empresarial, aspectos fiscales y laborales del emprendimiento tecnológico.'
        ),
        array(
            'codigo_ciclo' => 'DAPW3',
            'nombre' => 'Formación y Orientación Laboral',
            'codigo' => '0616',
            'horas_totales' => 99,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Derecho laboral, contratos, seguridad social, prevención de riesgos laborales, búsqueda de empleo y orientación profesional.'
        ),
        array(
            'codigo_ciclo' => 'DAPW3',
            'nombre' => 'Formación en Centros de Trabajo',
            'codigo' => '0618',
            'horas_totales' => 370,
            'curso_escolar' => '2º',
            'centro' => 'Empresa',
            'descripcion' => 'Prácticas profesionales en empresas del sector TIC, aplicación de conocimientos adquiridos en entorno laboral real.'
        ),

        // ==========================================
        // TÉCNICO SUPERIOR EN DESARROLLO DE APLICACIONES MULTIPLATAFORMA (DAPM3)
        // ==========================================
        array(
            'codigo_ciclo' => 'DAPM3',
            'nombre' => 'Sistemas Informáticos',
            'codigo' => '0483',
            'horas_totales' => 165,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Análisis de sistemas informáticos, instalación y configuración de sistemas operativos, virtualización y administración básica de sistemas.'
        ),
        array(
            'codigo_ciclo' => 'DAPM3',
            'nombre' => 'Bases de Datos',
            'codigo' => '0484',
            'horas_totales' => 187,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Diseño y administración de bases de datos relacionales, lenguaje SQL, normalización, procedimientos almacenados y optimización de consultas.'
        ),
        array(
            'codigo_ciclo' => 'DAPM3',
            'nombre' => 'Programación',
            'codigo' => '0485',
            'horas_totales' => 269,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Fundamentos de programación orientada a objetos con Java, estructuras de datos, algoritmos, patrones de diseño y desarrollo de aplicaciones.'
        ),
        array(
            'codigo_ciclo' => 'DAPM3',
            'nombre' => 'Lenguajes de Marcas y Sistemas de Gestión de Información',
            'codigo' => '0373',
            'horas_totales' => 133,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'HTML, CSS, XML, JSON, transformación de documentos, sistemas de gestión de contenidos y tecnologías de marcado.'
        ),
        array(
            'codigo_ciclo' => 'DAPM3',
            'nombre' => 'Entornos de Desarrollo',
            'codigo' => '0487',
            'horas_totales' => 99,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'IDEs, control de versiones, depuración, testing automatizado, documentación y metodologías de desarrollo de software.'
        ),
        array(
            'codigo_ciclo' => 'DAPM3',
            'nombre' => 'Acceso a Datos',
            'codigo' => '0486',
            'horas_totales' => 132,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Conectores de base de datos, ORM, manejo de ficheros, bases de datos objeto-relacionales y acceso a servicios web.'
        ),
        array(
            'codigo_ciclo' => 'DAPM3',
            'nombre' => 'Desarrollo de Interfaces',
            'codigo' => '0488',
            'horas_totales' => 132,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Interfaces gráficas de usuario, componentes visuales, usabilidad, accesibilidad y desarrollo de aplicaciones de escritorio.'
        ),
        array(
            'codigo_ciclo' => 'DAPM3',
            'nombre' => 'Programación Multimedia y Dispositivos Móviles',
            'codigo' => '0489',
            'horas_totales' => 132,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Desarrollo para Android, iOS, aplicaciones híbridas, multimedia, sensores de dispositivos móviles y publicación en stores.'
        ),
        array(
            'codigo_ciclo' => 'DAPM3',
            'nombre' => 'Programación de Servicios y Procesos',
            'codigo' => '0490',
            'horas_totales' => 99,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Programación concurrente, hilos, procesos, comunicaciones de red, servicios web y arquitecturas distribuidas.'
        ),
        array(
            'codigo_ciclo' => 'DAPM3',
            'nombre' => 'Sistemas de Gestión Empresarial',
            'codigo' => '0491',
            'horas_totales' => 99,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'ERP, CRM, implantación y customización de sistemas empresariales, integración de aplicaciones empresariales.'
        ),
        array(
            'codigo_ciclo' => 'DAPM3',
            'nombre' => 'Empresa e Iniciativa Emprendedora',
            'codigo' => '0617',
            'horas_totales' => 66,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Plan de empresa, iniciativa emprendedora, gestión empresarial, aspectos fiscales y laborales del emprendimiento tecnológico.'
        ),
        array(
            'codigo_ciclo' => 'DAPM3',
            'nombre' => 'Formación y Orientación Laboral',
            'codigo' => '0616',
            'horas_totales' => 99,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Derecho laboral, contratos, seguridad social, prevención de riesgos laborales, búsqueda de empleo y orientación profesional.'
        ),
        array(
            'codigo_ciclo' => 'DAPM3',
            'nombre' => 'Formación en Centros de Trabajo',
            'codigo' => '0618',
            'horas_totales' => 370,
            'curso_escolar' => '2º',
            'centro' => 'Empresa',
            'descripcion' => 'Prácticas profesionales en empresas del sector TIC, aplicación de conocimientos adquiridos en entorno laboral real.'
        ),

        // ==========================================
        // TÉCNICO SUPERIOR EN ADMINISTRACIÓN DE SISTEMAS INFORMÁTICOS EN RED (ASIR3)
        // ==========================================
        array(
            'codigo_ciclo' => 'ASIR3',
            'nombre' => 'Implantación de Sistemas Operativos',
            'codigo' => '0369',
            'horas_totales' => 231,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Instalación y configuración de sistemas operativos Windows y Linux, gestión de usuarios, permisos y políticas de seguridad.'
        ),
        array(
            'codigo_ciclo' => 'ASIR3',
            'nombre' => 'Planificación y Administración de Redes',
            'codigo' => '0370',
            'horas_totales' => 231,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Diseño e implementación de redes locales, protocolos TCP/IP, enrutamiento, VLANs y administración de infraestructuras de red.'
        ),
        array(
            'codigo_ciclo' => 'ASIR3',
            'nombre' => 'Fundamentos de Hardware',
            'codigo' => '0371',
            'horas_totales' => 99,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Arquitectura de computadores, componentes hardware, ensamblaje, configuración y mantenimiento de equipos informáticos.'
        ),
        array(
            'codigo_ciclo' => 'ASIR3',
            'nombre' => 'Gestión de Bases de Datos',
            'codigo' => '0372',
            'horas_totales' => 132,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Administración de SGBD, backup y recovery, optimización, seguridad de bases de datos y administración avanzada.'
        ),
        array(
            'codigo_ciclo' => 'ASIR3',
            'nombre' => 'Lenguajes de Marcas y Sistemas de Gestión de Información',
            'codigo' => '0373',
            'horas_totales' => 132,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'HTML, CSS, XML, JSON, transformación de documentos, sistemas de gestión de contenidos y tecnologías de marcado.'
        ),
        array(
            'codigo_ciclo' => 'ASIR3',
            'nombre' => 'Administración de Sistemas Operativos',
            'codigo' => '0374',
            'horas_totales' => 132,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Administración avanzada de Windows Server y Linux, servicios de directorio, automatización y scripting de administración.'
        ),
        array(
            'codigo_ciclo' => 'ASIR3',
            'nombre' => 'Servicios de Red e Internet',
            'codigo' => '0375',
            'horas_totales' => 132,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Configuración de servicios DNS, DHCP, web, correo, proxy, FTP y administración de servidores de aplicaciones.'
        ),
        array(
            'codigo_ciclo' => 'ASIR3',
            'nombre' => 'Implantación de Aplicaciones Web',
            'codigo' => '0376',
            'horas_totales' => 99,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Instalación y configuración de aplicaciones web, servidores de aplicaciones, gestores de contenido y comercio electrónico.'
        ),
        array(
            'codigo_ciclo' => 'ASIR3',
            'nombre' => 'Administración de Sistemas Gestores de Bases de Datos',
            'codigo' => '0377',
            'horas_totales' => 66,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Administración avanzada de SGBD, alta disponibilidad, replicación, clustering y optimización de rendimiento.'
        ),
        array(
            'codigo_ciclo' => 'ASIR3',
            'nombre' => 'Seguridad y Alta Disponibilidad',
            'codigo' => '0378',
            'horas_totales' => 99,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Seguridad informática, cortafuegos, IDS/IPS, sistemas de alta disponibilidad, backup, disaster recovery y auditorías.'
        ),
        array(
            'codigo_ciclo' => 'ASIR3',
            'nombre' => 'Empresa e Iniciativa Emprendedora',
            'codigo' => '0617',
            'horas_totales' => 66,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Plan de empresa, iniciativa emprendedora, gestión empresarial, aspectos fiscales y laborales del emprendimiento tecnológico.'
        ),
        array(
            'codigo_ciclo' => 'ASIR3',
            'nombre' => 'Formación y Orientación Laboral',
            'codigo' => '0616',
            'horas_totales' => 99,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Derecho laboral, contratos, seguridad social, prevención de riesgos laborales, búsqueda de empleo y orientación profesional.'
        ),
        array(
            'codigo_ciclo' => 'ASIR3',
            'nombre' => 'Formación en Centros de Trabajo',
            'codigo' => '0618',
            'horas_totales' => 370,
            'curso_escolar' => '2º',
            'centro' => 'Empresa',
            'descripcion' => 'Prácticas profesionales en empresas del sector TIC, aplicación de conocimientos adquiridos en entorno laboral real.'
        ),

        // ==========================================
        // TÉCNICO EN SISTEMAS MICROINFORMÁTICOS Y REDES (SMIR2)
        // ==========================================
        array(
            'codigo_ciclo' => 'SMIR2',
            'nombre' => 'Montaje y Mantenimiento de Equipos',
            'codigo' => '0221',
            'horas_totales' => 224,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Ensamblaje de equipos informáticos, instalación de componentes, mantenimiento preventivo y correctivo de hardware.'
        ),
        array(
            'codigo_ciclo' => 'SMIR2',
            'nombre' => 'Sistemas Operativos Monopuesto',
            'codigo' => '0222',
            'horas_totales' => 160,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Instalación y configuración de sistemas operativos de usuario, gestión de archivos, usuarios y configuración básica.'
        ),
        array(
            'codigo_ciclo' => 'SMIR2',
            'nombre' => 'Aplicaciones Ofimáticas',
            'codigo' => '0223',
            'horas_totales' => 224,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Procesadores de texto, hojas de cálculo, presentaciones, bases de datos básicas y herramientas de oficina.'
        ),
        array(
            'codigo_ciclo' => 'SMIR2',
            'nombre' => 'Sistemas Operativos en Red',
            'codigo' => '0224',
            'horas_totales' => 147,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Administración básica de Windows Server y Linux, servicios de red básicos, compartición de recursos.'
        ),
        array(
            'codigo_ciclo' => 'SMIR2',
            'nombre' => 'Redes Locales',
            'codigo' => '0225',
            'horas_totales' => 224,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Instalación y configuración de redes locales, cableado estructurado, protocolos de red y dispositivos de interconexión.'
        ),
        array(
            'codigo_ciclo' => 'SMIR2',
            'nombre' => 'Seguridad Informática',
            'codigo' => '0226',
            'horas_totales' => 105,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Fundamentos de seguridad informática, antivirus, cortafuegos personales, copias de seguridad y protección de datos.'
        ),
        array(
            'codigo_ciclo' => 'SMIR2',
            'nombre' => 'Servicios en Red',
            'codigo' => '0227',
            'horas_totales' => 147,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Configuración de servicios básicos de red: DNS, DHCP, web, correo electrónico y servicios de transferencia.'
        ),
        array(
            'codigo_ciclo' => 'SMIR2',
            'nombre' => 'Aplicaciones Web',
            'codigo' => '0228',
            'horas_totales' => 84,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Instalación y configuración de aplicaciones web, gestores de contenido, comercio electrónico básico.'
        ),
        array(
            'codigo_ciclo' => 'SMIR2',
            'nombre' => 'Empresa e Iniciativa Emprendedora',
            'codigo' => '0617',
            'horas_totales' => 63,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Plan de empresa, iniciativa emprendedora, gestión empresarial, aspectos fiscales y laborales del emprendimiento.'
        ),
        array(
            'codigo_ciclo' => 'SMIR2',
            'nombre' => 'Formación y Orientación Laboral',
            'codigo' => '0616',
            'horas_totales' => 96,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Derecho laboral, contratos, seguridad social, prevención de riesgos laborales, búsqueda de empleo y orientación profesional.'
        ),
        array(
            'codigo_ciclo' => 'SMIR2',
            'nombre' => 'Formación en Centros de Trabajo',
            'codigo' => '0618',
            'horas_totales' => 350,
            'curso_escolar' => '2º',
            'centro' => 'Empresa',
            'descripcion' => 'Prácticas profesionales en empresas del sector TIC, aplicación de conocimientos adquiridos en entorno laboral real.'
        ),

        // ==========================================
        // CURSO DE ESPECIALIZACIÓN EN CIBERSEGURIDAD EN ENTORNOS DE LAS TECNOLOGÍAS DE LA INFORMACIÓN (CIIN3)
        // ==========================================
        array(
            'codigo_ciclo' => 'CIIN3',
            'nombre' => 'Incidentes de Ciberseguridad',
            'codigo' => 'CE01',
            'horas_totales' => 99,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Detección, análisis y respuesta a incidentes de seguridad, forensia digital, análisis de malware y gestión de crisis.'
        ),
        array(
            'codigo_ciclo' => 'CIIN3',
            'nombre' => 'Bastionado de Redes y Sistemas',
            'codigo' => 'CE02',
            'horas_totales' => 132,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Hardening de sistemas operativos, configuración segura de servicios, análisis de vulnerabilidades y pentesting.'
        ),
        array(
            'codigo_ciclo' => 'CIIN3',
            'nombre' => 'Puesta en Producción Segura',
            'codigo' => 'CE03',
            'horas_totales' => 99,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'DevSecOps, seguridad en CI/CD, análisis de código estático y dinámico, contenedores seguros.'
        ),
        array(
            'codigo_ciclo' => 'CIIN3',
            'nombre' => 'Análisis Forense Informático',
            'codigo' => 'CE04',
            'horas_totales' => 66,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Técnicas de análisis forense, recuperación de datos, cadena de custodia, herramientas forenses y peritaje.'
        ),
        array(
            'codigo_ciclo' => 'CIIN3',
            'nombre' => 'Hacking Ético',
            'codigo' => 'CE05',
            'horas_totales' => 132,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Técnicas de pentesting, OWASP, testing de aplicaciones web, ingeniería social y evaluación de seguridad.'
        ),
        array(
            'codigo_ciclo' => 'CIIN3',
            'nombre' => 'Normativa de Ciberseguridad',
            'codigo' => 'CE06',
            'horas_totales' => 66,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Marco legal de ciberseguridad, RGPD, esquemas nacionales de seguridad, auditorías y cumplimiento normativo.'
        ),
        // ==========================================
        // CURSO DE ESPECIALIZACIÓN EN INTELIGENCIA ARTIFICIAL Y BIG DATA (IABD3) - CONTINUACIÓN
        // ==========================================
        array(
            'codigo_ciclo' => 'IABD3',
            'nombre' => 'Modelos de Inteligencia Artificial',
            'codigo' => 'IA04',
            'horas_totales' => 99,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Diseño y entrenamiento de modelos de IA, optimización de hiperparámetros, validación cruzada y métricas de evaluación.'
        ),
        array(
            'codigo_ciclo' => 'IABD3',
            'nombre' => 'Sistemas de Datos',
            'codigo' => 'IA05',
            'horas_totales' => 66,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'ETL, calidad de datos, data warehousing, data lakes, ingeniería de datos y pipelines de procesamiento.'
        ),
        array(
            'codigo_ciclo' => 'IABD3',
            'nombre' => 'Formación en Centros de Trabajo',
            'codigo' => '0618',
            'horas_totales' => 370,
            'curso_escolar' => '1º',
            'centro' => 'Empresa',
            'descripcion' => 'Prácticas profesionales especializadas en IA y Big Data en empresas del sector tecnológico.'
        ),

        // ==========================================
        // CURSO DE ESPECIALIZACIÓN EN DESARROLLO DE VIDEOJUEGOS Y REALIDAD VIRTUAL (DVRV3)
        // ==========================================
        array(
            'codigo_ciclo' => 'DVRV3',
            'nombre' => 'Desarrollo de Videojuegos Multiplataforma',
            'codigo' => 'VR01',
            'horas_totales' => 165,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Unity, Unreal Engine, programación de gameplay, mecánicas de juego, optimización y publicación en diferentes plataformas.'
        ),
        array(
            'codigo_ciclo' => 'DVRV3',
            'nombre' => 'Motores de Videojuegos',
            'codigo' => 'VR02',
            'horas_totales' => 132,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Arquitectura de motores gráficos, sistemas de renderizado, física, audio y optimización de rendimiento.'
        ),
        array(
            'codigo_ciclo' => 'DVRV3',
            'nombre' => 'Realidad Virtual, Aumentada y Mixta',
            'codigo' => 'VR03',
            'horas_totales' => 132,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Desarrollo para VR/AR/MR, SDKs específicos, interfaces inmersivas, tracking y dispositivos de realidad extendida.'
        ),
        array(
            'codigo_ciclo' => 'DVRV3',
            'nombre' => 'Diseño de Experiencias Inmersivas',
            'codigo' => 'VR04',
            'horas_totales' => 99,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'UX para VR/AR, diseño de interacciones inmersivas, narrativa interactiva y experiencia de usuario en 3D.'
        ),
        array(
            'codigo_ciclo' => 'DVRV3',
            'nombre' => 'Programación de Gráficos 3D',
            'codigo' => 'VR05',
            'horas_totales' => 66,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'OpenGL, DirectX, shaders, técnicas de renderizado avanzado, iluminación y efectos visuales.'
        ),
        array(
            'codigo_ciclo' => 'DVRV3',
            'nombre' => 'Formación en Centros de Trabajo',
            'codigo' => '0618',
            'horas_totales' => 370,
            'curso_escolar' => '1º',
            'centro' => 'Empresa',
            'descripcion' => 'Prácticas profesionales en estudios de videojuegos, empresas de VR/AR o departamentos de innovación tecnológica.'
        ),

        // ==========================================
        // PROFESIONAL BÁSICO EN INFORMÁTICA Y COMUNICACIONES (INCO1)
        // ==========================================
        array(
            'codigo_ciclo' => 'INCO1',
            'nombre' => 'Montaje y Mantenimiento de Sistemas y Componentes Informáticos',
            'codigo' => '3029',
            'horas_totales' => 352,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Ensamblaje básico de equipos, identificación de componentes, mantenimiento preventivo y resolución de problemas hardware.'
        ),
        array(
            'codigo_ciclo' => 'INCO1',
            'nombre' => 'Operaciones Auxiliares para la Configuración y la Explotación',
            'codigo' => '3030',
            'horas_totales' => 192,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Instalación básica de sistemas operativos, configuración elemental, copias de seguridad y operaciones de usuario.'
        ),
        array(
            'codigo_ciclo' => 'INCO1',
            'nombre' => 'Ofimática y Archivo de Documentos',
            'codigo' => '3031',
            'horas_totales' => 224,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Procesamiento de textos básico, hojas de cálculo simples, presentaciones, archivo digital y gestión documental básica.'
        ),
        array(
            'codigo_ciclo' => 'INCO1',
            'nombre' => 'Instalación y Mantenimiento de Redes para Transmisión de Datos',
            'codigo' => '3032',
            'horas_totales' => 256,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Cableado estructurado básico, conectores, instalación de redes domésticas y mantenimiento elemental de infraestructuras.'
        ),
        array(
            'codigo_ciclo' => 'INCO1',
            'nombre' => 'Comunicación y Ciencias Sociales I',
            'codigo' => '3009',
            'horas_totales' => 160,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Competencias de comunicación oral y escrita, técnicas de estudio, geografía e historia contemporánea.'
        ),
        array(
            'codigo_ciclo' => 'INCO1',
            'nombre' => 'Comunicación y Ciencias Sociales II',
            'codigo' => '3019',
            'horas_totales' => 190,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Desarrollo de competencias comunicativas avanzadas, ciencias sociales aplicadas y preparación para estudios superiores.'
        ),
        array(
            'codigo_ciclo' => 'INCO1',
            'nombre' => 'Ciencias Aplicadas I',
            'codigo' => '3011',
            'horas_totales' => 160,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Matemáticas aplicadas, física y química básicas orientadas al ámbito profesional de las TIC.'
        ),
        array(
            'codigo_ciclo' => 'INCO1',
            'nombre' => 'Ciencias Aplicadas II',
            'codigo' => '3021',
            'horas_totales' => 190,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Profundización en matemáticas y ciencias aplicadas, estadística básica y resolución de problemas técnicos.'
        ),
        array(
            'codigo_ciclo' => 'INCO1',
            'nombre' => 'Formación en Centros de Trabajo',
            'codigo' => '3033',
            'horas_totales' => 240,
            'curso_escolar' => '2º',
            'centro' => 'Empresa',
            'descripcion' => 'Prácticas básicas en empresas del sector TIC, familiarización con el entorno laboral y aplicación de competencias básicas.'
        ),

        // ==========================================
        // PROFESIONAL BÁSICO EN INFORMÁTICA DE OFICINA (INOF1)
        // ==========================================
        array(
            'codigo_ciclo' => 'INOF1',
            'nombre' => 'Tratamiento Informático de Datos',
            'codigo' => '3034',
            'horas_totales' => 320,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Introducción a la informática, sistemas operativos básicos, tratamiento de datos y operaciones informáticas elementales.'
        ),
        array(
            'codigo_ciclo' => 'INOF1',
            'nombre' => 'Aplicaciones Básicas de Ofimática',
            'codigo' => '3035',
            'horas_totales' => 352,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Procesador de textos, hojas de cálculo, presentaciones, correo electrónico y herramientas básicas de oficina.'
        ),
        array(
            'codigo_ciclo' => 'INOF1',
            'nombre' => 'Archivo y Comunicación',
            'codigo' => '3036',
            'horas_totales' => 224,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Gestión documental básica, archivo físico y digital, técnicas de comunicación y atención básica al cliente.'
        ),
        array(
            'codigo_ciclo' => 'INOF1',
            'nombre' => 'Montaje y Mantenimiento de Sistemas y Componentes Informáticos',
            'codigo' => '3029',
            'horas_totales' => 128,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Conocimientos básicos de hardware, identificación de componentes y operaciones elementales de mantenimiento.'
        ),
        array(
            'codigo_ciclo' => 'INOF1',
            'nombre' => 'Comunicación y Ciencias Sociales I',
            'codigo' => '3009',
            'horas_totales' => 160,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Competencias de comunicación oral y escrita, técnicas de estudio, geografía e historia contemporánea.'
        ),
        array(
            'codigo_ciclo' => 'INOF1',
            'nombre' => 'Comunicación y Ciencias Sociales II',
            'codigo' => '3019',
            'horas_totales' => 190,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Desarrollo de competencias comunicativas avanzadas, ciencias sociales aplicadas y preparación para estudios superiores.'
        ),
        array(
            'codigo_ciclo' => 'INOF1',
            'nombre' => 'Ciencias Aplicadas I',
            'codigo' => '3011',
            'horas_totales' => 160,
            'curso_escolar' => '1º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Matemáticas aplicadas, física y química básicas orientadas al ámbito administrativo y ofimático.'
        ),
        array(
            'codigo_ciclo' => 'INOF1',
            'nombre' => 'Ciencias Aplicadas II',
            'codigo' => '3021',
            'horas_totales' => 190,
            'curso_escolar' => '2º',
            'centro' => 'CIFP Carlos III',
            'descripcion' => 'Profundización en matemáticas y ciencias aplicadas, estadística básica y resolución de problemas administrativos.'
        ),
        array(
            'codigo_ciclo' => 'INOF1',
            'nombre' => 'Formación en Centros de Trabajo',
            'codigo' => '3037',
            'horas_totales' => 240,
            'curso_escolar' => '2º',
            'centro' => 'Empresa',
            'descripcion' => 'Prácticas en oficinas y departamentos administrativos, aplicación de competencias ofimáticas en entorno real.'
        )
    );

}
