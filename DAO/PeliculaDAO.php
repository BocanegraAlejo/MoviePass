<?php
    namespace DAO;

    class PeliculaDAO 
    {

        public function GetAllGeneros()
        {
            $api = file_get_contents('https://api.themoviedb.org/3/genre/movie/list?'.CONFIG_API, true);
            $data = json_decode($api);
            return $data->{'genres'};
        }

        public function GetAllPeliculasActuales($page, $genero)
        {
            $api = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?page=$page&with_genres=$genero".CONFIG_API, true);
            $data = json_decode($api);
            return $data->{'results'};
        }

        
        public function getCantidadPaginas($genero = '') {
            $api = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?with_genres=$genero".CONFIG_API, true);
            $data = json_decode($api);
            return $data->{'total_pages'};
        }
        
    }
?>