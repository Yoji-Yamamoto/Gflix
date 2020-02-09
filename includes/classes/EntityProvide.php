<?php
    class EntityProvide {

        public static function getEntities($con, $categoryId, $limit){
            $sql = "SELECT * FROM entities ";

            if($categoryId != null){
                $sql .= "WHERE categoryId=:categoryId ";
            }

            $sql .= "ORDER BY RAND() LIMIT :limit";

            $query = $con->prepare($sql);

            if($categoryId != null){
                $query->bindValue(":categoryId", $categoryId);
            }

            $query->bindValue(":limit", $limit, PDO::PARAM_INT);
            $query->execute();

            $result = array();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $result[] =  new Entity($con, $row);
            }

            return $result;
        }

        public static function getvShowEntities($con, $categoryId, $limit){
            $sql = "SELECT DISTINCT(entities.id) FROM `entities`
                    INNER JOIN videos on entities.id = videos.entityId 
                    WHERE videos.isMovie = 0 ";

            if($categoryId != null){
                $sql .= "AND categoryId=:categoryId ";
            }

            $sql .= "ORDER BY RAND() LIMIT :limit";

            $query = $con->prepare($sql);

            if($categoryId != null){
                $query->bindValue(":categoryId", $categoryId);
            }

            $query->bindValue(":limit", $limit, PDO::PARAM_INT);
            $query->execute();

            $result = array();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $result[] =  new Entity($con, $row["id"]);
            }

            return $result;
        }

        public static function getmovieEntities($con, $categoryId, $limit){
            $sql = "SELECT DISTINCT(entities.id) FROM `entities`
                    INNER JOIN videos on entities.id = videos.entityId 
                    WHERE videos.isMovie = 1 ";

            if($categoryId != null){
                $sql .= "AND categoryId=:categoryId ";
            }

            $sql .= "ORDER BY RAND() LIMIT :limit";

            $query = $con->prepare($sql);

            if($categoryId != null){
                $query->bindValue(":categoryId", $categoryId);
            }

            $query->bindValue(":limit", $limit, PDO::PARAM_INT);
            $query->execute();

            $result = array();
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $result[] =  new Entity($con, $row["id"]);
            }

            return $result;
        }
    }

?>