<?php
    namespace DAO;
    use DAO\Connection as Connection;
    use \Exception as Exception;
    use Models\Pelicula;

    class PeliculaDAO 
    {
        private $connection;
        private $tableName = "pelicula";

        public function Add(Pelicula $pelicula)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (id_pelicula, titulo, descripcion, duracion, imagen, fecha_lanzamiento) VALUES (:id_pelicula, :titulo, :descripcion, :duracion, :imagen, :fecha_lanzamiento);";
                $parameters["id_pelicula"] = $pelicula->getId_pelicula();
                $parameters["titulo"] = $pelicula->getTitulo();
                $parameters["descripcion"] = $pelicula->getDescripcion();
                $parameters["duracion"] = $pelicula->getDuracion();
                $parameters["imagen"] = $pelicula->getImagen();
                $parameters["fecha_lanzamiento"] = $pelicula->getFecha();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function buscarPelicula($id_pelicula) {
            try
            {
                $query = "SELECT id_pelicula FROM `".$this->tableName."` WHERE id_pelicula='$id_pelicula'";
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
    
                return $resultSet;
    
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        /**************************** LLAMADAS API ****************************/
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

        public function GetPeliculaByID($id)
        {
            $api = file_get_contents("https://api.themoviedb.org/3/movie/$id?".CONFIG_API, true);
            $data = json_decode($api);
            return $data;
        }

        
        public function GetIdiomasByIDpelicula($id)
        {
            $api = file_get_contents("https://api.themoviedb.org/3/movie/$id?".CONFIG_API, true);
            $data = json_decode($api);
               $originalLanguage = $data->{'original_language'};
                $x=0; $flag = 0;
               while($x<count($data->{'spoken_languages'}) && $flag == 0) {
                   if($originalLanguage == $data->{'spoken_languages'}[$x]->{'iso_639_1'}) {
                        $flag = 1;
                   }
                   $x++;
               }
               $arrIdiomas = array();
               foreach ($data->{'spoken_languages'} as $key => $value) {
                   array_push($arrIdiomas,$data->{'spoken_languages'}[$key]->{'iso_639_1'});
               }
               if($flag == 0) {
                   array_push($arrIdiomas,$originalLanguage);
               }

            return $arrIdiomas;
        }

        public function getCantidadPaginas($genero = '', $fecha_ini = '', $fecha_fin = '') {
            $api = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?with_genres=$genero&primary_release_date.gte=$fecha_ini&primary_release_date.lte=$fecha_fin".CONFIG_API, true);
            $data = json_decode($api);
            return $data->{'total_pages'};
        }
        /******************************** FIN LLAMADAS API **********************************/
    }
?>