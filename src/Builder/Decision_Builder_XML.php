<?php

/**
 * Build a decision engine from an XML file
 * @author rfink
 * @since  Mar 19, 2011
 */
class Decision_Builder_XML extends Decision_Builder_Abstact {

	/**
	 * Our XML file name to operate on
	 * @var string
	 */
	protected $_fileName = '';


	/**
	 * Instantiate our object and set the file name on the object
	 * @param string $fileName
	 * @return Decision_Builder_XML
	 */
	public function __construct($fileName) {

		$this->set_file_name($fileName);

	}


	/**
	 * Set our file name on the object
	 * @param string $fileName
	 * @return Decision_Builder_XML
	 * @throws InvalidArgumentException
	 */
	public function set_file_name($fileName) {

		if (!is_readable($fileName)) {

			throw new InvalidArgumentException('File ' . $fileName . ' is not readable');

		}

		$this->_fileName = $fileName;
		return $this;

	}


	/**
	 * Build our decision engine from the given xml file
	 * @return Decision_Engine
	 */
	public function build() {



	}

}
