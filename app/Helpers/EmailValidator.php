<?php

namespace App\Helpers;

class EmailValidator
{
    // Lista blanca de dominios comunes en LATAM y Colombia
    protected static $allowedDomains = [
        'gmail.com', 'outlook.com', 'hotmail.com', 'yahoo.com',
        'icloud.com', 'protonmail.com', 'zoho.com', 'aol.com',
        // Comunes en Colombia
        'com.co', 'edu.co', 'gov.co',
        // Comunes en otros países de LATAM
        'com.mx', 'edu.mx', 'gob.mx', 'com.ar', 'gov.ar', 'com.ve',
        'com.br', 'gov.br', 'edu.br', 'com.pe', 'gov.pe', 'edu.pe'
    ];

    public static function isValid($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $domain = substr(strrchr($email, "@"), 1);

        // Verificar que el dominio tenga registros MX y sea un dominio permitido
        return self::isDomainInLatam($domain) && self::isDomainValid($domain);
    }

    protected static function isDomainValid($domain)
    {
        // Verificar que el dominio tiene registros MX válidos
        return checkdnsrr($domain, 'MX');
    }

    protected static function isDomainInLatam($domain)
    {
        // Verificar si el dominio está en la lista blanca
        foreach (self::$allowedDomains as $allowedDomain) {
            if (str_ends_with($domain, $allowedDomain)) {
                return true;
            }
        }
        return false;
    }
}
