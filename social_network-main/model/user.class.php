<?php
    
    class User {
        private $lastLogin;
        private $id;
        private $anrede;
        private $vorname;
        private $nachname;
        private $username;
        private $password;
        private $email;
        private $admin;
        private $filename;
        private $active;

        public function __construct($data = array()) {
            if(count($data) != 0) {
                $this->id = $data['id'];
                $this->anrede = $data['anrede'];
                $this->vorname = $data['vorname'];
                $this->nachname = $data['nachname'];
                $this->username = $data['username'];
                $this->password = $data['password'];
                $this->email = $data['email'];
                $this->admin = $data['admin'];
                $this->lastLogin = $data['lastLogin'];
                $this->profilePicture = $data['profilePicture'];
                $this->active = $data['active'];
            }
        } 
        public function setActive($active)
        {
            $this->active = $active;
        }
        public function getActive()
        {
            return $this->active;
        }

        public function setprofilePicture($filename)
        {
            $this->profilePicture = $filename;
        }
        public function getprofilePicture()
        {
            return $this->profilePicture;
        }

        public function setId($id) 
        {
            $this->id = $id;
        }
        public function getId() 
        {
            return $this->id;
        }

        public function setlastLogin($lastLogin) 
        {
            $this->lastLogin = $lastLogin;
        }
        public function getlastLogin() 
        {
            return $this->lastLogin;
        }
        
        public function setAnrede($anrede) 
        {
            if(in_array($anrede, array('f', 'm'))) 
            {
                $this->anrede = $anrede;
                return true;
            } 
            else 
            {
                return false;
            }
        }
        public function getAnrede() 
        {
            return $this->anrede;
        }

        public function setVorname($vorname) 
        {
            if(preg_match("/^[A-Za-zÄÖÜäöü ]{1,50}$/", $vorname)) 
            {
                $this->vorname = $vorname;
                return true;
            } 
            else 
            {
                return false;
            }
        }
        public function getVorname() 
        {
            return $this->vorname;
        }

        public function setNachname($nachname) 
        {
            if(preg_match("/^[A-Za-zÄÖÜäöü ]{1,50}$/", $nachname)) 
            {
                $this->nachname = $nachname;
                return true;
            } 
            else 
            {
                return false;
            }
        }
        public function getNachname() 
        {
            return $this->nachname;
        }

        public function setUsername($username) 
        {
            if(preg_match("/^[A-Za-z0-9]{3,25}$/", $username)) 
            {
                $this->username = $username;
                return true;
            } 
            else 
            {
                return false;
            }
        }
        public function getUsername() 
        {
            return $this->username;
        }

        public function setPassword($password, $password_repeat) 
        {
            if(strlen($password) >= 6 && strcmp($password, $password_repeat) == 0) 
            {
                $this->password = password_hash($password, PASSWORD_DEFAULT);
                return true;
            } 
            else 
            {
                return false;
            }
        }
        public function getPassword() 
        {
            return $this->password;
        }

        public function setEmail($email) 
        {
            if(strlen($email) <= 255) 
            {
                $this->email = $email;
                return true;
            } 
            else 
            {
                return false;
            }
        }
        public function getEmail() 
        {
            return $this->email;
        }

        
        public function getAdminRights() 
        {
            if($this->admin == 1) 
            {
                return true;
            } else 
            {
                return false;
            }
        }
        
    }