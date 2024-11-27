<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AbsenceType: string implements HasLabel
{
    // General
    case VACATION = "Vacation";
    case PERSONAL = "Personal";
    case UNJUSTIFIED = "Unjustified";
    case OTHER = "Other";
    case ILLNESS = "Illness";
    // Vacaciones y permisos planificados
    case ANNUAL_LEAVE = 'Annual Leave'; // Vacaciones anuales
    case PERSONAL_LEAVE = 'Personal Leave'; // Permiso personal
    case SABBATICAL_LEAVE = 'Sabbatical Leave'; // Año sabático

    // Enfermedad
    case SICK_LEAVE = 'Sick Leave'; // Enfermedad general
    case LONG_TERM_SICK_LEAVE = 'Long Term Sick Leave'; // Enfermedad prolongada
    case FAMILY_CARE_LEAVE = 'Family Care Leave'; // Cuidado de familiares

    // Ausencias relacionadas con la familia
    case MATERNITY_LEAVE = 'Maternity Leave'; // Maternidad
    case PATERNITY_LEAVE = 'Paternity Leave'; // Paternidad
    case ADOPTION_LEAVE = 'Adoption Leave'; // Adopción
    case BEREAVEMENT_LEAVE = 'Bereavement Leave'; // Duelo o pérdida familiar

    // Ausencias relacionadas con el trabajo
    case TRAINING_LEAVE = 'Training Leave'; // Formación profesional
    case BUSINESS_TRIP = 'Business Trip'; // Viaje de negocios
    case UNION_ACTIVITY = 'Union Activity'; // Actividades sindicales

    // Licencias especiales
    case JURY_DUTY = 'Jury Duty'; // Servicio de jurado
    case MILITARY_LEAVE = 'Military Leave'; // Servicio militar
    case ELECTION_DUTY = 'Election Duty'; // Participación electoral

    // Ausencias no justificadas
    case UNEXCUSED_ABSENCE = 'Unexcused Absence'; // Inasistencia no justificada
    case LATE_ARRIVAL = 'Late Arrival'; // Llegada tarde
    case EARLY_DEPARTURE = 'Early Departure'; // Salida anticipada

    // Otros
    case HOLIDAY = 'Holiday'; // Festivo o día feriado
    case LEAVE_OF_ABSENCE = 'Leave of Absence'; // Permiso general no especificado
    case COMPENSATORY_LEAVE = 'Compensatory Leave'; // Días libres compensatorios

    public function getLabel(): ?string
    {
         return __("enums.absence_type.{$this->value}");
    }

}
