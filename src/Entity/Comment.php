<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
 /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
/**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="date_immutable")
     */
    private $createdAt;

  /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="date_immutable")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
        
    }

    /**
     * @param string $content
     * @param User $user
     * @param Post $post
     *
     * @return Comment
     */
    public static function create(string $content, User $user, Post $post): Comment
    {
        $comment = new self();
        $comment->comment = $content;
        $comment->post = $post;
        $comment->user = $user;

        return $comment;
    }
    /**
     * @return string
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }
public function setComment($comment): self
    {
        $this->comment = $comment;
        return $this;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
/**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }
    
    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
     
     /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): void
    {
        
        $comment->setPost($this);

     if (!$this->comments->contains($comment)) {
          $this->comments->add($comment);
      }
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }
}
