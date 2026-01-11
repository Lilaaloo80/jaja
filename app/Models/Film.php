<?php

namespace App\Models;

/**
 * Auteur: <jouw naam>
 * Datum: <dd-mm-jjjj>
 * Omschrijving: Model class (data object) voor Film.
 */
class Film
{
    public int $filmId;
    public string $name;
    public int $releaseYear;
    public int $durationMinutes;
    public string $genre;

    public function __construct(
        int $filmId,
        string $name,
        int $releaseYear,
        int $durationMinutes,
        string $genre
    ) {
        $this->filmId = $filmId;
        $this->name = $name;
        $this->releaseYear = $releaseYear;
        $this->durationMinutes = $durationMinutes;
        $this->genre = $genre;
    }
}
