<?php
    class PreviewProvide{

        private $con;
        private $username;

        public function __construct($con, $username){
            $this->con = $con;
            $this->username = $username;

        }

        public function createCategoryPreview($categoryId){
            $entitiesArray = EntityProvide::getEntities($this->con, $categoryId, 1);
 
            if(sizeof($entitiesArray) == 0){
                ErrorMessage::show("no tv shows");
            }
 
            return $this->createPreviewVideo($entitiesArray[0]);
         }
 
 

        public function createTvPreview(){
           $entitiesArray = EntityProvide::getvShowEntities($this->con, null, 1);

           if(sizeof($entitiesArray) == 0){
               ErrorMessage::show("no tv shows");
           }

           return $this->createPreviewVideo($entitiesArray[0]);
        }

        public function createmoviePreview(){
            $entitiesArray = EntityProvide::getmovieEntities($this->con, null, 1);
 
            if(sizeof($entitiesArray) == 0){
                ErrorMessage::show("no movie");
            }
 
            return $this->createPreviewVideo($entitiesArray[0]);
         }
 

        public function createPreviewVideo($entity){
            if($entity == null){
                $entity = $this->getRandomEntity();
            }
            $id = $entity->getId();
            $name = $entity->getName();
            $preview = $entity->getPreview();
            $thumbnail = $entity->getThumbnail();

            //Todo: add subtitle

            echo "<div class='previewContainer'>
                <img class='previewImage' src='$thumbnail' hidden>
                <video autoplay muted class='previewVideo' onended='previewEnd()'>
                 <source src='$preview' type='video/mp4'>
                 </video>

                 <div class='previewOverlay'>
                    <div class='mainDetail'>
                        <h3>$name</h3>

                        <div class='buttons'>
                            <button><img src='assets/images/fonts/play.png'></button>
                            <button onclick='VolumeToggle(this)'>
                            <i class='fas fa-volume-mute' style='color: #202020;'></i></button>
                        </div>
                    </div>
                 </div>
            </div>";
        }

        public function createEntitySquare($entity){
            $id = $entity->getId();
            $thumbnail = $entity->getThumbnail();
            $name = $entity->getName();

            return "<a href='entity.php?id=$id'>
                <div class='previewContainer small'>
                    <img src='$thumbnail' title='$name'>
                </div>
            </a>";
        }

        private function getRandomEntity(){

            $entity = EntityProvide::getEntities($this->con, null, 1);
            return $entity[0];
    }
}
?>