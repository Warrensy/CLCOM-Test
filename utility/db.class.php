<?php
error_reporting(E_ALL);
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class Database extends mysqli {


        public function changeStatus($id,$status)
        {
            $stmt= $this->prepare('UPDATE users SET active = ? WHERE id = ?');
            $stmt->bind_param
            (
                'ii', 
                $status, 
                $id
            );
            $stmt->execute();
        }

        public function setAccept($friendsId, $id)
        {
            $stmt= $this->prepare('UPDATE friends SET accepted = 1 WHERE (id = ? AND friendId = ?) OR (id = ? AND friendId = ?)');
            $stmt->bind_param
            (
                'iiii', 
                $id, 
                $friendsId,
                $friendsId,
                $id
            );
            $stmt->execute();
        }
        public function getAccept($friendId, $id)
        {
            $stmt= $this->prepare('SELECT accepted FROM friends WHERE (id = ? AND friendId = ?) OR (id = ? AND friendId = ?)');
            $stmt->bind_param
            (
                'iiii', 
                $id, 
                $friendId,
                $friendId,
                $id
            );
            $stmt->execute();
            $result = $stmt->get_result();
            $status = $result->fetch_assoc();
            if($status != NULL)
            {
                return $status['accepted'];
            }
            else
            {
                return false;
            }
        }

        public function getFriends($userId)
        {
            $requests = array();
            $stmt = $this->prepare('SELECT users.* FROM friends, users 
            WHERE ((friends.friendId = ? AND friends.id = users.id) OR (friends.id = ? AND friends.friendId = users.id)) 
            AND friends.accepted = 1');
            $stmt->bind_param(
                'ii', 
                $userId,
                $userId
            );
            $stmt->execute();
            $result = $stmt->get_result();

            while($request = $result->fetch_assoc()) 
            {
                $requests[] = new User($request);
            }
            return $requests;
        }

        public function friendRequest($id,$friendId)
        {
            $stmt=$this->prepare('SELECT * FROM friends WHERE id = ? AND friendID = ?;');
            $stmt->bind_param (
                'ii',
                $friendId,
                $id
            );
            $stmt->execute();
            $stmt->store_result();
            $result = $stmt->num_rows;

            if($result == 0)
            {
            $stmt=$this->prepare('INSERT INTO friends (id, friendId) VALUES (?,?);');
            $stmt->bind_param (
                'ii',
                $id,
                $friendId
            );
            return $stmt->execute();
            }
            else
            {
                $stmt=$this->prepare('INSERT INTO friends (id, friendId) VALUES (?,?);');
                $stmt->bind_param (
                'ii',
                $id,
                $friendId
                );
                $this->setAccept($friendId, $id);
            }

        }

        public function getFriendRequest($userId)
        {
            $requests = array();
            $stmt = $this->prepare('SELECT * FROM friends JOIN users ON users.id=friends.id WHERE friendId = ? AND accepted = 0;');
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            while($request = $result->fetch_assoc()) 
            {
                $requests[] = new User($request);
            }
            return $requests;
        }

        public function removefriend($id, $friendId)
        {
            $stmt=$this->prepare('DELETE FROM friends WHERE (id = ? AND friendId = ?) OR (id = ? AND friendId = ?) ;');
            $stmt->bind_param (
                'iiii',
                $id,
                $friendId,
                $friendId,
                $id
                
            );
            return $stmt->execute();
        }

        public function getUserList($search="%") 
        {
            $sql="SELECT * FROM users";
            if(!empty($search))
            {
                $sql.=" WHERE username LIKE ?";
            }
            $users = array();
            $stmt = $this->prepare($sql);
            if(!empty($search))
            {
                $stmt->bind_param('s', $search);
            }
            $stmt->execute();
            $result = $stmt->get_result();


            while($user = $result->fetch_assoc()) {
                $users[] = new User($user);
            }

            return $users;
        }
        
        public function getUserByUsername($username) 
        {
            $stmt = $this->prepare('SELECT * FROM users WHERE username = ?;');
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            
            if($data != NULL) 
            {
                return new User($data);
            } else 
            {
                return false;
            }
        }

        /**
         * @param $id
         * @return false|User
         */
        public function getUserById($id) {
            $stmt = $this->prepare('SELECT * FROM users WHERE id = ?;');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();

            if($data != NULL) 
            {
                return new User($data);
            } else 
            {
                return false;
            }
        }

        public function getUserByEmail($email) 
        {
            $stmt = $this->prepare('SELECT * FROM users WHERE email = ?;');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();

            if($data != NULL) 
            {
                return new User($data);
            } else 
            {
                return false;
            }
        }

        public function registerUser($user) 
        {
            // notwendig, da bind_param keine return-Werte von methoden der Klasse User mag, gibt sonst eine Fehlermeldung
            $anrede = $user->getAnrede();
            $vorname = $user->getVorname();
            $nachname = $user->getNachname();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $email = $user->getEmail();

            $stmt = $this->prepare('INSERT INTO users (anrede, vorname, nachname, username, `password`, email) VALUES (?, ?, ?, ?, ?, ?);');
            $stmt->bind_param(
                'ssssss',
                $anrede,
                $vorname,
                $nachname,
                $username,
                $password,
                $email
            );
            return $stmt->execute();
        }

        public function updateUser($user) 
        {
            // notwendig, da bind_param keine return-Werte von methoden der Klasse User mag, gibt sonst eine Fehlermeldung
            $anrede = $user->getAnrede();
            $lastLogin = $user->getlastLogin();
            $vorname = $user->getVorname();
            $nachname = $user->getNachname();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $email = $user->getEmail();
            $id = $user->getId();

            $stmt = $this->prepare('UPDATE users SET anrede = ?, lastLogin = ? , vorname = ?, nachname = ?, username = ?, `password` = ?, email = ? WHERE id = ?;');
            
            $stmt->bind_param(
                'sssssssi',
                $anrede,
                $lastLogin,
                $vorname,
                $nachname,
                $username,
                $password,
                $email,
                $id
                
            );
            return $stmt->execute();
        }

        public function loginUser($username, $password) 
        {
            $user = $this->getUserByUsername($username);

            if($user == false || $user->getActive() == 0) 
            {
                return false;
            } else if(password_verify($password, $user->getPassword())) 
            {
                $_SESSION["userId"] = $user->getId();
                return true;
            }
        }

        public function getPostListById($id)
        {
            $stmt = $this->prepare('SELECT * FROM posts WHERE user_id= ? ORDER BY `date` DESC;');
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $result = $stmt->get_result();

            $posts = array();

            while($post = $result->fetch_assoc()) 
            {
                $posts[] = new Post($post);
            }

            return $posts;
        }

        public function getPostList()
        {
            $posts = array();
            $result = $this->query('SELECT * FROM posts ORDER BY `date` DESC;');

            while($post = $result->fetch_assoc()) 
            {
                $posts[] = new Post($post);
            }

            return $posts;
        }

    /**
     * @param $post Post
     */
        public function createPost(Post $post) 
        {
            $user_id = $post->getUserId();
            $tags = $post->getTags();
            $image_path = $post->getImagePath();
            $likes = $post->getLikes();
            $dislikes = $post->getDislikes();
            $private = $post->getPrivate();
            $post_text = $post->getPostText();

            $stmt = $this->prepare('INSERT INTO posts (user_id, tags, image_path, likes, dislikes, private, post_text) VALUES (?, ?, ?, ?, ?, ?, ?);');
            if (!$stmt) 
            {
                return false;
            }
            $stmt->bind_param(
                'issiiis',
                $user_id,
                $tags,
                $image_path,
                $likes,
                $dislikes,
                $private,
                $post_text
            );
            return $stmt->execute();
        }

        /**
         * Updates a post in the database
         * @param $post Post
         * @return bool
         */
        public function updatePost($post) {
            $user_id = $post->getUserId();
            $tags = $post->getTags();
            $image_path = $post->getImagePath();
            $likes = $post->getLikes();
            $dislikes = $post->getDislikes();
            $private = $post->getPrivate();
            $post_text = $post->getPostText();
            $id = $post->getId();

            $stmt = $this->prepare('UPDATE posts SET user_id = ?, tags = ? , image_path = ?, likes = ?, dislikes = ?, `private` = ?, post_text = ? WHERE id = ?;');

            $stmt->bind_param(
                'issiiisi',
                $user_id,
                $tags,
                $image_path,
                $likes,
                $dislikes,
                $private,
                $post_text,
                $id
            );
            return $stmt->execute();
        }

        /**
         * @param $id
         * @return false|Post
         */
        public function getPostById($id) {
            $stmt = $this->prepare('SELECT * FROM posts WHERE id = ?;');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();

            if($data != NULL) {
                return new Post($data);
            } else {
                return false;
            }
        }
        /**
         * @param Comments $comments
         */
        public function createComment(Comments $comments)
        {
            $user_id = $comments->getUserId();
            $comment_text = $comments->getCommenttext();
            $post_id = $comments->getPostId();

            $stmt = $this->prepare('INSERT INTO comments (user_id, comment_text, post_id) VALUES (?, ?, ?);');
            if (!$stmt) {
                return false;
            }
            $stmt->bind_param(
                'isi',
                $user_id,
                $comment_text,
                $post_id
            );

            return $stmt->execute();
        }

    public function getCommentsByPostId($post_id)
    {
        $comments = array();
        // If comments should be displayed from oldest to latest switch DESC with ASC
        $stmt = $this->prepare('SELECT * FROM comments where post_id = ? ORDER BY `date` DESC;');
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while($comment = $result->fetch_assoc())
        {
            $comments[] = new Comments($comment);
        }

        return $comments;
    }

    public function deletePost($id)
    {
        $stmt=$this->prepare('DELETE FROM posts WHERE id = ?;');
        $stmt->bind_param (
            'i',
            $id
        );
        return $stmt->execute();
    }

    public function searchPostsByTag($tag)
    {
        $posts = array();
        $tag = '%'.$tag.'%';
        // If comments should be displayed from oldest to latest switch DESC with ASC
        $stmt = $this->prepare('SELECT * FROM posts where tags LIKE ? ORDER BY `date` DESC;');
        $stmt->bind_param('s', $tag);
        $stmt->execute();
        $result = $stmt->get_result();

        while($post = $result->fetch_assoc())
        {
            $posts[] = new Post($post);
        }

        return $posts;
    }

    /**
     * @param $search_term
     */
        public function search_posts($search_term)
        {
            $posts = array();
            $search_term = '%'.$search_term.'%';
            $stmt = $this->prepare('SELECT distinct posts.* FROM posts, comments WHERE (comments.comment_text LIKE ? AND posts.id = comments.Id) OR posts.post_text LIKE ? ORDER BY DATE DESC;');
            $stmt ->bind_param (
                'ss',
                $search_term,
                $search_term
            );
            $stmt->execute();
            $result = $stmt->get_result();

            while($post = $result->fetch_assoc())
            {
                $posts[] = new Post($post);
            }

            return $posts;
        }
    }