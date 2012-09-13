<?php

namespace cdcollection;

/**
 * Initializing controller
 */
class CdController extends \ControllerInit {

    /**
     * <ul><li>Setting default html values</li><li>Show google scripts?</li></ul>
     */
    public function init() {
        parent::init();

        $html = new \HtmlInit($this->dic->registry);
        $this->view->html = $html->getDefaults(null,
                                               "CD Collection",
                                               null,
                                               array("subtitle" => $this->getSubtitle()));
    }
    
    private function getSubtitle() {
        $query = $this->dic->em->createQuery("SELECT COUNT(ht) AS counter " .
                                             "FROM \cdcollection\models\cdHeaderTitles ht");
        $max = $query->getResult();
        
        $title = $this->dic->em->getRepository("\cdcollection\models\cdHeaderTitles")
                               ->findBy(array(), array(), 1, rand(0, $max[0]["counter"] - 1));
        
        return $title[0]->getQuote() . " <br />by " .
               $title[0]->getTrack()->getAlbum()->getArtist()->getName() . " - " .
               $title[0]->getTrack()->getName();
    }
}
