<?php

/**
 * Interface defining public access to Filter objects.
 * @author  Ryan Fink <rfink@redventures.net>
 * @since   April 16, 2012
 */

namespace Verdict\Filter;

interface FilterInterface
{
    /**
     * Evaluate our conditions and return a boolean
     * @return boolean
     */
	public function evaluate();
}
