<?php
class File
{
    
    private $_filePath;
    private $_fileName;
    private $_fileExt;
    private $_fileSize;

    private $_fp;

    public function setFp($fp)
    {
        $this->_fp = $fp;
    }
    public function getFp()
    {
        return $this->_fp;
    }

    public function setFilePath($filePath)
    {
        $this->_filePath = ROOT . trim($filePath, '/');
    }
    public function getFilePath()
    {
        return $this->_filePath;
    }

    public function setFileName($fileName)
    {
        $this->_fileName = $fileName;
    }
    public function getFileName()
    {
        return $this->_fileName;
    }

    public function setFileExt($fileExt)
    {
        $this->_fileExt = $fileExt;
    }
    public function getFileExt()
    {
        return $this->_fileExt;
    }

    public function setFileSize($fileSize)
    {
        $this->_fileSize = $fileSize;
    }
    public function getFileSize()
    {
        return $this->_fileSize;
    }
	
	public function getFileFullPath()
	{
		return $this->getFilePath() . DS . $this->getFileName() . '.' . $this->getFileExt();
	}

    public function open($uri = '', $ACCESSMODE = 'r')
    {
        $fp = fopen($uri, $ACCESSMODE);
        if (is_resource($fp))
        {
            $this->setFp($fp);
            return true;
        }
        else
        {
            return null;
        }
    }
	
	public function write($content)
	{
		if ($this->getFp())
		{
			$len = fwrite($this->getFp(), $content, $this->getFileSize());
			if ($len !== false)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	public function overwrite($content)
	{
		$this->open($this->getFileFullPath(), "w+");
		$this->write($content);
		$this->close();
	}
	
	public function exists($filePath)
	{
		if (file_exists($filePath))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}

    public function readContent()
    {
        $content = '';
        if ($this->getFp())
        {
            while ($line = fgets($this->getFp(), 1024))
            {
                $content .= $line;
            }    
        }
        return $content;
    }

    public function close()
    {
        if (is_resource($this->getFp()))
        {
            fclose($this->getFp());
        }
        // else
        //        {
        //            BIOS::raise('NullPointer');
        //        }
    }



}