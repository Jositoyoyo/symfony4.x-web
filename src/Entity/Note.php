<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Note
 *
 * @ORM\Table(name="note", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"}), @ORM\UniqueConstraint(name="trash_UNIQUE", columns={"trash"})}, indexes={@ORM\Index(name="fk_note_user1_idx", columns={"user"}), @ORM\Index(name="fk_note_folder1_idx", columns={"folder"})})
 * @ORM\Entity
 */
class Note {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modify", type="datetime", nullable=false)
     */
    private $modify;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var boolean
     *
     * @ORM\Column(name="trash", type="boolean", nullable=false)
     */
    private $trash;

    /**
     * @var \Folder
     *
     * @ORM\ManyToOne(targetEntity="Folder")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="folder", referencedColumnName="id")
     * })
     */
    private $folder;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created) {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getModify() {
        return $this->modify;
    }

    /**
     * @param \DateTime $modify
     */
    public function setModify($modify) {
        $this->modify = $modify;
    }

    /**
     * @return int
     */
    public function getPriority() {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority) {
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug) {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * @return bool
     */
    public function isTrash() {
        return $this->trash;
    }

    /**
     * @param bool $trash
     */
    public function setTrash($trash) {
        $this->trash = $trash;
    }

    /**
     * @return \Folder
     */
    public function getFolder(): Folder {
        return $this->folder;
    }

    /**
     * @param \Folder $folder
     */
    public function setFolder(Folder $Folder) {
        $this->folder = $folder;
    }

    /**
     * @return \User
     */
    public function getUser(): User {
        return $this->user;
    }

    /**
     * @param \User $user
     */
    public function setUser(User $user) {
        $this->user = $user;
    }

}
