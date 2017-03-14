<?php

namespace Instante\NeonConfigurator;

use Nette\Neon\Neon;

class NeonEditor
{
    /** @var mixed */
    public $data;

    /** @var resource file handle */
    private $file;

    /** @var string */
    private $indent;

    /**
     * @param string $filename
     * @param string|null $indent: indentation string or null to auto-detect
     */
    public function __construct($filename, $indent = null)
    {
        $this->file = fopen($filename, 'r+');
        flock($this->file, LOCK_EX);
        $size = filesize($filename);
        $rawNeon = $size > 0 ? fread($this->file, filesize($filename)) : '';
        if ($indent === null) {
            if (preg_match('~^[\t ]+(?!$)~m', $rawNeon, $m)) {
                $indent = $m[0];
            } else {
                $indent = "\t";
            }
        }
        $this->indent = $indent;
        $this->data = Neon::decode($rawNeon);
    }

    public function setByKey($key, $value)
    {
        $keyParts = explode('.', $key);
        $section = &$this->data;
        $endKey = array_pop($keyParts);
        foreach ($keyParts as $keyPart) {
            if(!array_key_exists($keyPart, $section)) {
                $section[$keyPart] = [];
            }
            $section = &$section[$keyPart];
        }
        $value = $this->processType($value);
        $section[$endKey] = $value;
    }

    public function save()
    {
        ftruncate($this->file, 0);
        rewind($this->file);
        fwrite($this->file, $this->adjustIndentationType(Neon::encode($this->data, Neon::BLOCK)));
        fflush($this->file);
    }

    public function __destruct()
    {
        flock($this->file, LOCK_UN);
        fclose($this->file);
    }

    private function adjustIndentationType($neonString)
    {
        if ($this->indent !== "\t") {
            $neonString = str_replace("\t", $this->indent, $neonString);
        }
        return $neonString;
    }

    private function processType($value)
    {
        return Neon::decode($value); //decode native Neon value
    }
}
