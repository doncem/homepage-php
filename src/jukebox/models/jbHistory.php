<?php
namespace jukebox\models;
/**
 * History model
 * @Entity
 * @Table(name="jb_history")
 */
class jbHistory extends \SerializeMyVars {

    /**
     * Autoincrement table ID
     * @var int
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    protected $id;

    /**
     * Time it's added
     * @var \DateTime
     * @Column(type="datetime")
     */
    protected $timestamp;

    /**
     * Model of song of this history
     * @var jbSongs
     * @ManyToOne(targetEntity="jbSongs", inversedBy="history")
     * @JoinColumn(name="track", referencedColumnName="id")
     */
    private $track;

    /**
     * Get it
     * @return jbSongs
     */
    public function getTrack() {
        return $this->track;
    }

    /**
     * Set it
     * @param \DateTime $timestamp
     * @return \jukebox\models\jbHistory
     */
    public function setTimestamp(\DateTime $timestamp) {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Set it
     * @param jbSongs $track
     * @return jbHistory
     */
    public function setTrack(jbSongs $track) {
        $this->track = $track;

        return $this;
    }
}
