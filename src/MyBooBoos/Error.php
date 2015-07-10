<?php
namespace MyBooBoos;

use HTTP\Response;
use HTTP\Response\ContentType;
use HTTP\Response\Status;

abstract class Error {

	protected $message;
	protected $data;

	/**
	 * Get text template path file
	 * @return String [Path to the file]
	 */
	abstract protected function getTEXT();

	/**
	 * Get HTML template path file
	 * @return String [Path to the file]
	 */
	abstract protected function getHTML();

	/**
	 * Get XML template path file
	 * @return String [Path to the file]
	 */
	abstract protected function getXML();

	/**
	 * Get JSON template path file
	 * @return String [Path to the file]
	 */
	abstract protected function getJSON();

	/**
	 * Get error tag that will appear in the error logs.
	 * Example: <tag>: Something went wrong
	 * @return String [Tag name]
	 */
	abstract public function getTag();

	/**
	 * @param String  $message    Message to be used in the logs. Advice: use defined
	 *                            constants or exception messages generated by the application.
	 * @param mixed   @data       Data to pass to the templates
	 */
	public function __construct($message, $data = null) {
		$this->message = $message;
		$this->data = $data;
	}

	/**
	 * Return an error message in the format that was specified
	 * @param  String $contentType String that represents an HTTP content-type
	 * @return String 			   String Buffer containing a template
	 */
	public function printErrorMessage($contentType) {
		switch($contentType) {
			case ContentType::TEXT:
				return $this->getContents($this->getText());
				break;
			case ContentType::HTML:
				return $this->getContents($this->getHTML());
				break;
			case ContentType::XML:
				return $this->getContents($this->getXML());
				break;
			case ContentType::JSON:
				return $this->getContents($this->getJSON());
				break;
		}
	}

	/**
	 * Return the tag when using a MyBooBoos object as a string
	 * @return String [Tag coming from getTag()]
	 */
	public function __toString() {
		return $this->getTag();
	}

	/**
	 * Return a buffer with the loaded template
	 * @param  String $file Path to file
	 * @param  mixed $data
	 * @return String       String buffer containing a template
	 */
	protected function getContents($file) {
		ob_start();
		$data = $this->data;
		include($file);
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}

	/**
	 * Get error message that was passed in the constructor
	 * @return String [Error message]
	 */
	public function getMessage() {
		return $this->message;
	}
}
