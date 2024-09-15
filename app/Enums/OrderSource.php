<?php

namespace App\Enums;

enum OrderSource: string
{
    case ONLINE = 'Online';               // Orden hecha desde la app web
    case EMAIL = 'Email';                 // Orden recibida a través de correo electrónico
    case WHATSAPP = 'WhatsApp';           // Orden recibida a través de WhatsApp
    case SOCIAL_MEDIA = 'Social Media';   // Orden hecha a través de redes sociales
    case PHONE_CALL = 'Phone Call';       // Orden recibida por llamada telefónica
    case WALK_IN = 'Walk-in';             // Orden hecha directamente en una tienda física
    case SMS = 'SMS';                     // Orden recibida por mensaje de texto
    case MOBILEAPP = 'Mobile App';
    case MARKETPLACE = 'Marketplace';
    case OTHER = 'Other';                 // Cualquier otra fuente no listada
    case PARTNERPORTAL = 'Partner Portal';
}