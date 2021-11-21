<?php

class Comments
{
    private $id;
    private $comment_text;
    private $user_id;
    private $date;
    private $post_id;

    public function __construct($data = array())
    {
        if (count($data) !=0) {
            $this->id = $data['id'];
            $this->comment_text = $data['comment_text'];
            $this->user_id = $data['user_id'];
            $this->date = $data['date'];
            $this->post_id = $data['post_id'];
        }
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @param mixed $post_id
     */
    public function setPostId($post_id)
    {
        if ($post_id < 0 || !$post_id) {
            return false;
        }
        $this->post_id = $post_id;
        return true;
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

    public function getCommenttext()
    {
        return $this->comment_text;
    }

    /**
     * @param mixed $comment_text
     */

    public function setCommenttext($comment_text)
    {
        $this->comment_text = $comment_text;
        return true;
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
        if (!$user_id) {
            return false;
        }
        $this->user_id = $user_id;
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