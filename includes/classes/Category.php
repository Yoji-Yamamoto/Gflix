<?php
    class Category{
        private $con, $username;

        public function __construct($con, $username){
            $this->con = $con;
            $this->username = $username;
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

            }
            else {

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