<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Todo
 *
 * @ORM\Table(name="todo", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"}), @ORM\UniqueConstraint(name="slug_UNIQUE", columns={"slug"})}, indexes={@ORM\Index(name="fk_todo_user_idx", columns={"user"}), @ORM\Index(name="fk_todo_folder1_idx", columns={"folder"})})
 * @ORM\Entity
 */
class Todo {

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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=45, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="task", type="text", length=65535, nullable=true)
     */
    private $task;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=true)
     */
    private $comment;

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

    public function __construct() {
        $this->slug = md5(uniqid($this->name, true));
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
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
    public function getTask() {
        return $this->task;
    }

    /**
     * @param string $task
     */
    public function setTask($task) {
        $this->task = $task;
    }

    /**
     * @return string
     */
    public function getComment() {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment) {
        $this->comment = $comment;
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
    public function getFolder() : Folder {
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
