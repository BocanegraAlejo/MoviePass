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

        public function GetAllPeliculasActuales($page, $genero, $fecha_ini, $fecha_fin)
        {
            $api = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?page=$page&with_genres=$genero&primary_release_date.gte=$fecha_ini&primary_release_date.lte=$fecha_fin".CONFIG_API, true);
            $data = json_decode($api);
            return $data->{'results'};
        }

        
        public function getCantidadPaginas($genero = '', $fecha_ini = '', $fecha_fin = '') {
            $api = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?with_genres=$genero&primary_release_date.gte=$fecha_ini&primary_release_date.lte=$fecha_fin".CONFIG_API, true);
            $data = json_decode($api);
            return $data->{'total_pages'};
        }
        
    }
?>