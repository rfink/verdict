<?php

/**
 * Generic implementation of a context object, use this if you have a one-off use case
 *   that doesn't have any re-usability.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  May 14, 2012
 */

namespace Verdict\Context;

use Verdict\Context\Property\PropertyInterface,
    Verdict\Context\Property\Generic as GenericProperty,
	InvalidArgumentException;

class Generic implements ContextInterface
{
    /**
     * Our delimiter between nested properties
     * @var string
     */
    private $delimiter = '::';
    /**
     * Array of properties for the generic object
     * @var array 
     */
    private $properties = array();
    
    /**
     * Convenience constructor, pass in an array for this to auto-create a generic nested context object
     * @param array $buildData
     * @param array $data
     */
    public function __construct(array $buildData = array(), array $data = null)
    {
        foreach ($buildData as $key => $value)
        {
            // If we have a property, treat it as such
            if ($value instanceof PropertyInterface)
            {
                $this->addElement($key, $value);
            }
            // Otherwise, we have another context
            else
            {
                $this->addElement($key, new static($value));
            }
        }
        // If contextual data was passed in, merge it
        if (isset($data))
        {
            $this->mergeInto($this->properties, $data);
        }
    }
    
    /**
     * Get value (recursive)
     * @param type $key
     * @return mixed
	 * @throws InvalidArgumentException
     */
    public function getValue($key)
    {
		if (empty($key))
		{
			throw new InvalidArgumentException('Empty key supplied');
		}
        $ref = $this->getPropertyReference($key);
		if (!isset($ref))
		{
			throw new InvalidArgumentException('Key ' . $key . ' was not found');
		}
        return $ref->getValue($this);
    }
    
    /**
     * Get context/property object recursively (using the delimiter to inspect into nested objects)
     * @param string $key
     * @return PropertyInterface
     */
    public function property($key)
    {
        $ref = $this->getPropertyReference($key);
        if ($ref instanceof PropertyInterface)
        {
            return $ref;
        }
        return null;
    }
    
    /**
     * Get direct property reference
     * @param string $key
     * @return ContextInterface
     */
    public function getProperty($key)
    {
        if (isset($this->properties[$key]))
        {
            return $this->properties[$key];
        }
        return null;
    }
    
    /**
     * @inheritDoc
     */
    public function getProperties()
    {
        return $this->properties;
    }
    
    /**
     * Set value (allow this to be recursive, by using a property name separated by the delimiter)
     * @param string $key
     * @param mixed $value
     * @return Generic 
     */
    public function setValue($key, $value)
    {
        $ref = $this->getPropertyReference($key);
        $ref->setValue($value);
        return $this;
    }
    
    /**
     * Add a context/property element
     * @param ContextInterface|PropertyInterface $element
     * @return Generic 
     */
    public function addElement($key, $element)
    {
        $this->properties[$key] = $element;
        return $this;
    }
    
    /**
     * Set delimiter
     * @param string $delimiter
     * @return Generic
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = (string) $delimiter;
        return $this;
    }
    
    /**
     * Recursive population method
     * @param array $data
     * @param array $authority
     * @return Generic
     */
    public function mergeInto(array $data, array $authority = null)
    {
        if (!isset($authority))
        {
            $authority = $this->properties;
        }
        // Iterate our data, determine if we need to set the value or recurse into another array
        foreach($authority as $key => $property)
        {
            // If we are merging this property in
            if (isset($data[$key]))
            {
                // If we have an array and the current property context is a property (and not another context)
                if (is_array($data[$key]) && !($property instanceof PropertyInterface))
                {
                    $this->mergeInto($data[$key], $property->getProperties());
                }
                else
                {
                    $property->setValue($data[$key]);
                }
            }
        }
        return $this;
    }
    
    /**
     * Recursive method for digging into a key and returning the nested reference
     * @param string $key
     * @return PropertyInterface
     * @throws InvalidArgumentException
     */
    private function getPropertyReference($key)
    {
        $props = explode($this->delimiter, $key);
        $name = array_shift($props);
        if (!isset($this->properties[$name]))
        {
            throw new InvalidArgumentException('Invalid keyspace provided (' . $name . ')');
        }
        $ref = $this->properties[$name];
        while($name = array_shift($props))
        {
            $ref = $ref->getProperty($name);
            if (!isset($ref))
            {
                throw new InvalidArgumentException('Invalid keyspace provided (' . $name . ')');
            }
        }
        return $ref;
    }
}
