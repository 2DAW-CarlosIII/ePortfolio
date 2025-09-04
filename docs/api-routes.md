# ePortfolio API Routes

Documentación generada automáticamente el 2025-09-04 17:15:35

## Base URL

```
http://localhost:8000/api/v1
```

## Autenticación

Todas las rutas (excepto las públicas) requieren autenticación via Laravel Sanctum.

```bash
curl -H "Authorization: Bearer {token}" http://localhost:8000/api/v1/endpoint
```

## Rutas Principales

### Health Check

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/health` | Estado de la API |
| GET | `/ping` | Ping público |

### Estadísticas

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/stats` | Estadísticas generales |
| GET | `/stats/estudiantes` | Stats de estudiantes |
| GET | `/stats/evidencias` | Stats de evidencias |

### Recursos API

#### Rutas Estándar

| Recurso | Endpoints |
|---------|-----------|
| FamiliaProfesional | `GET,POST /familias-profesionales` <br> `GET,PUT,DELETE /familias-profesionales/{id}` |
| Rol | `GET,POST /roles` <br> `GET,PUT,DELETE /roles/{id}` |

#### Rutas Anidadas

| Recurso | Parent | Endpoints |
|---------|--------|-----------|
| CicloFormativo | FamiliaProfesional | `GET,POST /familias-profesionales/{parent_id}/ciclos-formativos` <br> `GET,PUT,DELETE /familias-profesionales/{parent_id}/ciclos-formativos/{id}` |



| ModuloFormativo | CicloFormativo | `GET,POST /ciclos-formativos/{parent_id}/modulos-formativos` <br> `GET,PUT,DELETE /ciclos-formativos/{parent_id}/modulos-formativos/{id}` |
| ResultadoAprendizaje | ModuloFormativo | `GET,POST /modulos-formativos/{id}/resultados-aprendizaje` <br> `GET,PUT,DELETE /modulos-formativos/{parent_id}/resultados-aprendizaje/{id}` |
| CriteriosEvaluacion | ResultadoAprendizaje | `GET,POST /resultados-aprendizaje/{id}/criterios-evaluacion` <br> `GET,PUT,DELETE /resultados-aprendizaje/{parent_id}/criterios-evaluacion/{id}` |
| Matricula | ModuloFormativo | `GET,POST /modulos-formativos/{parent_id}/matriculas` <br> `GET,PUT,DELETE /modulos-formativos/{parent_id}/matriculas/{id}` |
| Tarea | CriteriosEvaluacion | `GET,POST /criterios-evaluacion/{parent_id}/tareas` <br> `GET,PUT,DELETE /criterios-evaluacion/{parent_id}/tareas/{id}` |
| Evidencia | Tarea | `GET,POST /tareas/{parent_id}/evidencias` <br> `GET,PUT,DELETE /tareas/{parent_id}/evidencias/{id}` |
| EvaluacionEvidencia | User | `GET,POST /users/{id}/evaluaciones-evidencias` <br> `GET,PUT,DELETE /users/{parent_id}/evaluaciones-evidencias/{id}` |
| Comentario | User | `GET,POST /users/{id}/comentarios` <br> `GET,PUT,DELETE /users/{parent_id}/comentarios/{id}` |
| AsignacionRevision | User | `GET,POST /users/{id}/asignaciones-revision` <br> `GET,PUT,DELETE /users/{parent_id}/asignaciones-revision/{id}` |
| EvaluacionPar | User | `GET,POST /users/{id}/evaluaciones-pares` <br> `GET,PUT,DELETE /users/{parent_id}/evaluaciones-pares/{id}` |
| ComentarioPar | User | `GET,POST /users/{id}/comentarios-pares` <br> `GET,PUT,DELETE /users/{parent_id}/comentarios-pares/{id}` |

## Ejemplos de Uso

### Listar Familias Profesionales

```bash
curl -H "Authorization: Bearer {token}" \
     http://localhost:8000/api/v1/familias-profesionales
```

### Crear Ciclo Formativo en una Familia

```bash
curl -X POST \
     -H "Authorization: Bearer {token}" \
     -H "Content-Type: application/json" \
     -d '{"nombre":"DAW","codigo":"DAW001","grado":"superior"}' \
     http://localhost:8000/api/v1/familias-profesionales/1/ciclos-formativos
```

### Búsqueda y Filtros

```bash
# Búsqueda
curl -H "Authorization: Bearer {token}" \
     "http://localhost:8000/api/v1/modulos-formativos?search=desarrollo"

# Paginación
curl -H "Authorization: Bearer {token}" \
     "http://localhost:8000/api/v1/evidencias?per_page=20&page=2"

# Ordenamiento
curl -H "Authorization: Bearer {token}" \
     "http://localhost:8000/api/v1/usuarios?sort_by=name&sort_direction=desc"
```

## Códigos de Respuesta

| Código | Significado |
|--------|-------------|
| 200 | OK - Solicitud exitosa |
| 201 | Created - Recurso creado |
| 422 | Unprocessable Entity - Error de validación |
| 401 | Unauthorized - No autenticado |
| 403 | Forbidden - Sin permisos |
| 404 | Not Found - Recurso no encontrado |
| 500 | Internal Server Error - Error del servidor |

## Estructura de Respuestas

### Recurso Individual

```json
{
  "data": {
    "id": 1,
    "nombre": "Ejemplo",
    "created_at": "2025-01-26T10:00:00Z"
  },
  "meta": {
    "resource_type": "familia_profesional",
    "generated_at": "2025-01-26T10:00:00Z"
  }
}
```

### Colección de Recursos

```json
{
  "data": [...],
  "links": {
    "first": "http://localhost:8000/api/v1/resource?page=1",
    "last": "http://localhost:8000/api/v1/resource?page=10",
    "prev": null,
    "next": "http://localhost:8000/api/v1/resource?page=2"
  },
  "meta": {
    "current_page": 1,
    "total": 100,
    "per_page": 10
  }
}
```
