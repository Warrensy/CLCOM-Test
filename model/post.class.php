<?php

class post
{
    private $id;
    private $user_id;
    private $tags;
    private $image_path;
    private $likes;
    private $dislikes;
    //TODO: Make comments table;
    private $comments;
    //True or false
    private $private;
    private $post_text;
    private $date;

    public function __construct($data = array()){
        if (count($data) !=0){
            $this->id = $data['id'];
            $this->user_id = $data['user_id'];
            $this->tags = $data['tags'];
            $this->image_path = $data['image_path'];
            $this->likes = $data['likes'];
            $this->dislikes = $data['dislikes'];
            //$this->comments = $data['comments'];  
            $this->private = $data['private'];
            $this->post_text = $data['post_text'];
            $this->date = $data['date'];
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        return true;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = htmlspecialchars($tags);
        return true;
    }

    /**
     * @return mixed
     */
    public function getImagePath()
    {
        // If image does not exist, return placeholder image.
        return empty($this->image_path) ? 'public/posts/post_placeholder.jpg' : $this->image_path;

    }

    /**
     * @param mixed $image_path
     */
    public function setImagePath($image_path)
    {
        $this->image_path = htmlspecialchars($image_path);
        return true;
    }

    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param mixed $likes
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }

    /**
     * @return mixed
     */
    public function getDislikes()
    {
        return $this->dislikes;
    }

    /**
     * @param mixed $dislikes
     */
    public function setDislikes($dislikes)
    {
        $this->dislikes = $dislikes;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = htmlspecialchars($comments);
    }

    /**
     * @return mixed
     */
    public function getPrivate()
    {
        return $this->private;
    }

    /**
     * @param mixed $private
     */
    public function setPrivate($private)
    {
        $private = intval($private);
        if ($private != 0 && $private != 1) return false;
        $this->private = $private;
        return true;
        /*
        if (strcmp($private, "Public") !== 0) {
            $this->private = false;
        } else if (strcmp($private, "Privat") !== 0) {
            $this->private = true;
        } else {
            return false;
        }
        return true;*/
    }

    /**
     * @return mixed
     */
    public function getPostText()
    {
        return $this->post_text;
    }

    /**
     * @param mixed $post_text
     */
    public function setPostText($post_text)
    {
        $this->post_text = htmlspecialchars($post_text);
        return true;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

}