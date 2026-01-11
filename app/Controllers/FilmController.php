<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Film;

/**
 * Auteur: <jouw naam>
 * Datum: <dd-mm-jjjj>
 * Omschrijving: CRUD controller voor films (Controller doet DB/queries).
 */
class FilmController extends BaseController
{
    public function index()
    {
        $db = db_connect();
        
        $films = $db->table('Film')
            ->select('Film.FilmId, Film.Name, Film.ReleaseYear, Film.DurationMinutes, Genre.GenreName')
            ->join('Genre', 'Genre.GenreId = Film.GenreId', 'Left' )
            ->orderBy('Film.Name', 'ASC')
            ->get()
            ->getResultArray();
    
        return view('films/index', ['films' => $films]);
    }

        public function create()
        {
            $db = db_connect();

            $genres = $db->table('Genre')
                ->select('Genre.GenreId, Genre.GenreName')
                ->get()
                ->getResultArray();

            return view('films/create', ['genres' => $genres]);
        }

        public function store()
        {
            //Read Input
            $name            = trim((string) $this->request->getPost('Name'));
            $releaseYear     = (int)         $this->request->getPost('ReleaseYear');
            $durationMinutes = (int)         $this->request->getPost('DurationMinutes');
            $genreId         = (int)         $this->request->getPost('GenreId');


            //VALIDATE
            if($name === '' || $releaseYear < 1888 || $durationMinutes <= 0 ||$genreId < 0 )
            {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Vul alle velden correct in');
            }

            $db = db_connect();

            $db->table('Film')-> insert
            (
                [
                    'Name'              => $name,
                    'ReleaseYear'       => $releaseYear,
                    'DurationMinutes'   => $durationMinutes,
                    'GenreId'           => $genreId,
                ]
            );

            //Redirect na succes
            return redirect()->to('/films')->with('succes', 'Film toegevoegd.');
        }
        
        public function edit(int $filmId)
        {
            $db = db_connect();


            //Load film
            $film = $db->table('Film')
                ->select('FilmId, Name, ReleaseYear, DurationMinutes, GenreId')
                ->where('FilmId', $filmId)
                ->get()
                ->getRowArray();

            if ($film === null)
            {
                return redirect()->to('/films')->with('error', 'Film niet gevonden.');
            }


            $genres = $db->table('Genre')
                ->select('GenreId, GenreName')
                ->orderBy('GenreName', 'ASC')
                ->get()
                ->getResultArray();


            return view(
            'films/edit',
                [
                    'film'   => $film,
                    'genres' => $genres,
                ]
            );
        }

        public function update(int $filmId)
        {
            $name            = trim((string) $this->request->getPost('Name'));
            $releaseYear     = (int) $this->request->getPost('ReleaseYear');
            $durationMinutes = (int) $this->request->getPost('DurationMinutes');
            $genreId         = (int) $this->request->getPost('GenreId');

            // Validate
            if ($name === '' || $releaseYear < 1888 || $durationMinutes <= 0 || $genreId <= 0) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Vul alle velden correct in');
            }

            $filmData = [
                'Name'            => $name,
                'ReleaseYear'     => $releaseYear,
                'DurationMinutes' => $durationMinutes,
                'GenreId'         => $genreId,
            ];

            $db = db_connect();

            $db->table('Film')
                ->where('FilmId', $filmId)
                ->update($filmData);

            return redirect()->to('/films')->with('success', 'Film aangepast.');
        }

        public function delete(int $filmId)
        {
            $db = db_connect();

            $db->table('Film')
               ->where('FilmId', $filmId)
               ->delete();

            
            return redirect()->to('/films')->with('success', 'Film Verwijderd.');
        }
}
