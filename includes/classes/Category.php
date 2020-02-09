<?php
    class Category{
        private $con, $username;

        public function __construct($con, $username){
            $this->con = $con;
            $this->username = $username;
        }

        public function showtvShowCategories(){
            $query = $this->con->prepare("SELECT * FROM categories");
            $query->execute();

            $html = "<div class='categories'>
                        <h1>Tv show</h1>";
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $html .= $this->getCategoryHtml($row, null, true, false);
            }

            return $html . "</div>";
        }

        public function showMovieCategories(){
            $query = $this->con->prepare("SELECT * FROM categories");
            $query->execute();

            $html = "<div class='categories'>
                        <h1>Movie</h1>";
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $html .= $this->getCategoryHtml($row, null, false, true);
            }

            return $html . "</div>";
        }

        public function showCategory($categoryId, $title = null){
            $query = $this->con->prepare("SELECT * FROM categories WHERE id=:id");
            $query->bindValue(":id", $categoryId);
            $query->execute();

            $html = "<div class='categories'>";
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $html .= $this->getCategoryHtml($row, null, true, true);
            }

            return $html . "</div>";
        }

        public function showAllCategories(){
            $query = $this->con->prepare("SELECT * FROM categories");
            $query->execute();

            $html = "<div class='categories'>";
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $html .= $this->getCategoryHtml($row, null, true, true);
            }

            return $html . "</div>";
        }

        private function getCategoryHtml($sqlData, $title, $tvShows, $movies){
            $categotyId = $sqlData["id"];
            $title = $title == null ? $sqlData["name"]: $title;

            if($tvShows && $movies){
                $entities = EntityProvide::getEntities($this->con, $categotyId, 30);
            }
            else if($tvShows){
                $entities = EntityProvide::getvShowEntities($this->con, $categotyId, 30);
            }
            else {
                $entities = EntityProvide::getmovieEntities($this->con, $categotyId, 30);
            }

            if(sizeof($entities) == 0){
                return;
            }

            $entitiesHtml = "";
            $previewprovider = new PreviewProvide($this->con, $this->username);

            foreach($entities as $entity){
                $entitiesHtml .= $previewprovider->createEntitySquare($entity);
            }

            return "<div class='category'>
                <a href='category.php?id=$categotyId'>
                    <h3>$title</h3>
                </a>

                <div class='entities'>
                    $entitiesHtml
                </div>
            </div>";
        }


    }

?>