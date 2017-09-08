<?php

namespace Blogger\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 */
class User implements UserInterface
{
    /**
     * @var int
     */
    private $id;
        
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;
   

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Blog
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     * >> Returns the username used to authenticate the user.
     * @return string  $username
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * Set password
     * @param string $password
     * @return Blog
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    
    /**
     * Get password
     * Returns the password used to authenticate the user.
     * Đây phải là mật khẩu được mã hóa. 
     * Khi xác thực, một mật khẩu văn bản thuần túy sẽ được làm muối,
     *  mã hoá và sau đó so sánh với giá trị này.
     * @return string  $password
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set salt
     * >> Returns the salt that was originally used to encode the password.
     * Điều này có thể trở lại null nếu mật khẩu không được mã hóa bằng cách
     *  sử dụng một muối.
     * @param string $salt
     * @return Blog
     */    
    public function getSalt()
    {
        return '';
    }
    
    /**
     * Get roles
     * >> Returns the roles granted to the user.
     * @return string  $roles
     */
    public function getRoles()
    {
        return ['ROLE_USER', 'ROLE_ADMIN'];
    }
    
    /**
     * eraseCredentials
     * >> Removes sensitive data from the user.
     */
    public function eraseCredentials()
    {
        return [];  
    }
}
