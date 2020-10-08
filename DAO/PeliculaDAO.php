<?php
    namespace DAO;

    class PeliculaDAO 
    {
        

        public function GetAllGeneros()
        {
            $api = file_get_contents('https://api.themoviedb.org/3/genre/movie/list'.CONFIG_API, true);
            $data = json_decode($api);
            echo $data;
        }

        public function GetAllPeliculasActuales()
        {
            $api = file_get_contents('https://api.themoviedb.org/3/movie/now_playing'.CONFIG_API, true);
            $data = json_decode($api);
            return $data->{'results'};
        }

    }
?>