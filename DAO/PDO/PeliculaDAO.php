<?php
    namespace DAO\PDO;
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
                $query = "INSERT INTO ".$this->tableName." (id_pelicula, titulo, descripcion, duracion, imagen, fecha_lanzamiento, adultos, trailer, vote_average) VALUES (:id_pelicula, :titulo, :descripcion, :duracion, :imagen, :fecha_lanzamiento, :adultos, :trailer, :vote_average)";
                $parameters["id_pelicula"] = $pelicula->getId_pelicula();
                $parameters["titulo"] = $pelicula->getTitulo();
                $parameters["descripcion"] = $pelicula->getDescripcion();
                $parameters["duracion"] = $pelicula->getDuracion();
                $parameters["imagen"] = $pelicula->getImagen();
                $parameters["fecha_lanzamiento"] = $pelicula->getFecha();
                $parameters["adultos"] = $pelicula->getAdultos();
                $parameters["trailer"] = $pelicula->getTrailer();
                $parameters["vote_average"] = $pelicula->getVote_average();

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
        public function getOnePelicula($id_pelicula) {
            try
            {
                $query = "SELECT * FROM `".$this->tableName."` WHERE id_pelicula='$id_pelicula'";
    
                $this->connection = Connection::GetInstance();
    
                $resultSet = $this->connection->Execute($query);
               
                
                    $peli = new Pelicula();
                    $peli->setId_peliculas($resultSet[0]["id_pelicula"]);
                    $peli->setTitulo($resultSet[0]["titulo"]);
                    $peli->setDescripcion($resultSet[0]["descripcion"]);
                    $peli->setDuracion($resultSet[0]["duracion"]);
                    $peli->setImagen($resultSet[0]["imagen"]);
                    $peli->setFecha($resultSet[0]["fecha_lanzamiento"]);
                    $peli->setAdultos($resultSet[0]["adultos"]);
                    $peli->setTrailer($resultSet[0]["trailer"]);
                    $peli->setVote_average($resultSet[0]["vote_average"]);
                    
                return $peli;
    
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
            $api = file_get_contents("https://api.themoviedb.org/3/movie/$id?append_to_response=videos".CONFIG_API, true);
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