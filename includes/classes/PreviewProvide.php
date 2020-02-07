<?php
    class PreviewProvide{

        private $con;
        private $username;

        public function __construct($con, $username){
            $this->con = $con;
            $this->username = $username;

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

        private function getRandomEntity(){

            $entity = EntityProvide::getEntities($this->con, null, 1);
            return $entity[0];
    }
}
?>