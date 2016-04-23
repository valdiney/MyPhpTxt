<?php 
/*
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @author Valdiney França <valdiney.2@hotmail.com>
* @version 0.1
* With this class you can pass data into the text file of simple way.
*/
class MyPhpTxt
{
	protected $path;
	protected $file;

	private $fileResource;

	public function __construct($path = false)
	{
		if($path)
			$this->setPath($path);
	}

	/**
     * Sets the path of file in the protected attribute "path"
     * @param String $path Path to file folder
     */
	public function setPath($path)
	{
		$this->path = $path;
	}
    
    /**
     * Sets the file in the protected attribute "file"
     * @param String $file Name without file extension
     */
	public function setFile($file)
	{
		$this->file = $file;
	}

	/**
     * Sets the file in the protected attribute "file"
     * @param String $file Name without file extension
     * @param String $mode Access type. Accepted values: 'r', 'r+', 'w', 'w+', 'a', 'a+', 'x', 'x+'
     * More information in http://php.net/manual/pt_BR/function.fopen.php
     */
	protected function openFile($mode)
	{
		# Set the accepted access types
		$acceptedAccessType = ['r', 'r+', 'w', 'w+', 'a', 'a+', 'x', 'x+'];

		$file = "{$this->path}/{$this->file}.txt";

		if($this->file == "") {
			throw new Exception("The name entered for the file is not valid");
		}

		# Checks if the given type is accepted
		if(in_array($mode, $acceptedAccessType)) {
			$this->fileResource = fopen($file, $mode);
		} else {
			throw new Exception("The access type entered is not valid");
		}
	}

	/**
	 * Create a new file
	 * @param  String $fileName File name
	 */
	public function createFile()
	{
		$this->openFile("w");
	}

	/**
	 * Get the contents of a file
	 * @param  int $length Total bytes to be read
	 * @return String File Content
	 */
	public function getContent($length = false)
	{
		$file = "{$this->path}/{$this->file}.txt";

		if($length ===  false) {
			$length = filesize($file);
		}

		if(!is_file($file)) {
			throw new Exception("The specified file does not exist");
		}

		if($length == 0) {
			return "";
		}

		$this->openFile("r");

		return fread($this->fileResource, $length);
	}
    
    /**
     * Write the data in the txt file
     * @param  String $content Text to be written to the file
     */
	public function setContent($content)
	{
		$this->openFile("r+");
		fwrite($this->fileResource, $content);
	}

	/**
     * Write the data in the txt file
     * @param  String $content Text to be written to the file
     */
	public function appendCotent($content)
	{
		$this->openFile("a");
		fwrite($this->fileResource, $content);
	}
    
    # You shold use this method to close de connection with the archive
	public function closeFile()
	{
		if($this->fileResource)
			fclose($this->fileResource);
	}
}

/**
 * Observações
 * 
 * O nome da classe foi atualizado apenas como sugestão. Não acho bacana o nome de uma classe ser um verbo, acho melhor 
 * usar um substantivo já que verbos são mais utilizados para nomes de métodos, além disse "Export" limita a classe a só exportar,
 * mas nós podemos deixar ela mais interessante...
 * Ex.: Classe "Cachorro", Método "Latir"
 *
 * Não estamos usando Python, não use snake_case, use camelCase ;)
 *
 * A variável help foi removida porque não há necessidade para a sua exitência, fora que o nome não faz sentido.
 *
 * 
 */