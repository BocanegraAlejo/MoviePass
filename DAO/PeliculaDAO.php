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

        public function GetAllPeliculasActuales($page)
        {
            $api = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?page=$page".CONFIG_API, true);
            $data = json_decode($api);
            return $data->{'results'};
        }

        public function getAllPeliculasGenero($genero) {
            $api = file_get_contents("https://api.themoviedb.org/3/discover/movie?with_genres=$genero".CONFIG_API, true);
            $data = json_decode($api);
            return $data->{'results'};
        }
        public function getCantidadPaginas() {
            $api = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?".CONFIG_API, true);
            $data = json_decode($api);
            return $data->{'total_pages'};
        }
        
    }
?>