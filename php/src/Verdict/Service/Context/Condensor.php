<?php

/**
 * Condenses context variables into a non-nested format.
 * @author Ryan Fink <ryanjfink@gmail.com>
 * @since  June 8, 2012
 */

namespace Verdict\Service\Context;

class Condensor
{
    /**
     * Condense our variables down into a single, non-hierarchical array (usually for UI purposes)
     * @param array $contextVars
     * @return array
     */
    public function condenseVars(array $contextVars)
    {
        return $this->doCondenseVars($contextVars);
    }
    
    /**
     * Private condensor, break this out to ease recursion
     * @param array $contextVars
     * @param array $returnArray
     * @param string $kPrefix
     * @return array
     */
    private function doCondenseVars(array $contextVars, array $returnArray = array(), $kPrefix = null)
    {
        foreach ($contextVars as $key => $val)
        {
            $k = isset($kPrefix) ? $kPrefix . '::' . $key : $key;
            if (is_array($val) && !isset($val['isContextProperty']))
            {
                $returnArray = $this->doCondenseVars($contextVars[$key], $returnArray, $k);
            }
            else
            {
                $returnArray[$k] = $val;
                $returnArray[$k]['display'] = str_replace('::', '.', $k);
            }
        }
        return $returnArray;
    }
}
