<?php

/**
 * +=============+
 * || Copyright ||
 * +=============+
 * ========================================================================
 * || Diese Datei wurde
 * || erstellt am 07.06.2010 um 23:54:15
 * || von Crimson (Maik Reinhardt)
 * || @version 4.0.0
 * ========================================================================
 *
 * Das Script unterliegt dem Urheberschutz Gesetz. Alle Rechte und
 * Copyrights liegen bei http://www.Xk-Hosting.info!
 * Dies Script darf NICHT frei verwendet und/oder weitergegeben werden.
 * Die angegebenen Copyrightvermerke muessen in allen Teilen des Scriptes
 * vorhanden bleiben, sonst machen sie sich strafbar.
 * Fuer den fehlerfreien Betrieb, oder Schaeden die durch
 * den Betrieb dieses Scriptes entstehen, uebernimmt der Autor keinerlei
 * Gewaehrleistung. Die Inbetriebnahme erfolgt in jedem Falle
 * auf eigenes Risiko.
 */

/**
 * Diese Klasse Ver- und Entschluesselt die Get Variablen.
 */
class Crypt {
    const CRYPTKEY = 'jlAhg78v43tzcB0Vca1cdf';
    const CRYPTVI = '234sSfF80kcdbfvE';
    const stingDelimeter = ':|:';
    
    const deceptionStringName = 'iGy3';
    const deceptionStringLength = 6;

    /**
     * Diese Funktion verschluesselt den Wert.
     * @param <sting> $inp Der Wert der verschluesselt werden soll.
     * @return <string>
     */
    public static function Encrypt($inp) {
        $crypt = str_rot13(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, self::CRYPTKEY,self::deceptionStringName . '=' . self::randomString() . '&' . $inp . '&' . self::deceptionStringName . '=' . self::randomString(), MCRYPT_MODE_CFB, self::CRYPTVI)));
        return $crypt . self::stingDelimeter . self::makeHashFromString($crypt);
    }

    /**
     * Diese Funktion entschluesselt den Wert.
     * @param <sting> $inp Der Wert der entschluesselt werden soll.
     * @return <string>
     */
    private static function Decrypt($inp) {
        return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, self::CRYPTKEY, base64_decode(str_rot13($inp)), MCRYPT_MODE_CFB, self::CRYPTVI);
    }

    /**
     * Diese Funktion splittet die Werte in das Get Array auf.
     */
    public static function Split() {
        if ($_SERVER['QUERY_STRING']) {
            $string = explode(self::stingDelimeter, $_SERVER['QUERY_STRING']);
            if (self::makeHashFromString($string[0]) !== $string[1]) {
                die('Eine Parameterverf&auml;lschung wurde ermittelt.');
            }
            $split = explode('&', self::Decrypt($string[0]));
            $get = array();
            foreach ($split as $v) {
                $endArray = explode('=', $v);
                if ($endArray[0] != self::deceptionStringName) {
                    $get[$endArray[0]] = $endArray[1];
                }
            }
            return $get;
        }
    }

    /**
     * Die decodierten GET Variablen ausgeben.
     * @return <string>
     */
    public static function getVars() {
        if ($_SERVER['QUERY_STRING']) {
            foreach (self::Split() as $k => $v) {
                $return .= "$k => $v<br />";
            }
            return $return;
        }
        return false;
    }

    /**
     * Die GET Variablen fuer ein Logging ausgeben.
     * @return <string>
     */
    public static function getVarsForLogging() {
        if ($_SERVER['QUERY_STRING']) {
            foreach (self::Split() as $k => $v) {
                $return .= "$k => $v | ";
            }
            return $return;
        }
        return false;
    }

    /**
     * Es wird ein Integer aus dem String erzeugt der fuer eine Stringpruefung benutzt wird.
     * @param <string> $string
     * @return <int>
     */
    private static function makeHashFromString($string) {
        return preg_replace("/[^0-9]/", "", md5($string . sha1($string . md5($string . sha1($string) . $string) . $string) . $string));
    }

    /**
     * Die Funktion erzeugt einen Zufallsstring der in der Verschluesselung einen Zufallswert beisetzt.
     * @return <string> Zufallsstring
     */
    public static function randomString() {
        $result = null;
        for ($i = 0; $i < self::deceptionStringLength; $i++) {
            $num = rand(48, 120);
            while (($num >= 58 && $num <= 64) || ($num >= 91 && $num <= 96)) {
                $num = rand(48, 120);
            }
            $result .= chr($num);
        }
        return $result;
    }

}

?>
