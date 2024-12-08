<?php

namespace App\Helpers;

class LetterCounterHelper
{
    /**
     * Cuenta cuántas veces aparece cada letra en un string (recursivo).
     *
     * @param  string  $text  El texto a analizar.
     * @param  array  $counts  Acumulador para las letras.
     */
    public static function countLetters(string $text, array $counts = []): array
    {
        // Eliminar espacios y pasar a mayúsculas
        $text = strtoupper(str_replace(' ', '', $text));

        if ($text === '') {
            return $counts; // Caso base: cuando ya no hay más texto
        }

        $firstLetter          = $text[0]; // Tomar la primera letra
        $counts[$firstLetter] = ($counts[$firstLetter] ?? 0) + 1; // Incrementar el contador

        return self::countLetters(substr($text, 1), $counts); // Llamada recursiva con el resto del texto
    }
}
