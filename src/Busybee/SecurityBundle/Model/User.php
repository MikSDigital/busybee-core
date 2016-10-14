<?php
namespace Busybee\SecurityBundle\Model;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Storage agnostic user object
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
abstract class User implements UserInterface
{
	protected $plainPassword;

	protected $roles;
	
	public function __construct() {
		
		$this->roles = array();
		$this->setLocked(false);
		$this->setEnabled(false);
		$this->setExpired(false);
		$this->setCredentialsexpired(false);
		$this->locale = 'en_GB';
	}
    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
	public function getRoles()
	{
		if (! empty($this->roles))
			return $this->roles;
		$this->roles = array();

		$groups = $this->getGroups();

		foreach($groups as $group) 
		{
			$roles = $group->getRoles();
			foreach($roles as $role) 
			{
			 	$this->roles = array_merge($this->roles, array($role->getRole()));
			}
		}
		foreach($this->getDirectroles() As $role)
			$this->roles = array_merge($this->roles, array($role->getRole()));
		
		return $this->roles;
	}
 
    
	public function getPlainPassword()
    {
        return $this->plainPassword;
    }	

	public function getSalt() 
 	{

		return null;
 	}

	public function setPlainPassword($password)
	{

		$this->plainPassword = $password;
		return $this;
	}

	public function isSuperAdmin()
	{
	
		return $this->hasRole(static::ROLE_SUPER_ADMIN);
	}

	public function setSuperAdmin($boolean)
	{
	
		if (true === $boolean) 
			$this->addRole(static::ROLE_SUPER_ADMIN);
		else
			$this->removeRole(static::ROLE_SUPER_ADMIN);
		
		return $this;
	}

	public function isPasswordRequestNonExpired($ttl)
	{

		return $this->getPasswordRequestedAt() instanceof \DateTime && $this->getPasswordRequestedAt()->getTimestamp() + $ttl > time();
	}

    public function isAccountNonExpired()
    {
        if (true === $this->expired) {
            return false;
        }

        if (null !== $this->expiresAt && $this->expiresAt->getTimestamp() < time()) {
            return false;
        }

        return true;
    }

    public function isAccountNonLocked()
    {
        return !$this->locked;
    }

    public function isCredentialsNonExpired()
    {

        if (true === $this->credentialsExpired) 
            return false;
		return true;
	}

    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Removes sensitive data from the user.
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /**
     * Serializes the user.
     *
     * The serialized data have to contain the fields used by the equals method and the username.
     *
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            $this->password,
            $this->usernameCanonical,
            $this->username,
            $this->expired,
            $this->locked,
            $this->credentialsExpired,
            $this->enabled,
            $this->id,
        ));
    }
    /**
     * Unserializes the user.
     *
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        // add a few extra elements in the array to ensure that we have enough keys when unserializing
        // older data which does not include all properties.
        $data = array_merge($data, array_fill(0, 2, null));

        list(
            $this->password,
            $this->usernameCanonical,
            $this->username,
            $this->expired,
            $this->locked,
            $this->credentialsExpired,
            $this->enabled,
            $this->id
        ) = $data;
    }

	public function getChangePassword()
	{
		return false ;
	}
}
