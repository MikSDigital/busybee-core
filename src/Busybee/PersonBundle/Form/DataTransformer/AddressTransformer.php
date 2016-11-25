<?php
namespace Busybee\PersonBundle\Form\DataTransformer;

use Busybee\PersonBundle\Entity\Address ;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class AddressTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transform an Object to a string
     *
     * @param  object $data Address
     * @return string
     */
    public function transform($data)
    {
		if ($data instanceof Address)
			return $data->getId();
		return null ;
    }

    /**
     * Transforms a string to an Address Object
     *
     * @param  string $data
     * @return Object
     */
    public function reverseTransform($data)
    {
		if (is_null($data))
			return null;
        $address = $this->manager
            ->getRepository('BusybeePersonBundle:Address')
            // query for the issue with this id
            ->find($data)
        ;

        if (is_null($address)) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException('This message is 0verwritten by the validation message. ' . __FILE__ . __LINE__);
        }

        return $address;
    }
}