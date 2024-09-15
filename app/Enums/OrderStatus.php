<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'Pending';            // Orden creada, pero aún no procesada
    case PROCESSING = 'Processing';      // Orden está en proceso de preparación
    case SHIPPED = 'Shipped';            // Orden ha sido enviada al cliente
    case DELIVERED = 'Delivered';        // Orden entregada al cliente
    case CANCELLED = 'Cancelled';        // Orden ha sido cancelada
    case REFUNDED = 'Refunded';          // Orden ha sido reembolsada
    case FAILED = 'Failed';              // Fallo en el procesamiento o pago de la orden
    case ON_HOLD = 'On Hold';            // Orden en espera por algún motivo (ej: falta de inventario)
    case AWAITING_PAYMENT = 'Awaiting Payment'; // Esperando confirmación de pago
    case COMPLETED = 'Completed';        // Orden completada, todas las acciones finalizadas
}