<?php
/** 
 * @category ScaleCalculator - PHP class for calculate musics scales
 * @version 1.0.0
 * @author franckysolo <franckysolo@gmail.com>
 * @license http://creativecommons.org/licenses/by-sa/3.0/  CC BY-SA 3.0
 * @package scale-calculator
 * @filesource  ScaleCalculator.php
 */
class ScaleCalculator {

    /**
     * Colors keys
     *
     * @var string
     */
    const MAJOR             = 'major';
    const MINOR_HARMONIC    = 'minor-harmonic';
    const MINOR_MELODIC     = 'minor-melodic' ;
    const PENTA_MAJOR       = 'pentatonic-major';
    const PENTA_MINOR       = 'pentatonic-minor';

    /**
     * Notations
     *
     * @var array
     */
    protected $flats  = array('C','Db','D','Eb','E','F','Gb','G','Ab','A','Bb','B');
    protected $sharps = array('C','C#','D','D#','E','F','F#','G','G#','A','A#','B');

    /**
     * Intervales for scales
     *
     * @var array
     */
    protected $scales  = array (

        self::MAJOR             => array(0, 2, 4, 5, 7, 9, 11, 0),
        self::MINOR_HARMONIC    => array(0, 2, 3, 5, 7, 8, 11, 0),
        self::MINOR_MELODIC     => array(0, 2, 3, 5, 7, 9, 11, 0),
        self::PENTA_MAJOR       => array(0, 2, 4, 7, 11, 0),
        self::PENTA_MINOR       => array(0, 3, 5, 8, 10, 0),

    );

    /**
     * The current scale
     *
     * @var array
     */
    protected $scale = array();
     
    /**
     * The current notes
     *
     * @var array
     */
    protected $current = array();

    /**
     * The number of notes
     * 
     * @return int
     */
    public function max() {
        return count($this->flats);
    }
     
    /**
     * The number of notes for the current scale transposed
     * 
     * @return int
     */
    public function count() {
        return count($this->scale);
    }

    /**
     * Returns the scales intervals array
     * 
     * @return array
     */
    public function getScales() {
        return $this->scales;
    }
    
    /**
     * Returns the sharps notes name array
     * 
     * @return array
     */
    public function getSharps() {
        return $this->sharps;
    }
    
    /**
     * Returns the flats notes name array
     * 
     * @return array
     */
    public function getFlats() {
        return $this->flats;
    }

    /**
     * Returns the interval scale array
     * 
     * @param int $index
     * @return mixed NULL | array
     */
    public function getScale($index) {
        if (isset($this->scales[$index])) {
            return $this->scales[$index];
        }

        return null;
    }

    /**
     * Returns the transpose note to flats array form index interval
     * 
     * @param int $index
     * @return mixed NULL | string
     */
    public function getFlat($index) {
        if (isset($this->flats[$index])) {
            return $this->flats[$index];
        }

        return null;
    }

    /**
     * Returns the transpose note to sharps array form index interval
     * 
     * @param int $index
     * @return mixed NULL | string
     */
    public function getSharp($index) {
        if (isset($this->sharps[$index])) {
            return $this->sharps[$index];
        }

        return null;
    }

    /**
     * Returns the current note form index interval
     * 
     * @param int $index
     * @return mixed NULL | string
     */
    public function getCurrent($index) {
        if (isset($this->current[$index])) {
            return $this->current[$index];
        }

        return null;
    }

    /**
     * Transpose scale from keynote
     *
     * @param int $keynote
     * @param string $color
     * @throws InvalidArgumentException
     * @return string the scale transpose from keynote
     */
    public function transpose($keynote, $color = 'major') {
         
        // Supported scales type
        if (! isset($this->scales[$color])) {
            $message = sprintf('%s scale color not supported', $color);
            throw new InvalidArgumentException($message, 500);
        }

        switch ($keynote) {
            case 0:
            case 1:
            case 3:
            case 5:
            case 6:
            case 8:
            case 10:
                $this->current = $this->flats;
                break;
                 
            default:
                $this->current = $this->sharps;
                break;
        }

        foreach ($this->scales[$color] as $note) {
            array_push($this->scale, $this->current[($keynote + $note) % 12]);
        }
         
        return implode (' - ', $this->scale);
    }
}
