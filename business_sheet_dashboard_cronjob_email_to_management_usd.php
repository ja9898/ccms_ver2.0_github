<?php
//include('config.php');
//include('include/header.php'); 
$database="testnew";
$username="root";
$password="";
/*$r = mysql_connect('localhost',$username,$password);
if (!$r) {
    echo "Could not connect to server\n";
    trigger_error(mysql_error(), E_USER_ERROR);
} else {
    echo "Connection established\n"; 
}*/

$link = mysql_connect('localhost', $username, $password);
if (!$link) {
    die('Not connected : ' . mysql_error());
}
else {
    echo "Connection established\n"; 
}
if (! mysql_select_db($database) ) {
    die ('Can\'t use cloud_new1 : ' . mysql_error());
}
//********************************IMPORTANT****************************************
//Callng files of PHPMAILER didn't work 
//require("C:/wamp/www/New_folder/PHPMailer-master-bus-sheet/class.phpmailer.php");
//require("C:/wamp/www/New_folder/PHPMailer-master-bus-sheet/class.smtp.php");
//********************************IMPORTANT****************************************
//- So calling whole code from PHPMAILER

//**********************IMPORTANT - Following is (phpmailer class) code OF PHPMAILER***************************
/**
 * PHPMailer - PHP email creation and transport class.
 * PHP Version 5
 * @package PHPMailer
 * @link https://github.com/PHPMailer/PHPMailer/ The PHPMailer GitHub project
 * @author Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 * @author Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
 * @author Brent R. Matzelle (original founder)
 * @copyright 2012 - 2014 Marcus Bointon
 * @copyright 2010 - 2012 Jim Jagielski
 * @copyright 2004 - 2009 Andy Prevost
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * PHPMailer - PHP email creation and transport class.
 * @package PHPMailer
 * @author Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 * @author Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
 * @author Brent R. Matzelle (original founder)
 */
class PHPMailer
{
    /**
     * The PHPMailer Version number.
     * @type string
     */
    public $Version = '5.2.10';

    /**
     * Email priority.
     * Options: 1 = High, 3 = Normal, 5 = low.
     * @type integer
     */
    public $Priority = 3;

    /**
     * The character set of the message.
     * @type string
     */
    public $CharSet = 'iso-8859-1';

    /**
     * The MIME Content-type of the message.
     * @type string
     */
    public $ContentType = 'text/plain';

    /**
     * The message encoding.
     * Options: "8bit", "7bit", "binary", "base64", and "quoted-printable".
     * @type string
     */
    public $Encoding = '8bit';

    /**
     * Holds the most recent mailer error message.
     * @type string
     */
    public $ErrorInfo = '';

    /**
     * The From email address for the message.
     * @type string
     */
    public $From = 'root@localhost';

    /**
     * The From name of the message.
     * @type string
     */
    public $FromName = 'Root User';

    /**
     * The Sender email (Return-Path) of the message.
     * If not empty, will be sent via -f to sendmail or as 'MAIL FROM' in smtp mode.
     * @type string
     */
    public $Sender = '';

    /**
     * The Return-Path of the message.
     * If empty, it will be set to either From or Sender.
     * @type string
     * @deprecated Email senders should never set a return-path header;
     * it's the receiver's job (RFC5321 section 4.4), so this no longer does anything.
     * @link https://tools.ietf.org/html/rfc5321#section-4.4 RFC5321 reference
     */
    public $ReturnPath = '';

    /**
     * The Subject of the message.
     * @type string
     */
    public $Subject = '';

    /**
     * An HTML or plain text message body.
     * If HTML then call isHTML(true).
     * @type string
     */
    public $Body = '';

    /**
     * The plain-text message body.
     * This body can be read by mail clients that do not have HTML email
     * capability such as mutt & Eudora.
     * Clients that can read HTML will view the normal Body.
     * @type string
     */
    public $AltBody = '';

    /**
     * An iCal message part body.
     * Only supported in simple alt or alt_inline message types
     * To generate iCal events, use the bundled extras/EasyPeasyICS.php class or iCalcreator
     * @link http://sprain.ch/blog/downloads/php-class-easypeasyics-create-ical-files-with-php/
     * @link http://kigkonsult.se/iCalcreator/
     * @type string
     */
    public $Ical = '';

    /**
     * The complete compiled MIME message body.
     * @access protected
     * @type string
     */
    protected $MIMEBody = '';

    /**
     * The complete compiled MIME message headers.
     * @type string
     * @access protected
     */
    protected $MIMEHeader = '';

    /**
     * Extra headers that createHeader() doesn't fold in.
     * @type string
     * @access protected
     */
    protected $mailHeader = '';

    /**
     * Word-wrap the message body to this number of chars.
     * Set to 0 to not wrap. A useful value here is 78, for RFC2822 section 2.1.1 compliance.
     * @type integer
     */
    public $WordWrap = 0;

    /**
     * Which method to use to send mail.
     * Options: "mail", "sendmail", or "smtp".
     * @type string
     */
    public $Mailer = 'mail';

    /**
     * The path to the sendmail program.
     * @type string
     */
    public $Sendmail = '/usr/sbin/sendmail';

    /**
     * Whether mail() uses a fully sendmail-compatible MTA.
     * One which supports sendmail's "-oi -f" options.
     * @type boolean
     */
    public $UseSendmailOptions = true;

    /**
     * Path to PHPMailer plugins.
     * Useful if the SMTP class is not in the PHP include path.
     * @type string
     * @deprecated Should not be needed now there is an autoloader.
     */
    public $PluginDir = '';

    /**
     * The email address that a reading confirmation should be sent to.
     * @type string
     */
    public $ConfirmReadingTo = '';

    /**
     * The hostname to use in Message-Id and Received headers
     * and as default HELO string.
     * If empty, the value returned
     * by SERVER_NAME is used or 'localhost.localdomain'.
     * @type string
     */
    public $Hostname = '';

    /**
     * An ID to be used in the Message-Id header.
     * If empty, a unique id will be generated.
     * @type string
     */
    public $MessageID = '';

    /**
     * The message Date to be used in the Date header.
     * If empty, the current date will be added.
     * @type string
     */
    public $MessageDate = '';

    /**
     * SMTP hosts.
     * Either a single hostname or multiple semicolon-delimited hostnames.
     * You can also specify a different port
     * for each host by using this format: [hostname:port]
     * (e.g. "smtp1.example.com:25;smtp2.example.com").
     * You can also specify encryption type, for example:
     * (e.g. "tls://smtp1.example.com:587;ssl://smtp2.example.com:465").
     * Hosts will be tried in order.
     * @type string
     */
    public $Host = 'localhost';

    /**
     * The default SMTP server port.
     * @type integer
     * @TODO Why is this needed when the SMTP class takes care of it?
     */
    public $Port = 25;

    /**
     * The SMTP HELO of the message.
     * Default is $Hostname.
     * @type string
     * @see PHPMailer::$Hostname
     */
    public $Helo = '';

    /**
     * What kind of encryption to use on the SMTP connection.
     * Options: '', 'ssl' or 'tls'
     * @type string
     */
    public $SMTPSecure = '';

    /**
     * Whether to enable TLS encryption automatically if a server supports it,
     * even if `SMTPSecure` is not set to 'tls'.
     * Be aware that in PHP >= 5.6 this requires that the server's certificates are valid.
     * @type boolean
     */
    public $SMTPAutoTLS = true;

    /**
     * Whether to use SMTP authentication.
     * Uses the Username and Password properties.
     * @type boolean
     * @see PHPMailer::$Username
     * @see PHPMailer::$Password
     */
    public $SMTPAuth = false;

    /**
     * Options array passed to stream_context_create when connecting via SMTP.
     * @type array
     */
    public $SMTPOptions = array();

    /**
     * SMTP username.
     * @type string
     */
    public $Username = '';

    /**
     * SMTP password.
     * @type string
     */
    public $Password = '';

    /**
     * SMTP auth type.
     * Options are LOGIN (default), PLAIN, NTLM, CRAM-MD5
     * @type string
     */
    public $AuthType = '';

    /**
     * SMTP realm.
     * Used for NTLM auth
     * @type string
     */
    public $Realm = '';

    /**
     * SMTP workstation.
     * Used for NTLM auth
     * @type string
     */
    public $Workstation = '';

    /**
     * The SMTP server timeout in seconds.
     * Default of 5 minutes (300sec) is from RFC2821 section 4.5.3.2
     * @type integer
     */
    public $Timeout = 300;

    /**
     * SMTP class debug output mode.
     * Debug output level.
     * Options:
     * * `0` No output
     * * `1` Commands
     * * `2` Data and commands
     * * `3` As 2 plus connection status
     * * `4` Low-level data output
     * @type integer
     * @see SMTP::$do_debug
     */
    public $SMTPDebug = 0;

    /**
     * How to handle debug output.
     * Options:
     * * `echo` Output plain-text as-is, appropriate for CLI
     * * `html` Output escaped, line breaks converted to `<br>`, appropriate for browser output
     * * `error_log` Output to error log as configured in php.ini
     *
     * Alternatively, you can provide a callable expecting two params: a message string and the debug level:
     * <code>
     * $mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";};
     * </code>
     * @type string|callable
     * @see SMTP::$Debugoutput
     */
    public $Debugoutput = 'echo';

    /**
     * Whether to keep SMTP connection open after each message.
     * If this is set to true then to close the connection
     * requires an explicit call to smtpClose().
     * @type boolean
     */
    public $SMTPKeepAlive = false;

    /**
     * Whether to split multiple to addresses into multiple messages
     * or send them all in one message.
     * @type boolean
     */
    public $SingleTo = false;

    /**
     * Storage for addresses when SingleTo is enabled.
     * @type array
     * @TODO This should really not be public
     */
    public $SingleToArray = array();

    /**
     * Whether to generate VERP addresses on send.
     * Only applicable when sending via SMTP.
     * @link http://en.wikipedia.org/wiki/Variable_envelope_return_path
     * @link http://www.postfix.org/VERP_README.html Postfix VERP info
     * @type boolean
     */
    public $do_verp = false;

    /**
     * Whether to allow sending messages with an empty body.
     * @type boolean
     */
    public $AllowEmpty = false;

    /**
     * The default line ending.
     * @note The default remains "\n". We force CRLF where we know
     *        it must be used via self::CRLF.
     * @type string
     */
    public $LE = "\n";

    /**
     * DKIM selector.
     * @type string
     */
    public $DKIM_selector = '';

    /**
     * DKIM Identity.
     * Usually the email address used as the source of the email
     * @type string
     */
    public $DKIM_identity = '';

    /**
     * DKIM passphrase.
     * Used if your key is encrypted.
     * @type string
     */
    public $DKIM_passphrase = '';

    /**
     * DKIM signing domain name.
     * @example 'example.com'
     * @type string
     */
    public $DKIM_domain = '';

    /**
     * DKIM private key file path.
     * @type string
     */
    public $DKIM_private = '';

    /**
     * Callback Action function name.
     *
     * The function that handles the result of the send email action.
     * It is called out by send() for each email sent.
     *
     * Value can be any php callable: http://www.php.net/is_callable
     *
     * Parameters:
     *   boolean $result        result of the send action
     *   string  $to            email address of the recipient
     *   string  $cc            cc email addresses
     *   string  $bcc           bcc email addresses
     *   string  $subject       the subject
     *   string  $body          the email body
     *   string  $from          email address of sender
     * @type string
     */
    public $action_function = '';

    /**
     * What to put in the X-Mailer header.
     * Options: An empty string for PHPMailer default, whitespace for none, or a string to use
     * @type string
     */
    public $XMailer = '';

    /**
     * An instance of the SMTP sender class.
     * @type SMTP
     * @access protected
     */
    protected $smtp = null;

    /**
     * The array of 'to' addresses.
     * @type array
     * @access protected
     */
    protected $to = array();

    /**
     * The array of 'cc' addresses.
     * @type array
     * @access protected
     */
    protected $cc = array();

    /**
     * The array of 'bcc' addresses.
     * @type array
     * @access protected
     */
    protected $bcc = array();

    /**
     * The array of reply-to names and addresses.
     * @type array
     * @access protected
     */
    protected $ReplyTo = array();

    /**
     * An array of all kinds of addresses.
     * Includes all of $to, $cc, $bcc
     * @type array
     * @access protected
     */
    protected $all_recipients = array();

    /**
     * The array of attachments.
     * @type array
     * @access protected
     */
    protected $attachment = array();

    /**
     * The array of custom headers.
     * @type array
     * @access protected
     */
    protected $CustomHeader = array();

    /**
     * The most recent Message-ID (including angular brackets).
     * @type string
     * @access protected
     */
    protected $lastMessageID = '';

    /**
     * The message's MIME type.
     * @type string
     * @access protected
     */
    protected $message_type = '';

    /**
     * The array of MIME boundary strings.
     * @type array
     * @access protected
     */
    protected $boundary = array();

    /**
     * The array of available languages.
     * @type array
     * @access protected
     */
    protected $language = array();

    /**
     * The number of errors encountered.
     * @type integer
     * @access protected
     */
    protected $error_count = 0;

    /**
     * The S/MIME certificate file path.
     * @type string
     * @access protected
     */
    protected $sign_cert_file = '';

    /**
     * The S/MIME key file path.
     * @type string
     * @access protected
     */
    protected $sign_key_file = '';

    /**
     * The optional S/MIME extra certificates ("CA Chain") file path.
     * @type string
     * @access protected
     */
    protected $sign_extracerts_file = '';

    /**
     * The S/MIME password for the key.
     * Used only if the key is encrypted.
     * @type string
     * @access protected
     */
    protected $sign_key_pass = '';

    /**
     * Whether to throw exceptions for errors.
     * @type boolean
     * @access protected
     */
    protected $exceptions = false;

    /**
     * Unique ID used for message ID and boundaries.
     * @type string
     * @access protected
     */
    protected $uniqueid = '';

    /**
     * Error severity: message only, continue processing.
     */
    const STOP_MESSAGE = 0;

    /**
     * Error severity: message, likely ok to continue processing.
     */
    const STOP_CONTINUE = 1;

    /**
     * Error severity: message, plus full stop, critical error reached.
     */
    const STOP_CRITICAL = 2;

    /**
     * SMTP RFC standard line ending.
     */
    const CRLF = "\r\n";

    /**
     * The maximum line length allowed by RFC 2822 section 2.1.1
     * @type integer
     */
    const MAX_LINE_LENGTH = 998;

    /**
     * Constructor.
     * @param boolean $exceptions Should we throw external exceptions?
     */
    public function __construct($exceptions = false)
    {
        $this->exceptions = (boolean)$exceptions;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        //Close any open SMTP connection nicely
        if ($this->Mailer == 'smtp') {
            $this->smtpClose();
        }
    }

    /**
     * Call mail() in a safe_mode-aware fashion.
     * Also, unless sendmail_path points to sendmail (or something that
     * claims to be sendmail), don't pass params (not a perfect fix,
     * but it will do)
     * @param string $to To
     * @param string $subject Subject
     * @param string $body Message Body
     * @param string $header Additional Header(s)
     * @param string $params Params
     * @access private
     * @return boolean
     */
    private function mailPassthru($to, $subject, $body, $header, $params)
    {
        //Check overloading of mail function to avoid double-encoding
        if (ini_get('mbstring.func_overload') & 1) {
            $subject = $this->secureHeader($subject);
        } else {
            $subject = $this->encodeHeader($this->secureHeader($subject));
        }
        if (ini_get('safe_mode') || !($this->UseSendmailOptions)) {
            $result = @mail($to, $subject, $body, $header);
        } else {
            $result = @mail($to, $subject, $body, $header, $params);
        }
        return $result;
    }

    /**
     * Output debugging info via user-defined method.
     * Only generates output if SMTP debug output is enabled (@see SMTP::$do_debug).
     * @see PHPMailer::$Debugoutput
     * @see PHPMailer::$SMTPDebug
     * @param string $str
     */
    protected function edebug($str)
    {
        if ($this->SMTPDebug <= 0) {
            return;
        }
        //Avoid clash with built-in function names
        if (!in_array($this->Debugoutput, array('error_log', 'html', 'echo')) and is_callable($this->Debugoutput)) {
            call_user_func($this->Debugoutput, $str, $this->SMTPDebug);
            return;
        }
        switch ($this->Debugoutput) {
            case 'error_log':
                //Don't output, just log
                error_log($str);
                break;
            case 'html':
                //Cleans up output a bit for a better looking, HTML-safe output
                echo htmlentities(
                    preg_replace('/[\r\n]+/', '', $str),
                    ENT_QUOTES,
                    'UTF-8'
                )
                . "<br>\n";
                break;
            case 'echo':
            default:
                //Normalize line breaks
                $str = preg_replace('/(\r\n|\r|\n)/ms', "\n", $str);
                echo gmdate('Y-m-d H:i:s') . "\t" . str_replace(
                    "\n",
                    "\n                   \t                  ",
                    trim($str)
                ) . "\n";
        }
    }

    /**
     * Sets message type to HTML or plain.
     * @param boolean $isHtml True for HTML mode.
     * @return void
     */
    public function isHTML($isHtml = true)
    {
        if ($isHtml) {
            $this->ContentType = 'text/html';
        } else {
            $this->ContentType = 'text/plain';
        }
    }

    /**
     * Send messages using SMTP.
     * @return void
     */
    public function isSMTP()
    {
        $this->Mailer = 'smtp';
    }

    /**
     * Send messages using PHP's mail() function.
     * @return void
     */
    public function isMail()
    {
        $this->Mailer = 'mail';
    }

    /**
     * Send messages using $Sendmail.
     * @return void
     */
    public function isSendmail()
    {
        $ini_sendmail_path = ini_get('sendmail_path');

        if (!stristr($ini_sendmail_path, 'sendmail')) {
            $this->Sendmail = '/usr/sbin/sendmail';
        } else {
            $this->Sendmail = $ini_sendmail_path;
        }
        $this->Mailer = 'sendmail';
    }

    /**
     * Send messages using qmail.
     * @return void
     */
    public function isQmail()
    {
        $ini_sendmail_path = ini_get('sendmail_path');

        if (!stristr($ini_sendmail_path, 'qmail')) {
            $this->Sendmail = '/var/qmail/bin/qmail-inject';
        } else {
            $this->Sendmail = $ini_sendmail_path;
        }
        $this->Mailer = 'qmail';
    }

    /**
     * Add a "To" address.
     * @param string $address
     * @param string $name
     * @return boolean true on success, false if address already used
     */
    public function addAddress($address, $name = '')
    {
        return $this->addAnAddress('to', $address, $name);
    }

    /**
     * Add a "CC" address.
     * @note: This function works with the SMTP mailer on win32, not with the "mail" mailer.
     * @param string $address
     * @param string $name
     * @return boolean true on success, false if address already used
     */
    public function addCC($address, $name = '')
    {
        return $this->addAnAddress('cc', $address, $name);
    }

    /**
     * Add a "BCC" address.
     * @note: This function works with the SMTP mailer on win32, not with the "mail" mailer.
     * @param string $address
     * @param string $name
     * @return boolean true on success, false if address already used
     */
    public function addBCC($address, $name = '')
    {
        return $this->addAnAddress('bcc', $address, $name);
    }

    /**
     * Add a "Reply-to" address.
     * @param string $address
     * @param string $name
     * @return boolean
     */
    public function addReplyTo($address, $name = '')
    {
        return $this->addAnAddress('Reply-To', $address, $name);
    }

    /**
     * Add an address to one of the recipient arrays.
     * Addresses that have been added already return false, but do not throw exceptions
     * @param string $kind One of 'to', 'cc', 'bcc', 'ReplyTo'
     * @param string $address The email address to send to
     * @param string $name
     * @throws phpmailerException
     * @return boolean true on success, false if address already used or invalid in some way
     * @access protected
     */
    protected function addAnAddress($kind, $address, $name = '')
    {
        if (!preg_match('/^(to|cc|bcc|Reply-To)$/', $kind)) {
            $this->setError($this->lang('Invalid recipient array') . ': ' . $kind);
            $this->edebug($this->lang('Invalid recipient array') . ': ' . $kind);
            if ($this->exceptions) {
                throw new phpmailerException('Invalid recipient array: ' . $kind);
            }
            return false;
        }
        $address = trim($address);
        $name = trim(preg_replace('/[\r\n]+/', '', $name)); //Strip breaks and trim
        if (!$this->validateAddress($address)) {
            $this->setError($this->lang('invalid_address') . ': ' . $address);
            $this->edebug($this->lang('invalid_address') . ': ' . $address);
            if ($this->exceptions) {
                throw new phpmailerException($this->lang('invalid_address') . ': ' . $address);
            }
            return false;
        }
        if ($kind != 'Reply-To') {
            if (!isset($this->all_recipients[strtolower($address)])) {
                array_push($this->$kind, array($address, $name));
                $this->all_recipients[strtolower($address)] = true;
                return true;
            }
        } else {
            if (!array_key_exists(strtolower($address), $this->ReplyTo)) {
                $this->ReplyTo[strtolower($address)] = array($address, $name);
                return true;
            }
        }
        return false;
    }

    /**
     * Set the From and FromName properties.
     * @param string $address
     * @param string $name
     * @param boolean $auto Whether to also set the Sender address, defaults to true
     * @throws phpmailerException
     * @return boolean
     */
    public function setFrom($address, $name = '', $auto = true)
    {
        $address = trim($address);
        $name = trim(preg_replace('/[\r\n]+/', '', $name)); //Strip breaks and trim
        if (!$this->validateAddress($address)) {
            $this->setError($this->lang('invalid_address') . ': ' . $address);
            $this->edebug($this->lang('invalid_address') . ': ' . $address);
            if ($this->exceptions) {
                throw new phpmailerException($this->lang('invalid_address') . ': ' . $address);
            }
            return false;
        }
        $this->From = $address;
        $this->FromName = $name;
        if ($auto) {
            if (empty($this->Sender)) {
                $this->Sender = $address;
            }
        }
        return true;
    }

    /**
     * Return the Message-ID header of the last email.
     * Technically this is the value from the last time the headers were created,
     * but it's also the message ID of the last sent message except in
     * pathological cases.
     * @return string
     */
    public function getLastMessageID()
    {
        return $this->lastMessageID;
    }

    /**
     * Check that a string looks like an email address.
     * @param string $address The email address to check
     * @param string $patternselect A selector for the validation pattern to use :
     * * `auto` Pick strictest one automatically;
     * * `pcre8` Use the squiloople.com pattern, requires PCRE > 8.0, PHP >= 5.3.2, 5.2.14;
     * * `pcre` Use old PCRE implementation;
     * * `php` Use PHP built-in FILTER_VALIDATE_EMAIL; same as pcre8 but does not allow 'dotless' domains;
     * * `html5` Use the pattern given by the HTML5 spec for 'email' type form input elements.
     * * `noregex` Don't use a regex: super fast, really dumb.
     * @return boolean
     * @static
     * @access public
     */
    public static function validateAddress($address, $patternselect = 'auto')
    {
        if (!$patternselect or $patternselect == 'auto') {
            //Check this constant first so it works when extension_loaded() is disabled by safe mode
            //Constant was added in PHP 5.2.4
            if (defined('PCRE_VERSION')) {
                //This pattern can get stuck in a recursive loop in PCRE <= 8.0.2
                if (version_compare(PCRE_VERSION, '8.0.3') >= 0) {
                    $patternselect = 'pcre8';
                } else {
                    $patternselect = 'pcre';
                }
            } elseif (function_exists('extension_loaded') and extension_loaded('pcre')) {
                //Fall back to older PCRE
                $patternselect = 'pcre';
            } else {
                //Filter_var appeared in PHP 5.2.0 and does not require the PCRE extension
                if (version_compare(PHP_VERSION, '5.2.0') >= 0) {
                    $patternselect = 'php';
                } else {
                    $patternselect = 'noregex';
                }
            }
        }
        switch ($patternselect) {
            case 'pcre8':
                /**
                 * Uses the same RFC5322 regex on which FILTER_VALIDATE_EMAIL is based, but allows dotless domains.
                 * @link http://squiloople.com/2009/12/20/email-address-validation/
                 * @copyright 2009-2010 Michael Rushton
                 * Feel free to use and redistribute this code. But please keep this copyright notice.
                 */
                return (boolean)preg_match(
                    '/^(?!(?>(?1)"?(?>\\\[ -~]|[^"])"?(?1)){255,})(?!(?>(?1)"?(?>\\\[ -~]|[^"])"?(?1)){65,}@)' .
                    '((?>(?>(?>((?>(?>(?>\x0D\x0A)?[\t ])+|(?>[\t ]*\x0D\x0A)?[\t ]+)?)(\((?>(?2)' .
                    '(?>[\x01-\x08\x0B\x0C\x0E-\'*-\[\]-\x7F]|\\\[\x00-\x7F]|(?3)))*(?2)\)))+(?2))|(?2))?)' .
                    '([!#-\'*+\/-9=?^-~-]+|"(?>(?2)(?>[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\x7F]))*' .
                    '(?2)")(?>(?1)\.(?1)(?4))*(?1)@(?!(?1)[a-z0-9-]{64,})(?1)(?>([a-z0-9](?>[a-z0-9-]*[a-z0-9])?)' .
                    '(?>(?1)\.(?!(?1)[a-z0-9-]{64,})(?1)(?5)){0,126}|\[(?:(?>IPv6:(?>([a-f0-9]{1,4})(?>:(?6)){7}' .
                    '|(?!(?:.*[a-f0-9][:\]]){8,})((?6)(?>:(?6)){0,6})?::(?7)?))|(?>(?>IPv6:(?>(?6)(?>:(?6)){5}:' .
                    '|(?!(?:.*[a-f0-9]:){6,})(?8)?::(?>((?6)(?>:(?6)){0,4}):)?))?(25[0-5]|2[0-4][0-9]|1[0-9]{2}' .
                    '|[1-9]?[0-9])(?>\.(?9)){3}))\])(?1)$/isD',
                    $address
                );
            case 'pcre':
                //An older regex that doesn't need a recent PCRE
                return (boolean)preg_match(
                    '/^(?!(?>"?(?>\\\[ -~]|[^"])"?){255,})(?!(?>"?(?>\\\[ -~]|[^"])"?){65,}@)(?>' .
                    '[!#-\'*+\/-9=?^-~-]+|"(?>(?>[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\xFF]))*")' .
                    '(?>\.(?>[!#-\'*+\/-9=?^-~-]+|"(?>(?>[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\xFF]))*"))*' .
                    '@(?>(?![a-z0-9-]{64,})(?>[a-z0-9](?>[a-z0-9-]*[a-z0-9])?)(?>\.(?![a-z0-9-]{64,})' .
                    '(?>[a-z0-9](?>[a-z0-9-]*[a-z0-9])?)){0,126}|\[(?:(?>IPv6:(?>(?>[a-f0-9]{1,4})(?>:' .
                    '[a-f0-9]{1,4}){7}|(?!(?:.*[a-f0-9][:\]]){8,})(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,6})?' .
                    '::(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,6})?))|(?>(?>IPv6:(?>[a-f0-9]{1,4}(?>:' .
                    '[a-f0-9]{1,4}){5}:|(?!(?:.*[a-f0-9]:){6,})(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,4})?' .
                    '::(?>(?:[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,4}):)?))?(?>25[0-5]|2[0-4][0-9]|1[0-9]{2}' .
                    '|[1-9]?[0-9])(?>\.(?>25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}))\])$/isD',
                    $address
                );
            case 'html5':
                /**
                 * This is the pattern used in the HTML5 spec for validation of 'email' type form input elements.
                 * @link http://www.whatwg.org/specs/web-apps/current-work/#e-mail-state-(type=email)
                 */
                return (boolean)preg_match(
                    '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}' .
                    '[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/sD',
                    $address
                );
            case 'noregex':
                //No PCRE! Do something _very_ approximate!
                //Check the address is 3 chars or longer and contains an @ that's not the first or last char
                return (strlen($address) >= 3
                    and strpos($address, '@') >= 1
                    and strpos($address, '@') != strlen($address) - 1);
            case 'php':
            default:
                return (boolean)filter_var($address, FILTER_VALIDATE_EMAIL);
        }
    }

    /**
     * Create a message and send it.
     * Uses the sending method specified by $Mailer.
     * @throws phpmailerException
     * @return boolean false on error - See the ErrorInfo property for details of the error.
     */
    public function send()
    {
        try {
            if (!$this->preSend()) {
                return false;
            }
            return $this->postSend();
        } catch (phpmailerException $exc) {
            $this->mailHeader = '';
            $this->setError($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
            }
            return false;
        }
    }

    /**
     * Prepare a message for sending.
     * @throws phpmailerException
     * @return boolean
     */
    public function preSend()
    {
        try {
            $this->mailHeader = '';
            if ((count($this->to) + count($this->cc) + count($this->bcc)) < 1) {
                throw new phpmailerException($this->lang('provide_address'), self::STOP_CRITICAL);
            }

            // Set whether the message is multipart/alternative
            if (!empty($this->AltBody)) {
                $this->ContentType = 'multipart/alternative';
            }

            $this->error_count = 0; // Reset errors
            $this->setMessageType();
            // Refuse to send an empty message unless we are specifically allowing it
            if (!$this->AllowEmpty and empty($this->Body)) {
                throw new phpmailerException($this->lang('empty_message'), self::STOP_CRITICAL);
            }

            // Create body before headers in case body makes changes to headers (e.g. altering transfer encoding)
            $this->MIMEHeader = '';
            $this->MIMEBody = $this->createBody();
            // createBody may have added some headers, so retain them
            $tempheaders = $this->MIMEHeader;
            $this->MIMEHeader = $this->createHeader();
            $this->MIMEHeader .= $tempheaders;

            // To capture the complete message when using mail(), create
            // an extra header list which createHeader() doesn't fold in
            if ($this->Mailer == 'mail') {
                if (count($this->to) > 0) {
                    $this->mailHeader .= $this->addrAppend('To', $this->to);
                } else {
                    $this->mailHeader .= $this->headerLine('To', 'undisclosed-recipients:;');
                }
                $this->mailHeader .= $this->headerLine(
                    'Subject',
                    $this->encodeHeader($this->secureHeader(trim($this->Subject)))
                );
            }

            // Sign with DKIM if enabled
            if (!empty($this->DKIM_domain)
                && !empty($this->DKIM_private)
                && !empty($this->DKIM_selector)
                && file_exists($this->DKIM_private)) {
                $header_dkim = $this->DKIM_Add(
                    $this->MIMEHeader . $this->mailHeader,
                    $this->encodeHeader($this->secureHeader($this->Subject)),
                    $this->MIMEBody
                );
                $this->MIMEHeader = rtrim($this->MIMEHeader, "\r\n ") . self::CRLF .
                    str_replace("\r\n", "\n", $header_dkim) . self::CRLF;
            }
            return true;
        } catch (phpmailerException $exc) {
            $this->setError($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
            }
            return false;
        }
    }

    /**
     * Actually send a message.
     * Send the email via the selected mechanism
     * @throws phpmailerException
     * @return boolean
     */
    public function postSend()
    {
        try {
            // Choose the mailer and send through it
            switch ($this->Mailer) {
                case 'sendmail':
                case 'qmail':
                    return $this->sendmailSend($this->MIMEHeader, $this->MIMEBody);
                case 'smtp':
                    return $this->smtpSend($this->MIMEHeader, $this->MIMEBody);
                case 'mail':
                    return $this->mailSend($this->MIMEHeader, $this->MIMEBody);
                default:
                    $sendMethod = $this->Mailer.'Send';
                    if (method_exists($this, $sendMethod)) {
                        return $this->$sendMethod($this->MIMEHeader, $this->MIMEBody);
                    }

                    return $this->mailSend($this->MIMEHeader, $this->MIMEBody);
            }
        } catch (phpmailerException $exc) {
            $this->setError($exc->getMessage());
            $this->edebug($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
            }
        }
        return false;
    }

    /**
     * Send mail using the $Sendmail program.
     * @param string $header The message headers
     * @param string $body The message body
     * @see PHPMailer::$Sendmail
     * @throws phpmailerException
     * @access protected
     * @return boolean
     */
    protected function sendmailSend($header, $body)
    {
        if ($this->Sender != '') {
            if ($this->Mailer == 'qmail') {
                $sendmail = sprintf('%s -f%s', escapeshellcmd($this->Sendmail), escapeshellarg($this->Sender));
            } else {
                $sendmail = sprintf('%s -oi -f%s -t', escapeshellcmd($this->Sendmail), escapeshellarg($this->Sender));
            }
        } else {
            if ($this->Mailer == 'qmail') {
                $sendmail = sprintf('%s', escapeshellcmd($this->Sendmail));
            } else {
                $sendmail = sprintf('%s -oi -t', escapeshellcmd($this->Sendmail));
            }
        }
        if ($this->SingleTo) {
            foreach ($this->SingleToArray as $toAddr) {
                if (!@$mail = popen($sendmail, 'w')) {
                    throw new phpmailerException($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
                }
                fputs($mail, 'To: ' . $toAddr . "\n");
                fputs($mail, $header);
                fputs($mail, $body);
                $result = pclose($mail);
                $this->doCallback(
                    ($result == 0),
                    array($toAddr),
                    $this->cc,
                    $this->bcc,
                    $this->Subject,
                    $body,
                    $this->From
                );
                if ($result != 0) {
                    throw new phpmailerException($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
                }
            }
        } else {
            if (!@$mail = popen($sendmail, 'w')) {
                throw new phpmailerException($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
            }
            fputs($mail, $header);
            fputs($mail, $body);
            $result = pclose($mail);
            $this->doCallback(($result == 0), $this->to, $this->cc, $this->bcc, $this->Subject, $body, $this->From);
            if ($result != 0) {
                throw new phpmailerException($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
            }
        }
        return true;
    }

    /**
     * Send mail using the PHP mail() function.
     * @param string $header The message headers
     * @param string $body The message body
     * @link http://www.php.net/manual/en/book.mail.php
     * @throws phpmailerException
     * @access protected
     * @return boolean
     */
    protected function mailSend($header, $body)
    {
        $toArr = array();
        foreach ($this->to as $toaddr) {
            $toArr[] = $this->addrFormat($toaddr);
        }
        $to = implode(', ', $toArr);

        if (empty($this->Sender)) {
            $params = ' ';
        } else {
            $params = sprintf('-f%s', $this->Sender);
        }
        if ($this->Sender != '' and !ini_get('safe_mode')) {
            $old_from = ini_get('sendmail_from');
            ini_set('sendmail_from', $this->Sender);
        }
        $result = false;
        if ($this->SingleTo && count($toArr) > 1) {
            foreach ($toArr as $toAddr) {
                $result = $this->mailPassthru($toAddr, $this->Subject, $body, $header, $params);
                $this->doCallback($result, array($toAddr), $this->cc, $this->bcc, $this->Subject, $body, $this->From);
            }
        } else {
            $result = $this->mailPassthru($to, $this->Subject, $body, $header, $params);
            $this->doCallback($result, $this->to, $this->cc, $this->bcc, $this->Subject, $body, $this->From);
        }
        if (isset($old_from)) {
            ini_set('sendmail_from', $old_from);
        }
        if (!$result) {
            throw new phpmailerException($this->lang('instantiate'), self::STOP_CRITICAL);
        }
        return true;
    }

    /**
     * Get an instance to use for SMTP operations.
     * Override this function to load your own SMTP implementation
     * @return SMTP
     */
    public function getSMTPInstance()
    {
        if (!is_object($this->smtp)) {
            $this->smtp = new SMTP;
        }
        return $this->smtp;
    }

    /**
     * Send mail via SMTP.
     * Returns false if there is a bad MAIL FROM, RCPT, or DATA input.
     * Uses the PHPMailerSMTP class by default.
     * @see PHPMailer::getSMTPInstance() to use a different class.
     * @param string $header The message headers
     * @param string $body The message body
     * @throws phpmailerException
     * @uses SMTP
     * @access protected
     * @return boolean
     */
    protected function smtpSend($header, $body)
    {
        $bad_rcpt = array();
        if (!$this->smtpConnect($this->SMTPOptions)) {
            throw new phpmailerException($this->lang('smtp_connect_failed'), self::STOP_CRITICAL);
        }
        if ('' == $this->Sender) {
            $smtp_from = $this->From;
        } else {
            $smtp_from = $this->Sender;
        }
        if (!$this->smtp->mail($smtp_from)) {
            $this->setError($this->lang('from_failed') . $smtp_from . ' : ' . implode(',', $this->smtp->getError()));
            throw new phpmailerException($this->ErrorInfo, self::STOP_CRITICAL);
        }

        // Attempt to send to all recipients
        foreach (array($this->to, $this->cc, $this->bcc) as $togroup) {
            foreach ($togroup as $to) {
                if (!$this->smtp->recipient($to[0])) {
                    $error = $this->smtp->getError();
                    $bad_rcpt[] = array('to' => $to[0], 'error' => $error['detail']);
                    $isSent = false;
                } else {
                    $isSent = true;
                }
                $this->doCallback($isSent, array($to[0]), array(), array(), $this->Subject, $body, $this->From);
            }
        }

        // Only send the DATA command if we have viable recipients
        if ((count($this->all_recipients) > count($bad_rcpt)) and !$this->smtp->data($header . $body)) {
            throw new phpmailerException($this->lang('data_not_accepted'), self::STOP_CRITICAL);
        }
        if ($this->SMTPKeepAlive) {
            $this->smtp->reset();
        } else {
            $this->smtp->quit();
            $this->smtp->close();
        }
        //Create error message for any bad addresses
        if (count($bad_rcpt) > 0) {
            $errstr = '';
            foreach ($bad_rcpt as $bad) {
                $errstr .= $bad['to'] . ': ' . $bad['error'];
            }
            throw new phpmailerException(
                $this->lang('recipients_failed') . $errstr,
                self::STOP_CONTINUE
            );
        }
        return true;
    }

    /**
     * Initiate a connection to an SMTP server.
     * Returns false if the operation failed.
     * @param array $options An array of options compatible with stream_context_create()
     * @uses SMTP
     * @access public
     * @throws phpmailerException
     * @return boolean
     */
    public function smtpConnect($options = array())
    {
        if (is_null($this->smtp)) {
            $this->smtp = $this->getSMTPInstance();
        }

        // Already connected?
        if ($this->smtp->connected()) {
            return true;
        }

        $this->smtp->setTimeout($this->Timeout);
        $this->smtp->setDebugLevel($this->SMTPDebug);
        $this->smtp->setDebugOutput($this->Debugoutput);
        $this->smtp->setVerp($this->do_verp);
        $hosts = explode(';', $this->Host);
        $lastexception = null;

        foreach ($hosts as $hostentry) {
            $hostinfo = array();
            if (!preg_match('/^((ssl|tls):\/\/)*([a-zA-Z0-9\.-]*):?([0-9]*)$/', trim($hostentry), $hostinfo)) {
                // Not a valid host entry
                continue;
            }
            // $hostinfo[2]: optional ssl or tls prefix
            // $hostinfo[3]: the hostname
            // $hostinfo[4]: optional port number
            // The host string prefix can temporarily override the current setting for SMTPSecure
            // If it's not specified, the default value is used
            $prefix = '';
            $secure = $this->SMTPSecure;
            $tls = ($this->SMTPSecure == 'tls');
            if ('ssl' == $hostinfo[2] or ('' == $hostinfo[2] and 'ssl' == $this->SMTPSecure)) {
                $prefix = 'ssl://';
                $tls = false; // Can't have SSL and TLS at the same time
                $secure = 'ssl';
            } elseif ($hostinfo[2] == 'tls') {
                $tls = true;
                // tls doesn't use a prefix
                $secure = 'tls';
            }
            //Do we need the OpenSSL extension?
            $sslext = defined('OPENSSL_ALGO_SHA1');
            if ('tls' === $secure or 'ssl' === $secure) {
                //Check for an OpenSSL constant rather than using extension_loaded, which is sometimes disabled
                if (!$sslext) {
                    throw new phpmailerException($this->lang('extension_missing').'openssl', self::STOP_CRITICAL);
                }
            }
            $host = $hostinfo[3];
            $port = $this->Port;
            $tport = (integer)$hostinfo[4];
            if ($tport > 0 and $tport < 65536) {
                $port = $tport;
            }
            if ($this->smtp->connect($prefix . $host, $port, $this->Timeout, $options)) {
                try {
                    if ($this->Helo) {
                        $hello = $this->Helo;
                    } else {
                        $hello = $this->serverHostname();
                    }
                    $this->smtp->hello($hello);
                    //Automatically enable TLS encryption if:
                    // * it's not disabled
                    // * we have openssl extension
                    // * we are not already using SSL
                    // * the server offers STARTTLS
                    if ($this->SMTPAutoTLS and $sslext and $secure != 'ssl' and $this->smtp->getServerExt('STARTTLS')) {
                        $tls = true;
                    }
                    if ($tls) {
                        if (!$this->smtp->startTLS()) {
                            throw new phpmailerException($this->lang('connect_host'));
                        }
                        // We must resend HELO after tls negotiation
                        $this->smtp->hello($hello);
                    }
                    if ($this->SMTPAuth) {
                        if (!$this->smtp->authenticate(
                            $this->Username,
                            $this->Password,
                            $this->AuthType,
                            $this->Realm,
                            $this->Workstation
                        )
                        ) {
                            throw new phpmailerException($this->lang('authenticate'));
                        }
                    }
                    return true;
                } catch (phpmailerException $exc) {
                    $lastexception = $exc;
                    $this->edebug($exc->getMessage());
                    // We must have connected, but then failed TLS or Auth, so close connection nicely
                    $this->smtp->quit();
                }
            }
        }
        // If we get here, all connection attempts have failed, so close connection hard
        $this->smtp->close();
        // As we've caught all exceptions, just report whatever the last one was
        if ($this->exceptions and !is_null($lastexception)) {
            throw $lastexception;
        }
        return false;
    }

    /**
     * Close the active SMTP session if one exists.
     * @return void
     */
    public function smtpClose()
    {
        if ($this->smtp !== null) {
            if ($this->smtp->connected()) {
                $this->smtp->quit();
                $this->smtp->close();
            }
        }
    }

    /**
     * Set the language for error messages.
     * Returns false if it cannot load the language file.
     * The default language is English.
     * @param string $langcode ISO 639-1 2-character language code (e.g. French is "fr")
     * @param string $lang_path Path to the language file directory, with trailing separator (slash)
     * @return boolean
     * @access public
     */
    public function setLanguage($langcode = 'en', $lang_path = '')
    {
        // Define full set of translatable strings in English
        $PHPMAILER_LANG = array(
            'authenticate' => 'SMTP Error: Could not authenticate.',
            'connect_host' => 'SMTP Error: Could not connect to SMTP host.',
            'data_not_accepted' => 'SMTP Error: data not accepted.',
            'empty_message' => 'Message body empty',
            'encoding' => 'Unknown encoding: ',
            'execute' => 'Could not execute: ',
            'file_access' => 'Could not access file: ',
            'file_open' => 'File Error: Could not open file: ',
            'from_failed' => 'The following From address failed: ',
            'instantiate' => 'Could not instantiate mail function.',
            'invalid_address' => 'Invalid address',
            'mailer_not_supported' => ' mailer is not supported.',
            'provide_address' => 'You must provide at least one recipient email address.',
            'recipients_failed' => 'SMTP Error: The following recipients failed: ',
            'signing' => 'Signing Error: ',
            'smtp_connect_failed' => 'SMTP connect() failed.',
            'smtp_error' => 'SMTP server error: ',
            'variable_set' => 'Cannot set or reset variable: ',
            'extension_missing' => 'Extension missing: '
        );
        if (empty($lang_path)) {
            // Calculate an absolute path so it can work if CWD is not here
            $lang_path = dirname(__FILE__). DIRECTORY_SEPARATOR . 'language'. DIRECTORY_SEPARATOR;
        }
        $foundlang = true;
        $lang_file = $lang_path . 'phpmailer.lang-' . $langcode . '.php';
        // There is no English translation file
        if ($langcode != 'en') {
            // Make sure language file path is readable
            if (!is_readable($lang_file)) {
                $foundlang = false;
            } else {
                // Overwrite language-specific strings.
                // This way we'll never have missing translation keys.
                $foundlang = include $lang_file;
            }
        }
        $this->language = $PHPMAILER_LANG;
        return (boolean)$foundlang; // Returns false if language not found
    }

    /**
     * Get the array of strings for the current language.
     * @return array
     */
    public function getTranslations()
    {
        return $this->language;
    }

    /**
     * Create recipient headers.
     * @access public
     * @param string $type
     * @param array $addr An array of recipient,
     * where each recipient is a 2-element indexed array with element 0 containing an address
     * and element 1 containing a name, like:
     * array(array('joe@example.com', 'Joe User'), array('zoe@example.com', 'Zoe User'))
     * @return string
     */
    public function addrAppend($type, $addr)
    {
        $addresses = array();
        foreach ($addr as $address) {
            $addresses[] = $this->addrFormat($address);
        }
        return $type . ': ' . implode(', ', $addresses) . $this->LE;
    }

    /**
     * Format an address for use in a message header.
     * @access public
     * @param array $addr A 2-element indexed array, element 0 containing an address, element 1 containing a name
     *      like array('joe@example.com', 'Joe User')
     * @return string
     */
    public function addrFormat($addr)
    {
        if (empty($addr[1])) { // No name provided
            return $this->secureHeader($addr[0]);
        } else {
            return $this->encodeHeader($this->secureHeader($addr[1]), 'phrase') . ' <' . $this->secureHeader(
                $addr[0]
            ) . '>';
        }
    }

    /**
     * Word-wrap message.
     * For use with mailers that do not automatically perform wrapping
     * and for quoted-printable encoded messages.
     * Original written by philippe.
     * @param string $message The message to wrap
     * @param integer $length The line length to wrap to
     * @param boolean $qp_mode Whether to run in Quoted-Printable mode
     * @access public
     * @return string
     */
    public function wrapText($message, $length, $qp_mode = false)
    {
        if ($qp_mode) {
            $soft_break = sprintf(' =%s', $this->LE);
        } else {
            $soft_break = $this->LE;
        }
        // If utf-8 encoding is used, we will need to make sure we don't
        // split multibyte characters when we wrap
        $is_utf8 = (strtolower($this->CharSet) == 'utf-8');
        $lelen = strlen($this->LE);
        $crlflen = strlen(self::CRLF);

        $message = $this->fixEOL($message);
        //Remove a trailing line break
        if (substr($message, -$lelen) == $this->LE) {
            $message = substr($message, 0, -$lelen);
        }

        //Split message into lines
        $lines = explode($this->LE, $message);
        //Message will be rebuilt in here
        $message = '';
        foreach ($lines as $line) {
            $words = explode(' ', $line);
            $buf = '';
            $firstword = true;
            foreach ($words as $word) {
                if ($qp_mode and (strlen($word) > $length)) {
                    $space_left = $length - strlen($buf) - $crlflen;
                    if (!$firstword) {
                        if ($space_left > 20) {
                            $len = $space_left;
                            if ($is_utf8) {
                                $len = $this->utf8CharBoundary($word, $len);
                            } elseif (substr($word, $len - 1, 1) == '=') {
                                $len--;
                            } elseif (substr($word, $len - 2, 1) == '=') {
                                $len -= 2;
                            }
                            $part = substr($word, 0, $len);
                            $word = substr($word, $len);
                            $buf .= ' ' . $part;
                            $message .= $buf . sprintf('=%s', self::CRLF);
                        } else {
                            $message .= $buf . $soft_break;
                        }
                        $buf = '';
                    }
                    while (strlen($word) > 0) {
                        if ($length <= 0) {
                            break;
                        }
                        $len = $length;
                        if ($is_utf8) {
                            $len = $this->utf8CharBoundary($word, $len);
                        } elseif (substr($word, $len - 1, 1) == '=') {
                            $len--;
                        } elseif (substr($word, $len - 2, 1) == '=') {
                            $len -= 2;
                        }
                        $part = substr($word, 0, $len);
                        $word = substr($word, $len);

                        if (strlen($word) > 0) {
                            $message .= $part . sprintf('=%s', self::CRLF);
                        } else {
                            $buf = $part;
                        }
                    }
                } else {
                    $buf_o = $buf;
                    if (!$firstword) {
                        $buf .= ' ';
                    }
                    $buf .= $word;

                    if (strlen($buf) > $length and $buf_o != '') {
                        $message .= $buf_o . $soft_break;
                        $buf = $word;
                    }
                }
                $firstword = false;
            }
            $message .= $buf . self::CRLF;
        }

        return $message;
    }

    /**
     * Find the last character boundary prior to $maxLength in a utf-8
     * quoted-printable encoded string.
     * Original written by Colin Brown.
     * @access public
     * @param string $encodedText utf-8 QP text
     * @param integer $maxLength Find the last character boundary prior to this length
     * @return integer
     */
    public function utf8CharBoundary($encodedText, $maxLength)
    {
        $foundSplitPos = false;
        $lookBack = 3;
        while (!$foundSplitPos) {
            $lastChunk = substr($encodedText, $maxLength - $lookBack, $lookBack);
            $encodedCharPos = strpos($lastChunk, '=');
            if (false !== $encodedCharPos) {
                // Found start of encoded character byte within $lookBack block.
                // Check the encoded byte value (the 2 chars after the '=')
                $hex = substr($encodedText, $maxLength - $lookBack + $encodedCharPos + 1, 2);
                $dec = hexdec($hex);
                if ($dec < 128) {
                    // Single byte character.
                    // If the encoded char was found at pos 0, it will fit
                    // otherwise reduce maxLength to start of the encoded char
                    if ($encodedCharPos > 0) {
                        $maxLength = $maxLength - ($lookBack - $encodedCharPos);
                    }
                    $foundSplitPos = true;
                } elseif ($dec >= 192) {
                    // First byte of a multi byte character
                    // Reduce maxLength to split at start of character
                    $maxLength = $maxLength - ($lookBack - $encodedCharPos);
                    $foundSplitPos = true;
                } elseif ($dec < 192) {
                    // Middle byte of a multi byte character, look further back
                    $lookBack += 3;
                }
            } else {
                // No encoded character found
                $foundSplitPos = true;
            }
        }
        return $maxLength;
    }

    /**
     * Apply word wrapping to the message body.
     * Wraps the message body to the number of chars set in the WordWrap property.
     * You should only do this to plain-text bodies as wrapping HTML tags may break them.
     * This is called automatically by createBody(), so you don't need to call it yourself.
     * @access public
     * @return void
     */
    public function setWordWrap()
    {
        if ($this->WordWrap < 1) {
            return;
        }

        switch ($this->message_type) {
            case 'alt':
            case 'alt_inline':
            case 'alt_attach':
            case 'alt_inline_attach':
                $this->AltBody = $this->wrapText($this->AltBody, $this->WordWrap);
                break;
            default:
                $this->Body = $this->wrapText($this->Body, $this->WordWrap);
                break;
        }
    }

    /**
     * Assemble message headers.
     * @access public
     * @return string The assembled headers
     */
    public function createHeader()
    {
        $result = '';

        if ($this->MessageDate == '') {
            $this->MessageDate = self::rfcDate();
        }
        $result .= $this->headerLine('Date', $this->MessageDate);


        // To be created automatically by mail()
        if ($this->SingleTo) {
            if ($this->Mailer != 'mail') {
                foreach ($this->to as $toaddr) {
                    $this->SingleToArray[] = $this->addrFormat($toaddr);
                }
            }
        } else {
            if (count($this->to) > 0) {
                if ($this->Mailer != 'mail') {
                    $result .= $this->addrAppend('To', $this->to);
                }
            } elseif (count($this->cc) == 0) {
                $result .= $this->headerLine('To', 'undisclosed-recipients:;');
            }
        }

        $result .= $this->addrAppend('From', array(array(trim($this->From), $this->FromName)));

        // sendmail and mail() extract Cc from the header before sending
        if (count($this->cc) > 0) {
            $result .= $this->addrAppend('Cc', $this->cc);
        }

        // sendmail and mail() extract Bcc from the header before sending
        if ((
                $this->Mailer == 'sendmail' or $this->Mailer == 'qmail' or $this->Mailer == 'mail'
            )
            and count($this->bcc) > 0
        ) {
            $result .= $this->addrAppend('Bcc', $this->bcc);
        }

        if (count($this->ReplyTo) > 0) {
            $result .= $this->addrAppend('Reply-To', $this->ReplyTo);
        }

        // mail() sets the subject itself
        if ($this->Mailer != 'mail') {
            $result .= $this->headerLine('Subject', $this->encodeHeader($this->secureHeader($this->Subject)));
        }

        if ($this->MessageID != '') {
            $this->lastMessageID = $this->MessageID;
        } else {
            $this->lastMessageID = sprintf('<%s@%s>', $this->uniqueid, $this->ServerHostname());
        }
        $result .= $this->headerLine('Message-ID', $this->lastMessageID);
        $result .= $this->headerLine('X-Priority', $this->Priority);
        if ($this->XMailer == '') {
            $result .= $this->headerLine(
                'X-Mailer',
                'PHPMailer ' . $this->Version . ' (https://github.com/PHPMailer/PHPMailer/)'
            );
        } else {
            $myXmailer = trim($this->XMailer);
            if ($myXmailer) {
                $result .= $this->headerLine('X-Mailer', $myXmailer);
            }
        }

        if ($this->ConfirmReadingTo != '') {
            $result .= $this->headerLine('Disposition-Notification-To', '<' . trim($this->ConfirmReadingTo) . '>');
        }

        // Add custom headers
        foreach ($this->CustomHeader as $header) {
            $result .= $this->headerLine(
                trim($header[0]),
                $this->encodeHeader(trim($header[1]))
            );
        }
        if (!$this->sign_key_file) {
            $result .= $this->headerLine('MIME-Version', '1.0');
            $result .= $this->getMailMIME();
        }

        return $result;
    }

    /**
     * Get the message MIME type headers.
     * @access public
     * @return string
     */
    public function getMailMIME()
    {
        $result = '';
        $ismultipart = true;
        switch ($this->message_type) {
            case 'inline':
                $result .= $this->headerLine('Content-Type', 'multipart/related;');
                $result .= $this->textLine("\tboundary=\"" . $this->boundary[1] . '"');
                break;
            case 'attach':
            case 'inline_attach':
            case 'alt_attach':
            case 'alt_inline_attach':
                $result .= $this->headerLine('Content-Type', 'multipart/mixed;');
                $result .= $this->textLine("\tboundary=\"" . $this->boundary[1] . '"');
                break;
            case 'alt':
            case 'alt_inline':
                $result .= $this->headerLine('Content-Type', 'multipart/alternative;');
                $result .= $this->textLine("\tboundary=\"" . $this->boundary[1] . '"');
                break;
            default:
                // Catches case 'plain': and case '':
                $result .= $this->textLine('Content-Type: ' . $this->ContentType . '; charset=' . $this->CharSet);
                $ismultipart = false;
                break;
        }
        // RFC1341 part 5 says 7bit is assumed if not specified
        if ($this->Encoding != '7bit') {
            // RFC 2045 section 6.4 says multipart MIME parts may only use 7bit, 8bit or binary CTE
            if ($ismultipart) {
                if ($this->Encoding == '8bit') {
                    $result .= $this->headerLine('Content-Transfer-Encoding', '8bit');
                }
                // The only remaining alternatives are quoted-printable and base64, which are both 7bit compatible
            } else {
                $result .= $this->headerLine('Content-Transfer-Encoding', $this->Encoding);
            }
        }

        if ($this->Mailer != 'mail') {
            $result .= $this->LE;
        }

        return $result;
    }

    /**
     * Returns the whole MIME message.
     * Includes complete headers and body.
     * Only valid post preSend().
     * @see PHPMailer::preSend()
     * @access public
     * @return string
     */
    public function getSentMIMEMessage()
    {
        return $this->MIMEHeader . $this->mailHeader . self::CRLF . $this->MIMEBody;
    }

    /**
     * Assemble the message body.
     * Returns an empty string on failure.
     * @access public
     * @throws phpmailerException
     * @return string The assembled message body
     */
    public function createBody()
    {
        $body = '';
        //Create unique IDs and preset boundaries
        $this->uniqueid = md5(uniqid(time()));
        $this->boundary[1] = 'b1_' . $this->uniqueid;
        $this->boundary[2] = 'b2_' . $this->uniqueid;
        $this->boundary[3] = 'b3_' . $this->uniqueid;

        if ($this->sign_key_file) {
            $body .= $this->getMailMIME() . $this->LE;
        }

        $this->setWordWrap();

        $bodyEncoding = $this->Encoding;
        $bodyCharSet = $this->CharSet;
        //Can we do a 7-bit downgrade?
        if ($bodyEncoding == '8bit' and !$this->has8bitChars($this->Body)) {
            $bodyEncoding = '7bit';
            $bodyCharSet = 'us-ascii';
        }
        //If lines are too long, and we're not already using an encoding that will shorten them,
        //change to quoted-printable transfer encoding
        if ('base64' != $this->Encoding and self::hasLineLongerThanMax($this->Body)) {
            $this->Encoding = 'quoted-printable';
            $bodyEncoding = 'quoted-printable';
        }

        $altBodyEncoding = $this->Encoding;
        $altBodyCharSet = $this->CharSet;
        //Can we do a 7-bit downgrade?
        if ($altBodyEncoding == '8bit' and !$this->has8bitChars($this->AltBody)) {
            $altBodyEncoding = '7bit';
            $altBodyCharSet = 'us-ascii';
        }
        //If lines are too long, change to quoted-printable transfer encoding
        if (self::hasLineLongerThanMax($this->AltBody)) {
            $altBodyEncoding = 'quoted-printable';
        }
        //Use this as a preamble in all multipart message types
        $mimepre = "This is a multi-part message in MIME format." . $this->LE . $this->LE;
        switch ($this->message_type) {
            case 'inline':
                $body .= $mimepre;
                $body .= $this->getBoundary($this->boundary[1], $bodyCharSet, '', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[1]);
                break;
            case 'attach':
                $body .= $mimepre;
                $body .= $this->getBoundary($this->boundary[1], $bodyCharSet, '', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            case 'inline_attach':
                $body .= $mimepre;
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/related;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $bodyCharSet, '', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            case 'alt':
                $body .= $mimepre;
                $body .= $this->getBoundary($this->boundary[1], $altBodyCharSet, 'text/plain', $altBodyEncoding);
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->getBoundary($this->boundary[1], $bodyCharSet, 'text/html', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                if (!empty($this->Ical)) {
                    $body .= $this->getBoundary($this->boundary[1], '', 'text/calendar; method=REQUEST', '');
                    $body .= $this->encodeString($this->Ical, $this->Encoding);
                    $body .= $this->LE . $this->LE;
                }
                $body .= $this->endBoundary($this->boundary[1]);
                break;
            case 'alt_inline':
                $body .= $mimepre;
                $body .= $this->getBoundary($this->boundary[1], $altBodyCharSet, 'text/plain', $altBodyEncoding);
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/related;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $bodyCharSet, 'text/html', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->endBoundary($this->boundary[1]);
                break;
            case 'alt_attach':
                $body .= $mimepre;
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/alternative;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $altBodyCharSet, 'text/plain', $altBodyEncoding);
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $bodyCharSet, 'text/html', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->endBoundary($this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            case 'alt_inline_attach':
                $body .= $mimepre;
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/alternative;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $altBodyCharSet, 'text/plain', $altBodyEncoding);
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->textLine('--' . $this->boundary[2]);
                $body .= $this->headerLine('Content-Type', 'multipart/related;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[3] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[3], $bodyCharSet, 'text/html', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[3]);
                $body .= $this->LE;
                $body .= $this->endBoundary($this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            default:
                // catch case 'plain' and case ''
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                break;
        }

        if ($this->isError()) {
            $body = '';
        } elseif ($this->sign_key_file) {
            try {
                if (!defined('PKCS7_TEXT')) {
                    throw new phpmailerException($this->lang('extension_missing') . 'openssl');
                }
                // @TODO would be nice to use php://temp streams here, but need to wrap for PHP < 5.1
                $file = tempnam(sys_get_temp_dir(), 'mail');
                if (false === file_put_contents($file, $body)) {
                    throw new phpmailerException($this->lang('signing') . ' Could not write temp file');
                }
                $signed = tempnam(sys_get_temp_dir(), 'signed');
                //Workaround for PHP bug https://bugs.php.net/bug.php?id=69197
                if (empty($this->sign_extracerts_file)) {
                    $sign = @openssl_pkcs7_sign(
                        $file,
                        $signed,
                        'file://' . realpath($this->sign_cert_file),
                        array('file://' . realpath($this->sign_key_file), $this->sign_key_pass),
                        null
                    );
                } else {
                    $sign = @openssl_pkcs7_sign(
                        $file,
                        $signed,
                        'file://' . realpath($this->sign_cert_file),
                        array('file://' . realpath($this->sign_key_file), $this->sign_key_pass),
                        null,
                        PKCS7_DETACHED,
                        $this->sign_extracerts_file
                    );
                }
                if ($sign) {
                    @unlink($file);
                    $body = file_get_contents($signed);
                    @unlink($signed);
                    //The message returned by openssl contains both headers and body, so need to split them up
                    $parts = explode("\n\n", $body, 2);
                    $this->MIMEHeader .= $parts[0] . $this->LE . $this->LE;
                    $body = $parts[1];
                } else {
                    @unlink($file);
                    @unlink($signed);
                    throw new phpmailerException($this->lang('signing') . openssl_error_string());
                }
            } catch (phpmailerException $exc) {
                $body = '';
                if ($this->exceptions) {
                    throw $exc;
                }
            }
        }
        return $body;
    }

    /**
     * Return the start of a message boundary.
     * @access protected
     * @param string $boundary
     * @param string $charSet
     * @param string $contentType
     * @param string $encoding
     * @return string
     */
    protected function getBoundary($boundary, $charSet, $contentType, $encoding)
    {
        $result = '';
        if ($charSet == '') {
            $charSet = $this->CharSet;
        }
        if ($contentType == '') {
            $contentType = $this->ContentType;
        }
        if ($encoding == '') {
            $encoding = $this->Encoding;
        }
        $result .= $this->textLine('--' . $boundary);
        $result .= sprintf('Content-Type: %s; charset=%s', $contentType, $charSet);
        $result .= $this->LE;
        // RFC1341 part 5 says 7bit is assumed if not specified
        if ($encoding != '7bit') {
            $result .= $this->headerLine('Content-Transfer-Encoding', $encoding);
        }
        $result .= $this->LE;

        return $result;
    }

    /**
     * Return the end of a message boundary.
     * @access protected
     * @param string $boundary
     * @return string
     */
    protected function endBoundary($boundary)
    {
        return $this->LE . '--' . $boundary . '--' . $this->LE;
    }

    /**
     * Set the message type.
     * PHPMailer only supports some preset message types,
     * not arbitrary MIME structures.
     * @access protected
     * @return void
     */
    protected function setMessageType()
    {
        $type = array();
        if ($this->alternativeExists()) {
            $type[] = 'alt';
        }
        if ($this->inlineImageExists()) {
            $type[] = 'inline';
        }
        if ($this->attachmentExists()) {
            $type[] = 'attach';
        }
        $this->message_type = implode('_', $type);
        if ($this->message_type == '') {
            $this->message_type = 'plain';
        }
    }

    /**
     * Format a header line.
     * @access public
     * @param string $name
     * @param string $value
     * @return string
     */
    public function headerLine($name, $value)
    {
        return $name . ': ' . $value . $this->LE;
    }

    /**
     * Return a formatted mail line.
     * @access public
     * @param string $value
     * @return string
     */
    public function textLine($value)
    {
        return $value . $this->LE;
    }

    /**
     * Add an attachment from a path on the filesystem.
     * Returns false if the file could not be found or read.
     * @param string $path Path to the attachment.
     * @param string $name Overrides the attachment name.
     * @param string $encoding File encoding (see $Encoding).
     * @param string $type File extension (MIME) type.
     * @param string $disposition Disposition to use
     * @throws phpmailerException
     * @return boolean
     */
    public function addAttachment($path, $name = '', $encoding = 'base64', $type = '', $disposition = 'attachment')
    {
        try {
            if (!@is_file($path)) {
                throw new phpmailerException($this->lang('file_access') . $path, self::STOP_CONTINUE);
            }

            // If a MIME type is not specified, try to work it out from the file name
            if ($type == '') {
                $type = self::filenameToType($path);
            }

            $filename = basename($path);
            if ($name == '') {
                $name = $filename;
            }

            $this->attachment[] = array(
                0 => $path,
                1 => $filename,
                2 => $name,
                3 => $encoding,
                4 => $type,
                5 => false, // isStringAttachment
                6 => $disposition,
                7 => 0
            );

        } catch (phpmailerException $exc) {
            $this->setError($exc->getMessage());
            $this->edebug($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
            }
            return false;
        }
        return true;
    }

    /**
     * Return the array of attachments.
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachment;
    }

    /**
     * Attach all file, string, and binary attachments to the message.
     * Returns an empty string on failure.
     * @access protected
     * @param string $disposition_type
     * @param string $boundary
     * @return string
     */
    protected function attachAll($disposition_type, $boundary)
    {
        // Return text of body
        $mime = array();
        $cidUniq = array();
        $incl = array();

        // Add all attachments
        foreach ($this->attachment as $attachment) {
            // Check if it is a valid disposition_filter
            if ($attachment[6] == $disposition_type) {
                // Check for string attachment
                $string = '';
                $path = '';
                $bString = $attachment[5];
                if ($bString) {
                    $string = $attachment[0];
                } else {
                    $path = $attachment[0];
                }

                $inclhash = md5(serialize($attachment));
                if (in_array($inclhash, $incl)) {
                    continue;
                }
                $incl[] = $inclhash;
                $name = $attachment[2];
                $encoding = $attachment[3];
                $type = $attachment[4];
                $disposition = $attachment[6];
                $cid = $attachment[7];
                if ($disposition == 'inline' && isset($cidUniq[$cid])) {
                    continue;
                }
                $cidUniq[$cid] = true;

                $mime[] = sprintf('--%s%s', $boundary, $this->LE);
                $mime[] = sprintf(
                    'Content-Type: %s; name="%s"%s',
                    $type,
                    $this->encodeHeader($this->secureHeader($name)),
                    $this->LE
                );
                // RFC1341 part 5 says 7bit is assumed if not specified
                if ($encoding != '7bit') {
                    $mime[] = sprintf('Content-Transfer-Encoding: %s%s', $encoding, $this->LE);
                }

                if ($disposition == 'inline') {
                    $mime[] = sprintf('Content-ID: <%s>%s', $cid, $this->LE);
                }

                // If a filename contains any of these chars, it should be quoted,
                // but not otherwise: RFC2183 & RFC2045 5.1
                // Fixes a warning in IETF's msglint MIME checker
                // Allow for bypassing the Content-Disposition header totally
                if (!(empty($disposition))) {
                    $encoded_name = $this->encodeHeader($this->secureHeader($name));
                    if (preg_match('/[ \(\)<>@,;:\\"\/\[\]\?=]/', $encoded_name)) {
                        $mime[] = sprintf(
                            'Content-Disposition: %s; filename="%s"%s',
                            $disposition,
                            $encoded_name,
                            $this->LE . $this->LE
                        );
                    } else {
                        $mime[] = sprintf(
                            'Content-Disposition: %s; filename=%s%s',
                            $disposition,
                            $encoded_name,
                            $this->LE . $this->LE
                        );
                    }
                } else {
                    $mime[] = $this->LE;
                }

                // Encode as string attachment
                if ($bString) {
                    $mime[] = $this->encodeString($string, $encoding);
                    if ($this->isError()) {
                        return '';
                    }
                    $mime[] = $this->LE . $this->LE;
                } else {
                    $mime[] = $this->encodeFile($path, $encoding);
                    if ($this->isError()) {
                        return '';
                    }
                    $mime[] = $this->LE . $this->LE;
                }
            }
        }

        $mime[] = sprintf('--%s--%s', $boundary, $this->LE);

        return implode('', $mime);
    }

    /**
     * Encode a file attachment in requested format.
     * Returns an empty string on failure.
     * @param string $path The full path to the file
     * @param string $encoding The encoding to use; one of 'base64', '7bit', '8bit', 'binary', 'quoted-printable'
     * @throws phpmailerException
     * @see EncodeFile(encodeFile
     * @access protected
     * @return string
     */
    protected function encodeFile($path, $encoding = 'base64')
    {
        try {
            if (!is_readable($path)) {
                throw new phpmailerException($this->lang('file_open') . $path, self::STOP_CONTINUE);
            }
            $magic_quotes = get_magic_quotes_runtime();
            if ($magic_quotes) {
                if (version_compare(PHP_VERSION, '5.3.0', '<')) {
                    set_magic_quotes_runtime(false);
                } else {
                    //Doesn't exist in PHP 5.4, but we don't need to check because
                    //get_magic_quotes_runtime always returns false in 5.4+
                    //so it will never get here
                    ini_set('magic_quotes_runtime', false);
                }
            }
            $file_buffer = file_get_contents($path);
            $file_buffer = $this->encodeString($file_buffer, $encoding);
            if ($magic_quotes) {
                if (version_compare(PHP_VERSION, '5.3.0', '<')) {
                    set_magic_quotes_runtime($magic_quotes);
                } else {
                    ini_set('magic_quotes_runtime', $magic_quotes);
                }
            }
            return $file_buffer;
        } catch (Exception $exc) {
            $this->setError($exc->getMessage());
            return '';
        }
    }

    /**
     * Encode a string in requested format.
     * Returns an empty string on failure.
     * @param string $str The text to encode
     * @param string $encoding The encoding to use; one of 'base64', '7bit', '8bit', 'binary', 'quoted-printable'
     * @access public
     * @return string
     */
    public function encodeString($str, $encoding = 'base64')
    {
        $encoded = '';
        switch (strtolower($encoding)) {
            case 'base64':
                $encoded = chunk_split(base64_encode($str), 76, $this->LE);
                break;
            case '7bit':
            case '8bit':
                $encoded = $this->fixEOL($str);
                // Make sure it ends with a line break
                if (substr($encoded, -(strlen($this->LE))) != $this->LE) {
                    $encoded .= $this->LE;
                }
                break;
            case 'binary':
                $encoded = $str;
                break;
            case 'quoted-printable':
                $encoded = $this->encodeQP($str);
                break;
            default:
                $this->setError($this->lang('encoding') . $encoding);
                break;
        }
        return $encoded;
    }

    /**
     * Encode a header string optimally.
     * Picks shortest of Q, B, quoted-printable or none.
     * @access public
     * @param string $str
     * @param string $position
     * @return string
     */
    public function encodeHeader($str, $position = 'text')
    {
        $matchcount = 0;
        switch (strtolower($position)) {
            case 'phrase':
                if (!preg_match('/[\200-\377]/', $str)) {
                    // Can't use addslashes as we don't know the value of magic_quotes_sybase
                    $encoded = addcslashes($str, "\0..\37\177\\\"");
                    if (($str == $encoded) && !preg_match('/[^A-Za-z0-9!#$%&\'*+\/=?^_`{|}~ -]/', $str)) {
                        return ($encoded);
                    } else {
                        return ("\"$encoded\"");
                    }
                }
                $matchcount = preg_match_all('/[^\040\041\043-\133\135-\176]/', $str, $matches);
                break;
            /** @noinspection PhpMissingBreakStatementInspection */
            case 'comment':
                $matchcount = preg_match_all('/[()"]/', $str, $matches);
                // Intentional fall-through
            case 'text':
            default:
                $matchcount += preg_match_all('/[\000-\010\013\014\016-\037\177-\377]/', $str, $matches);
                break;
        }

        //There are no chars that need encoding
        if ($matchcount == 0) {
            return ($str);
        }

        $maxlen = 75 - 7 - strlen($this->CharSet);
        // Try to select the encoding which should produce the shortest output
        if ($matchcount > strlen($str) / 3) {
            // More than a third of the content will need encoding, so B encoding will be most efficient
            $encoding = 'B';
            if (function_exists('mb_strlen') && $this->hasMultiBytes($str)) {
                // Use a custom function which correctly encodes and wraps long
                // multibyte strings without breaking lines within a character
                $encoded = $this->base64EncodeWrapMB($str, "\n");
            } else {
                $encoded = base64_encode($str);
                $maxlen -= $maxlen % 4;
                $encoded = trim(chunk_split($encoded, $maxlen, "\n"));
            }
        } else {
            $encoding = 'Q';
            $encoded = $this->encodeQ($str, $position);
            $encoded = $this->wrapText($encoded, $maxlen, true);
            $encoded = str_replace('=' . self::CRLF, "\n", trim($encoded));
        }

        $encoded = preg_replace('/^(.*)$/m', ' =?' . $this->CharSet . "?$encoding?\\1?=", $encoded);
        $encoded = trim(str_replace("\n", $this->LE, $encoded));

        return $encoded;
    }

    /**
     * Check if a string contains multi-byte characters.
     * @access public
     * @param string $str multi-byte text to wrap encode
     * @return boolean
     */
    public function hasMultiBytes($str)
    {
        if (function_exists('mb_strlen')) {
            return (strlen($str) > mb_strlen($str, $this->CharSet));
        } else { // Assume no multibytes (we can't handle without mbstring functions anyway)
            return false;
        }
    }

    /**
     * Does a string contain any 8-bit chars (in any charset)?
     * @param string $text
     * @return boolean
     */
    public function has8bitChars($text)
    {
        return (boolean)preg_match('/[\x80-\xFF]/', $text);
    }

    /**
     * Encode and wrap long multibyte strings for mail headers
     * without breaking lines within a character.
     * Adapted from a function by paravoid
     * @link http://www.php.net/manual/en/function.mb-encode-mimeheader.php#60283
     * @access public
     * @param string $str multi-byte text to wrap encode
     * @param string $linebreak string to use as linefeed/end-of-line
     * @return string
     */
    public function base64EncodeWrapMB($str, $linebreak = null)
    {
        $start = '=?' . $this->CharSet . '?B?';
        $end = '?=';
        $encoded = '';
        if ($linebreak === null) {
            $linebreak = $this->LE;
        }

        $mb_length = mb_strlen($str, $this->CharSet);
        // Each line must have length <= 75, including $start and $end
        $length = 75 - strlen($start) - strlen($end);
        // Average multi-byte ratio
        $ratio = $mb_length / strlen($str);
        // Base64 has a 4:3 ratio
        $avgLength = floor($length * $ratio * .75);

        for ($i = 0; $i < $mb_length; $i += $offset) {
            $lookBack = 0;
            do {
                $offset = $avgLength - $lookBack;
                $chunk = mb_substr($str, $i, $offset, $this->CharSet);
                $chunk = base64_encode($chunk);
                $lookBack++;
            } while (strlen($chunk) > $length);
            $encoded .= $chunk . $linebreak;
        }

        // Chomp the last linefeed
        $encoded = substr($encoded, 0, -strlen($linebreak));
        return $encoded;
    }

    /**
     * Encode a string in quoted-printable format.
     * According to RFC2045 section 6.7.
     * @access public
     * @param string $string The text to encode
     * @param integer $line_max Number of chars allowed on a line before wrapping
     * @return string
     * @link http://www.php.net/manual/en/function.quoted-printable-decode.php#89417 Adapted from this comment
     */
    public function encodeQP($string, $line_max = 76)
    {
        // Use native function if it's available (>= PHP5.3)
        if (function_exists('quoted_printable_encode')) {
            return $this->fixEOL(quoted_printable_encode($string));
        }
        // Fall back to a pure PHP implementation
        $string = str_replace(
            array('%20', '%0D%0A.', '%0D%0A', '%'),
            array(' ', "\r\n=2E", "\r\n", '='),
            rawurlencode($string)
        );
        $string = preg_replace('/[^\r\n]{' . ($line_max - 3) . '}[^=\r\n]{2}/', "$0=\r\n", $string);
        return $this->fixEOL($string);
    }

    /**
     * Backward compatibility wrapper for an old QP encoding function that was removed.
     * @see PHPMailer::encodeQP()
     * @access public
     * @param string $string
     * @param integer $line_max
     * @param boolean $space_conv
     * @return string
     * @deprecated Use encodeQP instead.
     */
    public function encodeQPphp(
        $string,
        $line_max = 76,
        /** @noinspection PhpUnusedParameterInspection */ $space_conv = false
    ) {
        return $this->encodeQP($string, $line_max);
    }

    /**
     * Encode a string using Q encoding.
     * @link http://tools.ietf.org/html/rfc2047
     * @param string $str the text to encode
     * @param string $position Where the text is going to be used, see the RFC for what that means
     * @access public
     * @return string
     */
    public function encodeQ($str, $position = 'text')
    {
        // There should not be any EOL in the string
        $pattern = '';
        $encoded = str_replace(array("\r", "\n"), '', $str);
        switch (strtolower($position)) {
            case 'phrase':
                // RFC 2047 section 5.3
                $pattern = '^A-Za-z0-9!*+\/ -';
                break;
            /** @noinspection PhpMissingBreakStatementInspection */
            case 'comment':
                // RFC 2047 section 5.2
                $pattern = '\(\)"';
                // intentional fall-through
                // for this reason we build the $pattern without including delimiters and []
            case 'text':
            default:
                // RFC 2047 section 5.1
                // Replace every high ascii, control, =, ? and _ characters
                $pattern = '\000-\011\013\014\016-\037\075\077\137\177-\377' . $pattern;
                break;
        }
        $matches = array();
        if (preg_match_all("/[{$pattern}]/", $encoded, $matches)) {
            // If the string contains an '=', make sure it's the first thing we replace
            // so as to avoid double-encoding
            $eqkey = array_search('=', $matches[0]);
            if (false !== $eqkey) {
                unset($matches[0][$eqkey]);
                array_unshift($matches[0], '=');
            }
            foreach (array_unique($matches[0]) as $char) {
                $encoded = str_replace($char, '=' . sprintf('%02X', ord($char)), $encoded);
            }
        }
        // Replace every spaces to _ (more readable than =20)
        return str_replace(' ', '_', $encoded);
    }


    /**
     * Add a string or binary attachment (non-filesystem).
     * This method can be used to attach ascii or binary data,
     * such as a BLOB record from a database.
     * @param string $string String attachment data.
     * @param string $filename Name of the attachment.
     * @param string $encoding File encoding (see $Encoding).
     * @param string $type File extension (MIME) type.
     * @param string $disposition Disposition to use
     * @return void
     */
    public function addStringAttachment(
        $string,
        $filename,
        $encoding = 'base64',
        $type = '',
        $disposition = 'attachment'
    ) {
        // If a MIME type is not specified, try to work it out from the file name
        if ($type == '') {
            $type = self::filenameToType($filename);
        }
        // Append to $attachment array
        $this->attachment[] = array(
            0 => $string,
            1 => $filename,
            2 => basename($filename),
            3 => $encoding,
            4 => $type,
            5 => true, // isStringAttachment
            6 => $disposition,
            7 => 0
        );
    }

    /**
     * Add an embedded (inline) attachment from a file.
     * This can include images, sounds, and just about any other document type.
     * These differ from 'regular' attachments in that they are intended to be
     * displayed inline with the message, not just attached for download.
     * This is used in HTML messages that embed the images
     * the HTML refers to using the $cid value.
     * @param string $path Path to the attachment.
     * @param string $cid Content ID of the attachment; Use this to reference
     *        the content when using an embedded image in HTML.
     * @param string $name Overrides the attachment name.
     * @param string $encoding File encoding (see $Encoding).
     * @param string $type File MIME type.
     * @param string $disposition Disposition to use
     * @return boolean True on successfully adding an attachment
     */
    public function addEmbeddedImage($path, $cid, $name = '', $encoding = 'base64', $type = '', $disposition = 'inline')
    {
        if (!@is_file($path)) {
            $this->setError($this->lang('file_access') . $path);
            return false;
        }

        // If a MIME type is not specified, try to work it out from the file name
        if ($type == '') {
            $type = self::filenameToType($path);
        }

        $filename = basename($path);
        if ($name == '') {
            $name = $filename;
        }

        // Append to $attachment array
        $this->attachment[] = array(
            0 => $path,
            1 => $filename,
            2 => $name,
            3 => $encoding,
            4 => $type,
            5 => false, // isStringAttachment
            6 => $disposition,
            7 => $cid
        );
        return true;
    }

    /**
     * Add an embedded stringified attachment.
     * This can include images, sounds, and just about any other document type.
     * Be sure to set the $type to an image type for images:
     * JPEG images use 'image/jpeg', GIF uses 'image/gif', PNG uses 'image/png'.
     * @param string $string The attachment binary data.
     * @param string $cid Content ID of the attachment; Use this to reference
     *        the content when using an embedded image in HTML.
     * @param string $name
     * @param string $encoding File encoding (see $Encoding).
     * @param string $type MIME type.
     * @param string $disposition Disposition to use
     * @return boolean True on successfully adding an attachment
     */
    public function addStringEmbeddedImage(
        $string,
        $cid,
        $name = '',
        $encoding = 'base64',
        $type = '',
        $disposition = 'inline'
    ) {
        // If a MIME type is not specified, try to work it out from the name
        if ($type == '') {
            $type = self::filenameToType($name);
        }

        // Append to $attachment array
        $this->attachment[] = array(
            0 => $string,
            1 => $name,
            2 => $name,
            3 => $encoding,
            4 => $type,
            5 => true, // isStringAttachment
            6 => $disposition,
            7 => $cid
        );
        return true;
    }

    /**
     * Check if an inline attachment is present.
     * @access public
     * @return boolean
     */
    public function inlineImageExists()
    {
        foreach ($this->attachment as $attachment) {
            if ($attachment[6] == 'inline') {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if an attachment (non-inline) is present.
     * @return boolean
     */
    public function attachmentExists()
    {
        foreach ($this->attachment as $attachment) {
            if ($attachment[6] == 'attachment') {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if this message has an alternative body set.
     * @return boolean
     */
    public function alternativeExists()
    {
        return !empty($this->AltBody);
    }

    /**
     * Clear all To recipients.
     * @return void
     */
    public function clearAddresses()
    {
        foreach ($this->to as $to) {
            unset($this->all_recipients[strtolower($to[0])]);
        }
        $this->to = array();
    }

    /**
     * Clear all CC recipients.
     * @return void
     */
    public function clearCCs()
    {
        foreach ($this->cc as $cc) {
            unset($this->all_recipients[strtolower($cc[0])]);
        }
        $this->cc = array();
    }

    /**
     * Clear all BCC recipients.
     * @return void
     */
    public function clearBCCs()
    {
        foreach ($this->bcc as $bcc) {
            unset($this->all_recipients[strtolower($bcc[0])]);
        }
        $this->bcc = array();
    }

    /**
     * Clear all ReplyTo recipients.
     * @return void
     */
    public function clearReplyTos()
    {
        $this->ReplyTo = array();
    }

    /**
     * Clear all recipient types.
     * @return void
     */
    public function clearAllRecipients()
    {
        $this->to = array();
        $this->cc = array();
        $this->bcc = array();
        $this->all_recipients = array();
    }

    /**
     * Clear all filesystem, string, and binary attachments.
     * @return void
     */
    public function clearAttachments()
    {
        $this->attachment = array();
    }

    /**
     * Clear all custom headers.
     * @return void
     */
    public function clearCustomHeaders()
    {
        $this->CustomHeader = array();
    }

    /**
     * Add an error message to the error container.
     * @access protected
     * @param string $msg
     * @return void
     */
    protected function setError($msg)
    {
        $this->error_count++;
        if ($this->Mailer == 'smtp' and !is_null($this->smtp)) {
            $lasterror = $this->smtp->getError();
            if (!empty($lasterror['error'])) {
                $msg .= $this->lang('smtp_error') . $lasterror['error'];
                if (!empty($lasterror['detail'])) {
                    $msg .= ' Detail: '. $lasterror['detail'];
                }
                if (!empty($lasterror['smtp_code'])) {
                    $msg .= ' SMTP code: ' . $lasterror['smtp_code'];
                }
                if (!empty($lasterror['smtp_code_ex'])) {
                    $msg .= ' Additional SMTP info: ' . $lasterror['smtp_code_ex'];
                }
            }
        }
        $this->ErrorInfo = $msg;
    }

    /**
     * Return an RFC 822 formatted date.
     * @access public
     * @return string
     * @static
     */
    public static function rfcDate()
    {
        // Set the time zone to whatever the default is to avoid 500 errors
        // Will default to UTC if it's not set properly in php.ini
        date_default_timezone_set(@date_default_timezone_get());
        return date('D, j M Y H:i:s O');
    }

    /**
     * Get the server hostname.
     * Returns 'localhost.localdomain' if unknown.
     * @access protected
     * @return string
     */
    protected function serverHostname()
    {
        $result = 'localhost.localdomain';
        if (!empty($this->Hostname)) {
            $result = $this->Hostname;
        } elseif (isset($_SERVER) and array_key_exists('SERVER_NAME', $_SERVER) and !empty($_SERVER['SERVER_NAME'])) {
            $result = $_SERVER['SERVER_NAME'];
        } elseif (function_exists('gethostname') && gethostname() !== false) {
            $result = gethostname();
        } elseif (php_uname('n') !== false) {
            $result = php_uname('n');
        }
        return $result;
    }

    /**
     * Get an error message in the current language.
     * @access protected
     * @param string $key
     * @return string
     */
    protected function lang($key)
    {
        if (count($this->language) < 1) {
            $this->setLanguage('en'); // set the default language
        }

        if (array_key_exists($key, $this->language)) {
            if ($key == 'smtp_connect_failed') {
                //Include a link to troubleshooting docs on SMTP connection failure
                //this is by far the biggest cause of support questions
                //but it's usually not PHPMailer's fault.
                return $this->language[$key] . ' https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting';
            }
            return $this->language[$key];
        } else {
            //Return the key as a fallback
            return $key;
        }
    }

    /**
     * Check if an error occurred.
     * @access public
     * @return boolean True if an error did occur.
     */
    public function isError()
    {
        return ($this->error_count > 0);
    }

    /**
     * Ensure consistent line endings in a string.
     * Changes every end of line from CRLF, CR or LF to $this->LE.
     * @access public
     * @param string $str String to fixEOL
     * @return string
     */
    public function fixEOL($str)
    {
        // Normalise to \n
        $nstr = str_replace(array("\r\n", "\r"), "\n", $str);
        // Now convert LE as needed
        if ($this->LE !== "\n") {
            $nstr = str_replace("\n", $this->LE, $nstr);
        }
        return $nstr;
    }

    /**
     * Add a custom header.
     * $name value can be overloaded to contain
     * both header name and value (name:value)
     * @access public
     * @param string $name Custom header name
     * @param string $value Header value
     * @return void
     */
    public function addCustomHeader($name, $value = null)
    {
        if ($value === null) {
            // Value passed in as name:value
            $this->CustomHeader[] = explode(':', $name, 2);
        } else {
            $this->CustomHeader[] = array($name, $value);
        }
    }

    /**
     * Returns all custom headers
     *
     * @return array
     */
    public function getCustomHeaders()
    {
        return $this->CustomHeader;
    }

    /**
     * Create a message from an HTML string.
     * Automatically makes modifications for inline images and backgrounds
     * and creates a plain-text version by converting the HTML.
     * Overwrites any existing values in $this->Body and $this->AltBody
     * @access public
     * @param string $message HTML message string
     * @param string $basedir baseline directory for path
     * @param boolean|callable $advanced Whether to use the internal HTML to text converter
     *    or your own custom converter @see html2text()
     * @return string $message
     */
    public function msgHTML($message, $basedir = '', $advanced = false)
    {
        preg_match_all('/(src|background)=["\'](.*)["\']/Ui', $message, $images);
        if (isset($images[2])) {
            foreach ($images[2] as $imgindex => $url) {
                // Convert data URIs into embedded images
                if (preg_match('#^data:(image[^;,]*)(;base64)?,#', $url, $match)) {
                    $data = substr($url, strpos($url, ','));
                    if ($match[2]) {
                        $data = base64_decode($data);
                    } else {
                        $data = rawurldecode($data);
                    }
                    $cid = md5($url) . '@phpmailer.0'; // RFC2392 S 2
                    if ($this->addStringEmbeddedImage($data, $cid, '', 'base64', $match[1])) {
                        $message = str_replace(
                            $images[0][$imgindex],
                            $images[1][$imgindex] . '="cid:' . $cid . '"',
                            $message
                        );
                    }
                } elseif (!preg_match('#^[A-z]+://#', $url)) {
                    // Do not change urls for absolute images (thanks to corvuscorax)
                    $filename = basename($url);
                    $directory = dirname($url);
                    if ($directory == '.') {
                        $directory = '';
                    }
                    $cid = md5($url) . '@phpmailer.0'; // RFC2392 S 2
                    if (strlen($basedir) > 1 && substr($basedir, -1) != '/') {
                        $basedir .= '/';
                    }
                    if (strlen($directory) > 1 && substr($directory, -1) != '/') {
                        $directory .= '/';
                    }
                    if ($this->addEmbeddedImage(
                        $basedir . $directory . $filename,
                        $cid,
                        $filename,
                        'base64',
                        self::_mime_types((string)self::mb_pathinfo($filename, PATHINFO_EXTENSION))
                    )
                    ) {
                        $message = preg_replace(
                            '/' . $images[1][$imgindex] . '=["\']' . preg_quote($url, '/') . '["\']/Ui',
                            $images[1][$imgindex] . '="cid:' . $cid . '"',
                            $message
                        );
                    }
                }
            }
        }
        $this->isHTML(true);
        // Convert all message body line breaks to CRLF, makes quoted-printable encoding work much better
        $this->Body = $this->normalizeBreaks($message);
        $this->AltBody = $this->normalizeBreaks($this->html2text($message, $advanced));
        if (empty($this->AltBody)) {
            $this->AltBody = 'To view this email message, open it in a program that understands HTML!' .
                self::CRLF . self::CRLF;
        }
        return $this->Body;
    }

    /**
     * Convert an HTML string into plain text.
     * This is used by msgHTML().
     * Note - older versions of this function used a bundled advanced converter
     * which was been removed for license reasons in #232
     * Example usage:
     * <code>
     * // Use default conversion
     * $plain = $mail->html2text($html);
     * // Use your own custom converter
     * $plain = $mail->html2text($html, function($html) {
     *     $converter = new MyHtml2text($html);
     *     return $converter->get_text();
     * });
     * </code>
     * @param string $html The HTML text to convert
     * @param boolean|callable $advanced Any boolean value to use the internal converter,
     *   or provide your own callable for custom conversion.
     * @return string
     */
    public function html2text($html, $advanced = false)
    {
        if (is_callable($advanced)) {
            return call_user_func($advanced, $html);
        }
        return html_entity_decode(
            trim(strip_tags(preg_replace('/<(head|title|style|script)[^>]*>.*?<\/\\1>/si', '', $html))),
            ENT_QUOTES,
            $this->CharSet
        );
    }

    /**
     * Get the MIME type for a file extension.
     * @param string $ext File extension
     * @access public
     * @return string MIME type of file.
     * @static
     */
    public static function _mime_types($ext = '')
    {
        $mimes = array(
            'xl'    => 'application/excel',
            'js'    => 'application/javascript',
            'hqx'   => 'application/mac-binhex40',
            'cpt'   => 'application/mac-compactpro',
            'bin'   => 'application/macbinary',
            'doc'   => 'application/msword',
            'word'  => 'application/msword',
            'class' => 'application/octet-stream',
            'dll'   => 'application/octet-stream',
            'dms'   => 'application/octet-stream',
            'exe'   => 'application/octet-stream',
            'lha'   => 'application/octet-stream',
            'lzh'   => 'application/octet-stream',
            'psd'   => 'application/octet-stream',
            'sea'   => 'application/octet-stream',
            'so'    => 'application/octet-stream',
            'oda'   => 'application/oda',
            'pdf'   => 'application/pdf',
            'ai'    => 'application/postscript',
            'eps'   => 'application/postscript',
            'ps'    => 'application/postscript',
            'smi'   => 'application/smil',
            'smil'  => 'application/smil',
            'mif'   => 'application/vnd.mif',
            'xls'   => 'application/vnd.ms-excel',
            'ppt'   => 'application/vnd.ms-powerpoint',
            'wbxml' => 'application/vnd.wap.wbxml',
            'wmlc'  => 'application/vnd.wap.wmlc',
            'dcr'   => 'application/x-director',
            'dir'   => 'application/x-director',
            'dxr'   => 'application/x-director',
            'dvi'   => 'application/x-dvi',
            'gtar'  => 'application/x-gtar',
            'php3'  => 'application/x-httpd-php',
            'php4'  => 'application/x-httpd-php',
            'php'   => 'application/x-httpd-php',
            'phtml' => 'application/x-httpd-php',
            'phps'  => 'application/x-httpd-php-source',
            'swf'   => 'application/x-shockwave-flash',
            'sit'   => 'application/x-stuffit',
            'tar'   => 'application/x-tar',
            'tgz'   => 'application/x-tar',
            'xht'   => 'application/xhtml+xml',
            'xhtml' => 'application/xhtml+xml',
            'zip'   => 'application/zip',
            'mid'   => 'audio/midi',
            'midi'  => 'audio/midi',
            'mp2'   => 'audio/mpeg',
            'mp3'   => 'audio/mpeg',
            'mpga'  => 'audio/mpeg',
            'aif'   => 'audio/x-aiff',
            'aifc'  => 'audio/x-aiff',
            'aiff'  => 'audio/x-aiff',
            'ram'   => 'audio/x-pn-realaudio',
            'rm'    => 'audio/x-pn-realaudio',
            'rpm'   => 'audio/x-pn-realaudio-plugin',
            'ra'    => 'audio/x-realaudio',
            'wav'   => 'audio/x-wav',
            'bmp'   => 'image/bmp',
            'gif'   => 'image/gif',
            'jpeg'  => 'image/jpeg',
            'jpe'   => 'image/jpeg',
            'jpg'   => 'image/jpeg',
            'png'   => 'image/png',
            'tiff'  => 'image/tiff',
            'tif'   => 'image/tiff',
            'eml'   => 'message/rfc822',
            'css'   => 'text/css',
            'html'  => 'text/html',
            'htm'   => 'text/html',
            'shtml' => 'text/html',
            'log'   => 'text/plain',
            'text'  => 'text/plain',
            'txt'   => 'text/plain',
            'rtx'   => 'text/richtext',
            'rtf'   => 'text/rtf',
            'vcf'   => 'text/vcard',
            'vcard' => 'text/vcard',
            'xml'   => 'text/xml',
            'xsl'   => 'text/xml',
            'mpeg'  => 'video/mpeg',
            'mpe'   => 'video/mpeg',
            'mpg'   => 'video/mpeg',
            'mov'   => 'video/quicktime',
            'qt'    => 'video/quicktime',
            'rv'    => 'video/vnd.rn-realvideo',
            'avi'   => 'video/x-msvideo',
            'movie' => 'video/x-sgi-movie'
        );
        if (array_key_exists(strtolower($ext), $mimes)) {
            return $mimes[strtolower($ext)];
        }
        return 'application/octet-stream';
    }

    /**
     * Map a file name to a MIME type.
     * Defaults to 'application/octet-stream', i.e.. arbitrary binary data.
     * @param string $filename A file name or full path, does not need to exist as a file
     * @return string
     * @static
     */
    public static function filenameToType($filename)
    {
        // In case the path is a URL, strip any query string before getting extension
        $qpos = strpos($filename, '?');
        if (false !== $qpos) {
            $filename = substr($filename, 0, $qpos);
        }
        $pathinfo = self::mb_pathinfo($filename);
        return self::_mime_types($pathinfo['extension']);
    }

    /**
     * Multi-byte-safe pathinfo replacement.
     * Drop-in replacement for pathinfo(), but multibyte-safe, cross-platform-safe, old-version-safe.
     * Works similarly to the one in PHP >= 5.2.0
     * @link http://www.php.net/manual/en/function.pathinfo.php#107461
     * @param string $path A filename or path, does not need to exist as a file
     * @param integer|string $options Either a PATHINFO_* constant,
     *      or a string name to return only the specified piece, allows 'filename' to work on PHP < 5.2
     * @return string|array
     * @static
     */
    public static function mb_pathinfo($path, $options = null)
    {
        $ret = array('dirname' => '', 'basename' => '', 'extension' => '', 'filename' => '');
        $pathinfo = array();
        if (preg_match('%^(.*?)[\\\\/]*(([^/\\\\]*?)(\.([^\.\\\\/]+?)|))[\\\\/\.]*$%im', $path, $pathinfo)) {
            if (array_key_exists(1, $pathinfo)) {
                $ret['dirname'] = $pathinfo[1];
            }
            if (array_key_exists(2, $pathinfo)) {
                $ret['basename'] = $pathinfo[2];
            }
            if (array_key_exists(5, $pathinfo)) {
                $ret['extension'] = $pathinfo[5];
            }
            if (array_key_exists(3, $pathinfo)) {
                $ret['filename'] = $pathinfo[3];
            }
        }
        switch ($options) {
            case PATHINFO_DIRNAME:
            case 'dirname':
                return $ret['dirname'];
            case PATHINFO_BASENAME:
            case 'basename':
                return $ret['basename'];
            case PATHINFO_EXTENSION:
            case 'extension':
                return $ret['extension'];
            case PATHINFO_FILENAME:
            case 'filename':
                return $ret['filename'];
            default:
                return $ret;
        }
    }

    /**
     * Set or reset instance properties.
     * You should avoid this function - it's more verbose, less efficient, more error-prone and
     * harder to debug than setting properties directly.
     * Usage Example:
     * `$mail->set('SMTPSecure', 'tls');`
     *   is the same as:
     * `$mail->SMTPSecure = 'tls';`
     * @access public
     * @param string $name The property name to set
     * @param mixed $value The value to set the property to
     * @return boolean
     * @TODO Should this not be using the __set() magic function?
     */
    public function set($name, $value = '')
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
            return true;
        } else {
            $this->setError($this->lang('variable_set') . $name);
            return false;
        }
    }

    /**
     * Strip newlines to prevent header injection.
     * @access public
     * @param string $str
     * @return string
     */
    public function secureHeader($str)
    {
        return trim(str_replace(array("\r", "\n"), '', $str));
    }

    /**
     * Normalize line breaks in a string.
     * Converts UNIX LF, Mac CR and Windows CRLF line breaks into a single line break format.
     * Defaults to CRLF (for message bodies) and preserves consecutive breaks.
     * @param string $text
     * @param string $breaktype What kind of line break to use, defaults to CRLF
     * @return string
     * @access public
     * @static
     */
    public static function normalizeBreaks($text, $breaktype = "\r\n")
    {
        return preg_replace('/(\r\n|\r|\n)/ms', $breaktype, $text);
    }


    /**
     * Set the public and private key files and password for S/MIME signing.
     * @access public
     * @param string $cert_filename
     * @param string $key_filename
     * @param string $key_pass Password for private key
     * @param string $extracerts_filename Optional path to chain certificate
     */
    public function sign($cert_filename, $key_filename, $key_pass, $extracerts_filename = '')
    {
        $this->sign_cert_file = $cert_filename;
        $this->sign_key_file = $key_filename;
        $this->sign_key_pass = $key_pass;
        $this->sign_extracerts_file = $extracerts_filename;
    }

    /**
     * Quoted-Printable-encode a DKIM header.
     * @access public
     * @param string $txt
     * @return string
     */
    public function DKIM_QP($txt)
    {
        $line = '';
        for ($i = 0; $i < strlen($txt); $i++) {
            $ord = ord($txt[$i]);
            if (((0x21 <= $ord) && ($ord <= 0x3A)) || $ord == 0x3C || ((0x3E <= $ord) && ($ord <= 0x7E))) {
                $line .= $txt[$i];
            } else {
                $line .= '=' . sprintf('%02X', $ord);
            }
        }
        return $line;
    }

    /**
     * Generate a DKIM signature.
     * @access public
     * @param string $signHeader
     * @throws phpmailerException
     * @return string
     */
    public function DKIM_Sign($signHeader)
    {
        if (!defined('PKCS7_TEXT')) {
            if ($this->exceptions) {
                throw new phpmailerException($this->lang('extension_missing') . 'openssl');
            }
            return '';
        }
        $privKeyStr = file_get_contents($this->DKIM_private);
        if ($this->DKIM_passphrase != '') {
            $privKey = openssl_pkey_get_private($privKeyStr, $this->DKIM_passphrase);
        } else {
            $privKey = $privKeyStr;
        }
        if (openssl_sign($signHeader, $signature, $privKey)) {
            return base64_encode($signature);
        }
        return '';
    }

    /**
     * Generate a DKIM canonicalization header.
     * @access public
     * @param string $signHeader Header
     * @return string
     */
    public function DKIM_HeaderC($signHeader)
    {
        $signHeader = preg_replace('/\r\n\s+/', ' ', $signHeader);
        $lines = explode("\r\n", $signHeader);
        foreach ($lines as $key => $line) {
            list($heading, $value) = explode(':', $line, 2);
            $heading = strtolower($heading);
            $value = preg_replace('/\s+/', ' ', $value); // Compress useless spaces
            $lines[$key] = $heading . ':' . trim($value); // Don't forget to remove WSP around the value
        }
        $signHeader = implode("\r\n", $lines);
        return $signHeader;
    }

    /**
     * Generate a DKIM canonicalization body.
     * @access public
     * @param string $body Message Body
     * @return string
     */
    public function DKIM_BodyC($body)
    {
        if ($body == '') {
            return "\r\n";
        }
        // stabilize line endings
        $body = str_replace("\r\n", "\n", $body);
        $body = str_replace("\n", "\r\n", $body);
        // END stabilize line endings
        while (substr($body, strlen($body) - 4, 4) == "\r\n\r\n") {
            $body = substr($body, 0, strlen($body) - 2);
        }
        return $body;
    }

    /**
     * Create the DKIM header and body in a new message header.
     * @access public
     * @param string $headers_line Header lines
     * @param string $subject Subject
     * @param string $body Body
     * @return string
     */
    public function DKIM_Add($headers_line, $subject, $body)
    {
        $DKIMsignatureType = 'rsa-sha1'; // Signature & hash algorithms
        $DKIMcanonicalization = 'relaxed/simple'; // Canonicalization of header/body
        $DKIMquery = 'dns/txt'; // Query method
        $DKIMtime = time(); // Signature Timestamp = seconds since 00:00:00 - Jan 1, 1970 (UTC time zone)
        $subject_header = "Subject: $subject";
        $headers = explode($this->LE, $headers_line);
        $from_header = '';
        $to_header = '';
        $current = '';
        foreach ($headers as $header) {
            if (strpos($header, 'From:') === 0) {
                $from_header = $header;
                $current = 'from_header';
            } elseif (strpos($header, 'To:') === 0) {
                $to_header = $header;
                $current = 'to_header';
            } else {
                if (!empty($$current) && strpos($header, ' =?') === 0) {
                    $$current .= $header;
                } else {
                    $current = '';
                }
            }
        }
        $from = str_replace('|', '=7C', $this->DKIM_QP($from_header));
        $to = str_replace('|', '=7C', $this->DKIM_QP($to_header));
        $subject = str_replace(
            '|',
            '=7C',
            $this->DKIM_QP($subject_header)
        ); // Copied header fields (dkim-quoted-printable)
        $body = $this->DKIM_BodyC($body);
        $DKIMlen = strlen($body); // Length of body
        $DKIMb64 = base64_encode(pack('H*', sha1($body))); // Base64 of packed binary SHA-1 hash of body
        if ('' == $this->DKIM_identity) {
            $ident = '';
        } else {
            $ident = ' i=' . $this->DKIM_identity . ';';
        }
        $dkimhdrs = 'DKIM-Signature: v=1; a=' .
            $DKIMsignatureType . '; q=' .
            $DKIMquery . '; l=' .
            $DKIMlen . '; s=' .
            $this->DKIM_selector .
            ";\r\n" .
            "\tt=" . $DKIMtime . '; c=' . $DKIMcanonicalization . ";\r\n" .
            "\th=From:To:Subject;\r\n" .
            "\td=" . $this->DKIM_domain . ';' . $ident . "\r\n" .
            "\tz=$from\r\n" .
            "\t|$to\r\n" .
            "\t|$subject;\r\n" .
            "\tbh=" . $DKIMb64 . ";\r\n" .
            "\tb=";
        $toSign = $this->DKIM_HeaderC(
            $from_header . "\r\n" . $to_header . "\r\n" . $subject_header . "\r\n" . $dkimhdrs
        );
        $signed = $this->DKIM_Sign($toSign);
        return $dkimhdrs . $signed . "\r\n";
    }

    /**
     * Detect if a string contains a line longer than the maximum line length allowed.
     * @param string $str
     * @return boolean
     * @static
     */
    public static function hasLineLongerThanMax($str)
    {
        //+2 to include CRLF line break for a 1000 total
        return (boolean)preg_match('/^(.{'.(self::MAX_LINE_LENGTH + 2).',})/m', $str);
    }

    /**
     * Allows for public read access to 'to' property.
     * @access public
     * @return array
     */
    public function getToAddresses()
    {
        return $this->to;
    }

    /**
     * Allows for public read access to 'cc' property.
     * @access public
     * @return array
     */
    public function getCcAddresses()
    {
        return $this->cc;
    }

    /**
     * Allows for public read access to 'bcc' property.
     * @access public
     * @return array
     */
    public function getBccAddresses()
    {
        return $this->bcc;
    }

    /**
     * Allows for public read access to 'ReplyTo' property.
     * @access public
     * @return array
     */
    public function getReplyToAddresses()
    {
        return $this->ReplyTo;
    }

    /**
     * Allows for public read access to 'all_recipients' property.
     * @access public
     * @return array
     */
    public function getAllRecipientAddresses()
    {
        return $this->all_recipients;
    }

    /**
     * Perform a callback.
     * @param boolean $isSent
     * @param array $to
     * @param array $cc
     * @param array $bcc
     * @param string $subject
     * @param string $body
     * @param string $from
     */
    protected function doCallback($isSent, $to, $cc, $bcc, $subject, $body, $from)
    {
        if (!empty($this->action_function) && is_callable($this->action_function)) {
            $params = array($isSent, $to, $cc, $bcc, $subject, $body, $from);
            call_user_func_array($this->action_function, $params);
        }
    }
}

/**
 * PHPMailer exception handler
 * @package PHPMailer
 */
class phpmailerException extends Exception
{
    /**
     * Prettify error message output
     * @return string
     */
    public function errorMessage()
    {
        $errorMsg = '<strong>' . $this->getMessage() . "</strong><br />\n";
        return $errorMsg;
    }
}





















//**********************IMPORTANT - Following is smtp code OF PHPMAILER***************************
/**
 * PHPMailer RFC821 SMTP email transport class.
 * PHP Version 5
 * @package PHPMailer
 * @link https://github.com/PHPMailer/PHPMailer/ The PHPMailer GitHub project
 * @author Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 * @author Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
 * @author Brent R. Matzelle (original founder)
 * @copyright 2014 Marcus Bointon
 * @copyright 2010 - 2012 Jim Jagielski
 * @copyright 2004 - 2009 Andy Prevost
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * PHPMailer RFC821 SMTP email transport class.
 * Implements RFC 821 SMTP commands and provides some utility methods for sending mail to an SMTP server.
 * @package PHPMailer
 * @author Chris Ryan
 * @author Marcus Bointon <phpmailer@synchromedia.co.uk>
 */
class SMTP
{
    /**
     * The PHPMailer SMTP version number.
     * @type string
     */
    const VERSION = '5.2.10';

    /**
     * SMTP line break constant.
     * @type string
     */
    const CRLF = "\r\n";

    /**
     * The SMTP port to use if one is not specified.
     * @type integer
     */
    const DEFAULT_SMTP_PORT = 25;

    /**
     * The maximum line length allowed by RFC 2822 section 2.1.1
     * @type integer
     */
    const MAX_LINE_LENGTH = 998;

    /**
     * Debug level for no output
     */
    const DEBUG_OFF = 0;

    /**
     * Debug level to show client -> server messages
     */
    const DEBUG_CLIENT = 1;

    /**
     * Debug level to show client -> server and server -> client messages
     */
    const DEBUG_SERVER = 2;

    /**
     * Debug level to show connection status, client -> server and server -> client messages
     */
    const DEBUG_CONNECTION = 3;

    /**
     * Debug level to show all messages
     */
    const DEBUG_LOWLEVEL = 4;

    /**
     * The PHPMailer SMTP Version number.
     * @type string
     * @deprecated Use the `VERSION` constant instead
     * @see SMTP::VERSION
     */
    public $Version = '5.2.10';

    /**
     * SMTP server port number.
     * @type integer
     * @deprecated This is only ever used as a default value, so use the `DEFAULT_SMTP_PORT` constant instead
     * @see SMTP::DEFAULT_SMTP_PORT
     */
    public $SMTP_PORT = 25;

    /**
     * SMTP reply line ending.
     * @type string
     * @deprecated Use the `CRLF` constant instead
     * @see SMTP::CRLF
     */
    public $CRLF = "\r\n";

    /**
     * Debug output level.
     * Options:
     * * self::DEBUG_OFF (`0`) No debug output, default
     * * self::DEBUG_CLIENT (`1`) Client commands
     * * self::DEBUG_SERVER (`2`) Client commands and server responses
     * * self::DEBUG_CONNECTION (`3`) As DEBUG_SERVER plus connection status
     * * self::DEBUG_LOWLEVEL (`4`) Low-level data output, all messages
     * @type integer
     */
    public $do_debug = self::DEBUG_OFF;

    /**
     * How to handle debug output.
     * Options:
     * * `echo` Output plain-text as-is, appropriate for CLI
     * * `html` Output escaped, line breaks converted to `<br>`, appropriate for browser output
     * * `error_log` Output to error log as configured in php.ini
     *
     * Alternatively, you can provide a callable expecting two params: a message string and the debug level:
     * <code>
     * $smtp->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";};
     * </code>
     * @type string|callable
     */
    public $Debugoutput = 'echo';

    /**
     * Whether to use VERP.
     * @link http://en.wikipedia.org/wiki/Variable_envelope_return_path
     * @link http://www.postfix.org/VERP_README.html Info on VERP
     * @type boolean
     */
    public $do_verp = false;

    /**
     * The timeout value for connection, in seconds.
     * Default of 5 minutes (300sec) is from RFC2821 section 4.5.3.2
     * This needs to be quite high to function correctly with hosts using greetdelay as an anti-spam measure.
     * @link http://tools.ietf.org/html/rfc2821#section-4.5.3.2
     * @type integer
     */
    public $Timeout = 300;

    /**
     * How long to wait for commands to complete, in seconds.
     * Default of 5 minutes (300sec) is from RFC2821 section 4.5.3.2
     * @type integer
     */
    public $Timelimit = 300;

    /**
     * The socket for the server connection.
     * @type resource
     */
    protected $smtp_conn;

    /**
     * Error information, if any, for the last SMTP command.
     * @type array
     */
    protected $error = array(
        'error' => '',
        'detail' => '',
        'smtp_code' => '',
        'smtp_code_ex' => ''
    );

    /**
     * The reply the server sent to us for HELO.
     * If null, no HELO string has yet been received.
     * @type string|null
     */
    protected $helo_rply = null;

    /**
     * The set of SMTP extensions sent in reply to EHLO command.
     * Indexes of the array are extension names.
     * Value at index 'HELO' or 'EHLO' (according to command that was sent)
     * represents the server name. In case of HELO it is the only element of the array.
     * Other values can be boolean TRUE or an array containing extension options.
     * If null, no HELO/EHLO string has yet been received.
     * @type array|null
     */
    protected $server_caps = null;

    /**
     * The most recent reply received from the server.
     * @type string
     */
    protected $last_reply = '';

    /**
     * Output debugging info via a user-selected method.
     * @see SMTP::$Debugoutput
     * @see SMTP::$do_debug
     * @param string $str Debug string to output
     * @param integer $level The debug level of this message; see DEBUG_* constants
     * @return void
     */
    protected function edebug($str, $level = 0)
    {
        if ($level > $this->do_debug) {
            return;
        }
        //Avoid clash with built-in function names
        if (!in_array($this->Debugoutput, array('error_log', 'html', 'echo')) and is_callable($this->Debugoutput)) {
            call_user_func($this->Debugoutput, $str, $this->do_debug);
            return;
        }
        switch ($this->Debugoutput) {
            case 'error_log':
                //Don't output, just log
                error_log($str);
                break;
            case 'html':
                //Cleans up output a bit for a better looking, HTML-safe output
                echo htmlentities(
                    preg_replace('/[\r\n]+/', '', $str),
                    ENT_QUOTES,
                    'UTF-8'
                )
                . "<br>\n";
                break;
            case 'echo':
            default:
                //Normalize line breaks
                $str = preg_replace('/(\r\n|\r|\n)/ms', "\n", $str);
                echo gmdate('Y-m-d H:i:s') . "\t" . str_replace(
                    "\n",
                    "\n                   \t                  ",
                    trim($str)
                )."\n";
        }
    }

    /**
     * Connect to an SMTP server.
     * @param string $host SMTP server IP or host name
     * @param integer $port The port number to connect to
     * @param integer $timeout How long to wait for the connection to open
     * @param array $options An array of options for stream_context_create()
     * @access public
     * @return boolean
     */
    public function connect($host, $port = null, $timeout = 30, $options = array())
    {
        static $streamok;
        //This is enabled by default since 5.0.0 but some providers disable it
        //Check this once and cache the result
        if (is_null($streamok)) {
            $streamok = function_exists('stream_socket_client');
        }
        // Clear errors to avoid confusion
        $this->setError('');
        // Make sure we are __not__ connected
        if ($this->connected()) {
            // Already connected, generate error
            $this->setError('Already connected to a server');
            return false;
        }
        if (empty($port)) {
            $port = self::DEFAULT_SMTP_PORT;
        }
        // Connect to the SMTP server
        $this->edebug(
            "Connection: opening to $host:$port, timeout=$timeout, options=".var_export($options, true),
            self::DEBUG_CONNECTION
        );
        $errno = 0;
        $errstr = '';
        if ($streamok) {
            $socket_context = stream_context_create($options);
            //Suppress errors; connection failures are handled at a higher level
            $this->smtp_conn = @stream_socket_client(
                $host . ":" . $port,
                $errno,
                $errstr,
                $timeout,
                STREAM_CLIENT_CONNECT,
                $socket_context
            );
        } else {
            //Fall back to fsockopen which should work in more places, but is missing some features
            $this->edebug(
                "Connection: stream_socket_client not available, falling back to fsockopen",
                self::DEBUG_CONNECTION
            );
            $this->smtp_conn = fsockopen(
                $host,
                $port,
                $errno,
                $errstr,
                $timeout
            );
        }
        // Verify we connected properly
        if (!is_resource($this->smtp_conn)) {
            $this->setError(
                'Failed to connect to server',
                $errno,
                $errstr
            );
            $this->edebug(
                'SMTP ERROR: ' . $this->error['error']
                . ": $errstr ($errno)",
                self::DEBUG_CLIENT
            );
            return false;
        }
        $this->edebug('Connection: opened', self::DEBUG_CONNECTION);
        // SMTP server can take longer to respond, give longer timeout for first read
        // Windows does not have support for this timeout function
        if (substr(PHP_OS, 0, 3) != 'WIN') {
            $max = ini_get('max_execution_time');
            // Don't bother if unlimited
            if ($max != 0 && $timeout > $max) {
                @set_time_limit($timeout);
            }
            stream_set_timeout($this->smtp_conn, $timeout, 0);
        }
        // Get any announcement
        $announce = $this->get_lines();
        $this->edebug('SERVER -> CLIENT: ' . $announce, self::DEBUG_SERVER);
        return true;
    }

    /**
     * Initiate a TLS (encrypted) session.
     * @access public
     * @return boolean
     */
    public function startTLS()
    {
        if (!$this->sendCommand('STARTTLS', 'STARTTLS', 220)) {
            return false;
        }
        // Begin encrypted connection
        if (!stream_socket_enable_crypto(
            $this->smtp_conn,
            true,
            STREAM_CRYPTO_METHOD_TLS_CLIENT
        )) {
            return false;
        }
        return true;
    }

    /**
     * Perform SMTP authentication.
     * Must be run after hello().
     * @see hello()
     * @param string $username    The user name
     * @param string $password    The password
     * @param string $authtype    The auth type (PLAIN, LOGIN, NTLM, CRAM-MD5)
     * @param string $realm       The auth realm for NTLM
     * @param string $workstation The auth workstation for NTLM
     * @access public
     * @return boolean True if successfully authenticated.
     */
    public function authenticate(
        $username,
        $password,
        $authtype = null,
        $realm = '',
        $workstation = ''
    ) {
        if (!$this->server_caps) {
            $this->setError('Authentication is not allowed before HELO/EHLO');
            return false;
        }

        if (array_key_exists('EHLO', $this->server_caps)) {
        // SMTP extensions are available. Let's try to find a proper authentication method

            if (!array_key_exists('AUTH', $this->server_caps)) {
                $this->setError('Authentication is not allowed at this stage');
                // 'at this stage' means that auth may be allowed after the stage changes
                // e.g. after STARTTLS
                return false;
            }

            self::edebug('Auth method requested: ' . ($authtype ? $authtype : 'UNKNOWN'), self::DEBUG_LOWLEVEL);
            self::edebug(
                'Auth methods available on the server: ' . implode(',', $this->server_caps['AUTH']),
                self::DEBUG_LOWLEVEL
            );

            if (empty($authtype)) {
                foreach (array('LOGIN', 'CRAM-MD5', 'NTLM', 'PLAIN') as $method) {
                    if (in_array($method, $this->server_caps['AUTH'])) {
                        $authtype = $method;
                        break;
                    }
                }
                if (empty($authtype)) {
                    $this->setError('No supported authentication methods found');
                    return false;
                }
                self::edebug('Auth method selected: '.$authtype, self::DEBUG_LOWLEVEL);
            }

            if (!in_array($authtype, $this->server_caps['AUTH'])) {
                $this->setError("The requested authentication method \"$authtype\" is not supported by the server");
                return false;
            }
        } elseif (empty($authtype)) {
            $authtype = 'LOGIN';
        }
        switch ($authtype) {
            case 'PLAIN':
                // Start authentication
                if (!$this->sendCommand('AUTH', 'AUTH PLAIN', 334)) {
                    return false;
                }
                // Send encoded username and password
                if (!$this->sendCommand(
                    'User & Password',
                    base64_encode("\0" . $username . "\0" . $password),
                    235
                )
                ) {
                    return false;
                }
                break;
            case 'LOGIN':
                // Start authentication
                if (!$this->sendCommand('AUTH', 'AUTH LOGIN', 334)) {
                    return false;
                }
                if (!$this->sendCommand("Username", base64_encode($username), 334)) {
                    return false;
                }
                if (!$this->sendCommand("Password", base64_encode($password), 235)) {
                    return false;
                }
                break;
            case 'NTLM':
                /*
                 * ntlm_sasl_client.php
                 * Bundled with Permission
                 *
                 * How to telnet in windows:
                 * http://technet.microsoft.com/en-us/library/aa995718%28EXCHG.65%29.aspx
                 * PROTOCOL Docs http://curl.haxx.se/rfc/ntlm.html#ntlmSmtpAuthentication
                 */
                require_once 'extras/ntlm_sasl_client.php';
                $temp = new stdClass;
                $ntlm_client = new ntlm_sasl_client_class;
                //Check that functions are available
                if (!$ntlm_client->Initialize($temp)) {
                    $this->setError($temp->error);
                    $this->edebug(
                        'You need to enable some modules in your php.ini file: '
                        . $this->error['error'],
                        self::DEBUG_CLIENT
                    );
                    return false;
                }
                //msg1
                $msg1 = $ntlm_client->TypeMsg1($realm, $workstation); //msg1

                if (!$this->sendCommand(
                    'AUTH NTLM',
                    'AUTH NTLM ' . base64_encode($msg1),
                    334
                )
                ) {
                    return false;
                }
                //Though 0 based, there is a white space after the 3 digit number
                //msg2
                $challenge = substr($this->last_reply, 3);
                $challenge = base64_decode($challenge);
                $ntlm_res = $ntlm_client->NTLMResponse(
                    substr($challenge, 24, 8),
                    $password
                );
                //msg3
                $msg3 = $ntlm_client->TypeMsg3(
                    $ntlm_res,
                    $username,
                    $realm,
                    $workstation
                );
                // send encoded username
                return $this->sendCommand('Username', base64_encode($msg3), 235);
            case 'CRAM-MD5':
                // Start authentication
                if (!$this->sendCommand('AUTH CRAM-MD5', 'AUTH CRAM-MD5', 334)) {
                    return false;
                }
                // Get the challenge
                $challenge = base64_decode(substr($this->last_reply, 4));

                // Build the response
                $response = $username . ' ' . $this->hmac($challenge, $password);

                // send encoded credentials
                return $this->sendCommand('Username', base64_encode($response), 235);
            default:
                $this->setError("Authentication method \"$authtype\" is not supported");
                return false;
        }
        return true;
    }

    /**
     * Calculate an MD5 HMAC hash.
     * Works like hash_hmac('md5', $data, $key)
     * in case that function is not available
     * @param string $data The data to hash
     * @param string $key  The key to hash with
     * @access protected
     * @return string
     */
    protected function hmac($data, $key)
    {
        if (function_exists('hash_hmac')) {
            return hash_hmac('md5', $data, $key);
        }

        // The following borrowed from
        // http://php.net/manual/en/function.mhash.php#27225

        // RFC 2104 HMAC implementation for php.
        // Creates an md5 HMAC.
        // Eliminates the need to install mhash to compute a HMAC
        // by Lance Rushing

        $bytelen = 64; // byte length for md5
        if (strlen($key) > $bytelen) {
            $key = pack('H*', md5($key));
        }
        $key = str_pad($key, $bytelen, chr(0x00));
        $ipad = str_pad('', $bytelen, chr(0x36));
        $opad = str_pad('', $bytelen, chr(0x5c));
        $k_ipad = $key ^ $ipad;
        $k_opad = $key ^ $opad;

        return md5($k_opad . pack('H*', md5($k_ipad . $data)));
    }

    /**
     * Check connection state.
     * @access public
     * @return boolean True if connected.
     */
    public function connected()
    {
        if (is_resource($this->smtp_conn)) {
            $sock_status = stream_get_meta_data($this->smtp_conn);
            if ($sock_status['eof']) {
                // The socket is valid but we are not connected
                $this->edebug(
                    'SMTP NOTICE: EOF caught while checking if connected',
                    self::DEBUG_CLIENT
                );
                $this->close();
                return false;
            }
            return true; // everything looks good
        }
        return false;
    }

    /**
     * Close the socket and clean up the state of the class.
     * Don't use this function without first trying to use QUIT.
     * @see quit()
     * @access public
     * @return void
     */
    public function close()
    {
        $this->setError('');
        $this->server_caps = null;
        $this->helo_rply = null;
        if (is_resource($this->smtp_conn)) {
            // close the connection and cleanup
            fclose($this->smtp_conn);
            $this->smtp_conn = null; //Makes for cleaner serialization
            $this->edebug('Connection: closed', self::DEBUG_CONNECTION);
        }
    }

    /**
     * Send an SMTP DATA command.
     * Issues a data command and sends the msg_data to the server,
     * finializing the mail transaction. $msg_data is the message
     * that is to be send with the headers. Each header needs to be
     * on a single line followed by a <CRLF> with the message headers
     * and the message body being separated by and additional <CRLF>.
     * Implements rfc 821: DATA <CRLF>
     * @param string $msg_data Message data to send
     * @access public
     * @return boolean
     */
    public function data($msg_data)
    {
        //This will use the standard timelimit
        if (!$this->sendCommand('DATA', 'DATA', 354)) {
            return false;
        }

        /* The server is ready to accept data!
         * According to rfc821 we should not send more than 1000 characters on a single line (including the CRLF)
         * so we will break the data up into lines by \r and/or \n then if needed we will break each of those into
         * smaller lines to fit within the limit.
         * We will also look for lines that start with a '.' and prepend an additional '.'.
         * NOTE: this does not count towards line-length limit.
         */

        // Normalize line breaks before exploding
        $lines = explode("\n", str_replace(array("\r\n", "\r"), "\n", $msg_data));

        /* To distinguish between a complete RFC822 message and a plain message body, we check if the first field
         * of the first line (':' separated) does not contain a space then it _should_ be a header and we will
         * process all lines before a blank line as headers.
         */

        $field = substr($lines[0], 0, strpos($lines[0], ':'));
        $in_headers = false;
        if (!empty($field) && strpos($field, ' ') === false) {
            $in_headers = true;
        }

        foreach ($lines as $line) {
            $lines_out = array();
            if ($in_headers and $line == '') {
                $in_headers = false;
            }
            //Break this line up into several smaller lines if it's too long
            //Micro-optimisation: isset($str[$len]) is faster than (strlen($str) > $len),
            while (isset($line[self::MAX_LINE_LENGTH])) {
                //Working backwards, try to find a space within the last MAX_LINE_LENGTH chars of the line to break on
                //so as to avoid breaking in the middle of a word
                $pos = strrpos(substr($line, 0, self::MAX_LINE_LENGTH), ' ');
                //Deliberately matches both false and 0
                if (!$pos) {
                    //No nice break found, add a hard break
                    $pos = self::MAX_LINE_LENGTH - 1;
                    $lines_out[] = substr($line, 0, $pos);
                    $line = substr($line, $pos);
                } else {
                    //Break at the found point
                    $lines_out[] = substr($line, 0, $pos);
                    //Move along by the amount we dealt with
                    $line = substr($line, $pos + 1);
                }
                //If processing headers add a LWSP-char to the front of new line RFC822 section 3.1.1
                if ($in_headers) {
                    $line = "\t" . $line;
                }
            }
            $lines_out[] = $line;

            //Send the lines to the server
            foreach ($lines_out as $line_out) {
                //RFC2821 section 4.5.2
                if (!empty($line_out) and $line_out[0] == '.') {
                    $line_out = '.' . $line_out;
                }
                $this->client_send($line_out . self::CRLF);
            }
        }

        //Message data has been sent, complete the command
        //Increase timelimit for end of DATA command
        $savetimelimit = $this->Timelimit;
        $this->Timelimit = $this->Timelimit * 2;
        $result = $this->sendCommand('DATA END', '.', 250);
        //Restore timelimit
        $this->Timelimit = $savetimelimit;
        return $result;
    }

    /**
     * Send an SMTP HELO or EHLO command.
     * Used to identify the sending server to the receiving server.
     * This makes sure that client and server are in a known state.
     * Implements RFC 821: HELO <SP> <domain> <CRLF>
     * and RFC 2821 EHLO.
     * @param string $host The host name or IP to connect to
     * @access public
     * @return boolean
     */
    public function hello($host = '')
    {
        //Try extended hello first (RFC 2821)
        return (boolean)($this->sendHello('EHLO', $host) or $this->sendHello('HELO', $host));
    }

    /**
     * Send an SMTP HELO or EHLO command.
     * Low-level implementation used by hello()
     * @see hello()
     * @param string $hello The HELO string
     * @param string $host The hostname to say we are
     * @access protected
     * @return boolean
     */
    protected function sendHello($hello, $host)
    {
        $noerror = $this->sendCommand($hello, $hello . ' ' . $host, 250);
        $this->helo_rply = $this->last_reply;
        if ($noerror) {
            $this->parseHelloFields($hello);
        } else {
            $this->server_caps = null;
        }
        return $noerror;
    }

    /**
     * Parse a reply to HELO/EHLO command to discover server extensions.
     * In case of HELO, the only parameter that can be discovered is a server name.
     * @access protected
     * @param string $type - 'HELO' or 'EHLO'
     */
    protected function parseHelloFields($type)
    {
        $this->server_caps = array();
        $lines = explode("\n", $this->last_reply);
        foreach ($lines as $n => $s) {
            $s = trim(substr($s, 4));
            if (!$s) {
                continue;
            }
            $fields = explode(' ', $s);
            if (!empty($fields)) {
                if (!$n) {
                    $name = $type;
                    $fields = $fields[0];
                } else {
                    $name = array_shift($fields);
                    if ($name == 'SIZE') {
                        $fields = ($fields) ? $fields[0] : 0;
                    }
                }
                $this->server_caps[$name] = ($fields ? $fields : true);
            }
        }
    }

    /**
     * Send an SMTP MAIL command.
     * Starts a mail transaction from the email address specified in
     * $from. Returns true if successful or false otherwise. If True
     * the mail transaction is started and then one or more recipient
     * commands may be called followed by a data command.
     * Implements rfc 821: MAIL <SP> FROM:<reverse-path> <CRLF>
     * @param string $from Source address of this message
     * @access public
     * @return boolean
     */
    public function mail($from)
    {
        $useVerp = ($this->do_verp ? ' XVERP' : '');
        return $this->sendCommand(
            'MAIL FROM',
            'MAIL FROM:<' . $from . '>' . $useVerp,
            250
        );
    }

    /**
     * Send an SMTP QUIT command.
     * Closes the socket if there is no error or the $close_on_error argument is true.
     * Implements from rfc 821: QUIT <CRLF>
     * @param boolean $close_on_error Should the connection close if an error occurs?
     * @access public
     * @return boolean
     */
    public function quit($close_on_error = true)
    {
        $noerror = $this->sendCommand('QUIT', 'QUIT', 221);
        $err = $this->error; //Save any error
        if ($noerror or $close_on_error) {
            $this->close();
            $this->error = $err; //Restore any error from the quit command
        }
        return $noerror;
    }

    /**
     * Send an SMTP RCPT command.
     * Sets the TO argument to $toaddr.
     * Returns true if the recipient was accepted false if it was rejected.
     * Implements from rfc 821: RCPT <SP> TO:<forward-path> <CRLF>
     * @param string $toaddr The address the message is being sent to
     * @access public
     * @return boolean
     */
    public function recipient($toaddr)
    {
        return $this->sendCommand(
            'RCPT TO',
            'RCPT TO:<' . $toaddr . '>',
            array(250, 251)
        );
    }

    /**
     * Send an SMTP RSET command.
     * Abort any transaction that is currently in progress.
     * Implements rfc 821: RSET <CRLF>
     * @access public
     * @return boolean True on success.
     */
    public function reset()
    {
        return $this->sendCommand('RSET', 'RSET', 250);
    }

    /**
     * Send a command to an SMTP server and check its return code.
     * @param string $command       The command name - not sent to the server
     * @param string $commandstring The actual command to send
     * @param integer|array $expect     One or more expected integer success codes
     * @access protected
     * @return boolean True on success.
     */
    protected function sendCommand($command, $commandstring, $expect)
    {
        if (!$this->connected()) {
            $this->setError("Called $command without being connected");
            return false;
        }
        $this->client_send($commandstring . self::CRLF);

        $this->last_reply = $this->get_lines();
        // Fetch SMTP code and possible error code explanation
        $matches = array();
        if (preg_match("/^([0-9]{3})[ -](?:([0-9]\\.[0-9]\\.[0-9]) )?/", $this->last_reply, $matches)) {
            $code = $matches[1];
            $code_ex = (count($matches) > 2 ? $matches[2] : null);
            // Cut off error code from each response line
            $detail = preg_replace(
                "/{$code}[ -]".($code_ex ? str_replace('.', '\\.', $code_ex).' ' : '')."/m",
                '',
                $this->last_reply
            );
        } else {
            // Fall back to simple parsing if regex fails
            $code = substr($this->last_reply, 0, 3);
            $code_ex = null;
            $detail = substr($this->last_reply, 4);
        }

        $this->edebug('SERVER -> CLIENT: ' . $this->last_reply, self::DEBUG_SERVER);

        if (!in_array($code, (array)$expect)) {
            $this->setError(
                "$command command failed",
                $detail,
                $code,
                $code_ex
            );
            $this->edebug(
                'SMTP ERROR: ' . $this->error['error'] . ': ' . $this->last_reply,
                self::DEBUG_CLIENT
            );
            return false;
        }

        $this->setError('');
        return true;
    }

    /**
     * Send an SMTP SAML command.
     * Starts a mail transaction from the email address specified in $from.
     * Returns true if successful or false otherwise. If True
     * the mail transaction is started and then one or more recipient
     * commands may be called followed by a data command. This command
     * will send the message to the users terminal if they are logged
     * in and send them an email.
     * Implements rfc 821: SAML <SP> FROM:<reverse-path> <CRLF>
     * @param string $from The address the message is from
     * @access public
     * @return boolean
     */
    public function sendAndMail($from)
    {
        return $this->sendCommand('SAML', "SAML FROM:$from", 250);
    }

    /**
     * Send an SMTP VRFY command.
     * @param string $name The name to verify
     * @access public
     * @return boolean
     */
    public function verify($name)
    {
        return $this->sendCommand('VRFY', "VRFY $name", array(250, 251));
    }

    /**
     * Send an SMTP NOOP command.
     * Used to keep keep-alives alive, doesn't actually do anything
     * @access public
     * @return boolean
     */
    public function noop()
    {
        return $this->sendCommand('NOOP', 'NOOP', 250);
    }

    /**
     * Send an SMTP TURN command.
     * This is an optional command for SMTP that this class does not support.
     * This method is here to make the RFC821 Definition complete for this class
     * and _may_ be implemented in future
     * Implements from rfc 821: TURN <CRLF>
     * @access public
     * @return boolean
     */
    public function turn()
    {
        $this->setError('The SMTP TURN command is not implemented');
        $this->edebug('SMTP NOTICE: ' . $this->error['error'], self::DEBUG_CLIENT);
        return false;
    }

    /**
     * Send raw data to the server.
     * @param string $data The data to send
     * @access public
     * @return integer|boolean The number of bytes sent to the server or false on error
     */
    public function client_send($data)
    {
        $this->edebug("CLIENT -> SERVER: $data", self::DEBUG_CLIENT);
        return fwrite($this->smtp_conn, $data);
    }

    /**
     * Get the latest error.
     * @access public
     * @return array
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Get SMTP extensions available on the server
     * @access public
     * @return array|null
     */
    public function getServerExtList()
    {
        return $this->server_caps;
    }

    /**
     * A multipurpose method
     * The method works in three ways, dependent on argument value and current state
     *   1. HELO/EHLO was not sent - returns null and set up $this->error
     *   2. HELO was sent
     *     $name = 'HELO': returns server name
     *     $name = 'EHLO': returns boolean false
     *     $name = any string: returns null and set up $this->error
     *   3. EHLO was sent
     *     $name = 'HELO'|'EHLO': returns server name
     *     $name = any string: if extension $name exists, returns boolean True
     *       or its options. Otherwise returns boolean False
     * In other words, one can use this method to detect 3 conditions:
     *  - null returned: handshake was not or we don't know about ext (refer to $this->error)
     *  - false returned: the requested feature exactly not exists
     *  - positive value returned: the requested feature exists
     * @param string $name Name of SMTP extension or 'HELO'|'EHLO'
     * @return mixed
     */
    public function getServerExt($name)
    {
        if (!$this->server_caps) {
            $this->setError('No HELO/EHLO was sent');
            return null;
        }

        // the tight logic knot ;)
        if (!array_key_exists($name, $this->server_caps)) {
            if ($name == 'HELO') {
                return $this->server_caps['EHLO'];
            }
            if ($name == 'EHLO' || array_key_exists('EHLO', $this->server_caps)) {
                return false;
            }
            $this->setError('HELO handshake was used. Client knows nothing about server extensions');
            return null;
        }

        return $this->server_caps[$name];
    }

    /**
     * Get the last reply from the server.
     * @access public
     * @return string
     */
    public function getLastReply()
    {
        return $this->last_reply;
    }

    /**
     * Read the SMTP server's response.
     * Either before eof or socket timeout occurs on the operation.
     * With SMTP we can tell if we have more lines to read if the
     * 4th character is '-' symbol. If it is a space then we don't
     * need to read anything else.
     * @access protected
     * @return string
     */
    protected function get_lines()
    {
        // If the connection is bad, give up straight away
        if (!is_resource($this->smtp_conn)) {
            return '';
        }
        $data = '';
        $endtime = 0;
        stream_set_timeout($this->smtp_conn, $this->Timeout);
        if ($this->Timelimit > 0) {
            $endtime = time() + $this->Timelimit;
        }
        while (is_resource($this->smtp_conn) && !feof($this->smtp_conn)) {
            $str = @fgets($this->smtp_conn, 515);
            $this->edebug("SMTP -> get_lines(): \$data was \"$data\"", self::DEBUG_LOWLEVEL);
            $this->edebug("SMTP -> get_lines(): \$str is \"$str\"", self::DEBUG_LOWLEVEL);
            $data .= $str;
            $this->edebug("SMTP -> get_lines(): \$data is \"$data\"", self::DEBUG_LOWLEVEL);
            // If 4th character is a space, we are done reading, break the loop, micro-optimisation over strlen
            if ((isset($str[3]) and $str[3] == ' ')) {
                break;
            }
            // Timed-out? Log and break
            $info = stream_get_meta_data($this->smtp_conn);
            if ($info['timed_out']) {
                $this->edebug(
                    'SMTP -> get_lines(): timed-out (' . $this->Timeout . ' sec)',
                    self::DEBUG_LOWLEVEL
                );
                break;
            }
            // Now check if reads took too long
            if ($endtime and time() > $endtime) {
                $this->edebug(
                    'SMTP -> get_lines(): timelimit reached ('.
                    $this->Timelimit . ' sec)',
                    self::DEBUG_LOWLEVEL
                );
                break;
            }
        }
        return $data;
    }

    /**
     * Enable or disable VERP address generation.
     * @param boolean $enabled
     */
    public function setVerp($enabled = false)
    {
        $this->do_verp = $enabled;
    }

    /**
     * Get VERP address generation mode.
     * @return boolean
     */
    public function getVerp()
    {
        return $this->do_verp;
    }

    /**
     * Set error messages and codes.
     * @param string $message The error message
     * @param string $detail Further detail on the error
     * @param string $smtp_code An associated SMTP error code
     * @param string $smtp_code_ex Extended SMTP code
     */
    protected function setError($message, $detail = '', $smtp_code = '', $smtp_code_ex = '')
    {
        $this->error = array(
            'error' => $message,
            'detail' => $detail,
            'smtp_code' => $smtp_code,
            'smtp_code_ex' => $smtp_code_ex
        );
    }

    /**
     * Set debug output method.
     * @param string|callable $method The name of the mechanism to use for debugging output, or a callable to handle it.
     */
    public function setDebugOutput($method = 'echo')
    {
        $this->Debugoutput = $method;
    }

    /**
     * Get debug output method.
     * @return string
     */
    public function getDebugOutput()
    {
        return $this->Debugoutput;
    }

    /**
     * Set debug output level.
     * @param integer $level
     */
    public function setDebugLevel($level = 0)
    {
        $this->do_debug = $level;
    }

    /**
     * Get debug output level.
     * @return integer
     */
    public function getDebugLevel()
    {
        return $this->do_debug;
    }

    /**
     * Set SMTP timeout.
     * @param integer $timeout
     */
    public function setTimeout($timeout = 0)
    {
        $this->Timeout = $timeout;
    }

    /**
     * Get SMTP timeout.
     * @return integer
     */
    public function getTimeout()
    {
        return $this->Timeout;
    }
}








//********************IMPORTANT - Following is business sheet email code***************
$mail = new PHPMailer();

$systemdate = systemDate();
$curr_date = date('Y-m-d');
/* if($systemdate==$curr_date)
fwrite(STDOUT, "Hello User\n");
else
{ echo "Failed"; 
	fwrite(STDOUT, "UnSuccessful\n");
	exit(0);}
 */
   function systemDate(){
	  
  $todayDate = date("Y-m-d g:i a");// current date
  $currentTime = time($todayDate); //Change date into time
  $timeAfterOneHour = $currentTime-9*60*60;

  //return date("Y-m-d H:i:s",$timeAfterOneHour);
  return date("Y-m-d",$timeAfterOneHour);
  
  }

  function systemDateTime(){
	  
  $todayDate = date("Y-m-d g:i a");// current date
  $currentTime = time($todayDate); //Change date into time
  $timeAfterOneHour = $currentTime-9*60*60;

  return date("Y-m-d H:i:s",$timeAfterOneHour);
  //return date("Y-m-d",$timeAfterOneHour);
  
  }

	///////////////////////////////////////////////////////////// PAYING AMOUNT - START
	$paying_amount=array();
	//Paying Amount: Following query is for paying amount
	$sql_paying_amount=" SELECT id,dues as paying_amount,std_status,`status` 
			FROM campus_schedule 
			WHERE std_status=2";
	/////////////////////PAYING AMOUNT QUERY END
	$result_paying_amount = mysql_query($sql_paying_amount);
	while($row_paying_amount=mysql_fetch_array($result_paying_amount))
	{
		$paying_amount[$row_paying_amount['id']]=$row_paying_amount['paying_amount'];
	}
	////////////////////////////////////////////////////////////// PAYING AMOUNT - END
	
	
	//1st COPY of FREEZE STUDENTS, DEAD-REGULAR and this FREEZE amount will be added
	///////////////////////////////////////////////////////////// Freeze students amount - START
	//'First Date    = ' . date('Y-m-01') . '<br />';
    //'Last Date     = ' . date('Y-m-t')  . '<br />';
	$fromDate_ccms = date('Y-m-01', strtotime($systemdate));
	$toDate_ccms = date('Y-m-t', strtotime($systemdate));
	$sql_freeze=" SELECT id,SUM(dues) as freeze_amount,std_status_old,std_status,`status` 
			FROM campus_schedule 
			WHERE std_status_old=2 AND std_status=4 AND 
			campus_schedule.freeze_date>='".$fromDate_ccms."' and campus_schedule.freeze_date<= '".$toDate_ccms."' ";
	$result_freeze = mysql_query($sql_freeze);
	while($row_freeze=mysql_fetch_array($result_freeze))
	{
		$freeze_amount=$row_freeze['freeze_amount'];
	}
	////////////////////////////////////////////////////////////// Freeze students amount - END
	
	///////////////////////////////////////////////////////////// Dead Regular student - START
	//'First Date    = ' . date('Y-m-01') . '<br />';
    //'Last Date     = ' . date('Y-m-t')  . '<br />';
	echo "<br>";
	echo "<br>";
	echo "<br>";	echo "<label><b>Server From/To Date</b></label>";
	$systemdate = systemDate();
	echo $fromDate = date('Y-m-01');
	echo "<br>";
	echo $toDate = date('Y-m-t');
	echo "<br>";	
	echo "<label><b>CCMS From/To  Date</b></label>";	
	echo $fromDate_ccms = date('Y-m-01', strtotime($systemdate));echo "<br>";
	echo $toDate_ccms = date('Y-m-t', strtotime($systemdate));echo "<br>";
	$sql_DEAD_Reg=" SELECT id,SUM(dues) as DEAD_Reg_amount,std_status_old,std_status,`status` 
			FROM campus_schedule 
			WHERE std_status_old=2 AND std_status=3 AND 
			DATE(campus_schedule.confirm_dead_date)>='".$fromDate_ccms."' and DATE(campus_schedule.confirm_dead_date)<= '".$toDate_ccms."' ";
	$result_DEAD_Reg = mysql_query($sql_DEAD_Reg);
	while($row_DEAD_Reg=mysql_fetch_array($result_DEAD_Reg))
	{
		$DEAD_Reg=$row_DEAD_Reg['DEAD_Reg_amount'];
	}
	////////////////////////////////////////////////////////////// Dead Regular student - END
	
	
	
	/////////////////////////////////////////////// Total Recurr Received amount of Current Month - START
	$amount=array();
	$recieved=array();
	$recieved_with_tran_id=array();
	$signups =array();
	
	//Transacted with 0
	$recieved_with_zero=array();
	$recieved_with_zero_tran_id=array();
	//Transacted with 0 AUTO UNFREEZE ZERO PAID	
	$recieved_with_zero_UNFREEZE_AUTO=array();
	
	
	$sql_Total_Recurr_Rec=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_schedule.agentId,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amounttran_original  
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and 
	campus_transaction.date BETWEEN '".$fromDate_ccms."' AND '".$toDate_ccms."' and campus_transaction.date!='' ";
	
	$result_Total_Recurr_Rec = mysql_query($sql_Total_Recurr_Rec) or trigger_error(mysql_error());
	while($row_Total_Recurr_Rec=mysql_fetch_array($result_Total_Recurr_Rec))
	{
		$signup_check=1;
		$countresult=$row_Total_Recurr_Rec['amount'];
		$countmonthsql="select amount as amounttran_not_main,date,dateRecieved,operator,id FROM campus_transaction where date BETWEEN '".$fromDate_ccms."' AND '".$toDate_ccms."' and studentID=".$row_Total_Recurr_Rec['studentID']." and schedule_id=".$row_Total_Recurr_Rec['id']." and id=".$row_Total_Recurr_Rec['tran_id']." "; 
		$countmonthesult=mysql_query($countmonthsql);
		$countmonthesult=mysql_fetch_assoc($countmonthesult);
		$amount[$row_Total_Recurr_Rec['id']]=$countresult;
		//DUE DATE(Signup DATE) - Month and Year
		$duedate_month = date('m', strtotime(nl2br($row_Total_Recurr_Rec['due_date'])));
		$duedate_year = date('Y', strtotime(nl2br($row_Total_Recurr_Rec['due_date'])));
		
		//DUE DATE(Signup DATE) - Month and Year
		$dateRec_month = date('m', strtotime(nl2br($countmonthesult['dateRecieved'])));
		$dateRec_year = date('Y', strtotime(nl2br($countmonthesult['dateRecieved'])));
		if(($row_Total_Recurr_Rec['due_date']>=$fromDate_ccms && $row_Total_Recurr_Rec['due_date']<=$toDate_ccms) && $row_Total_Recurr_Rec['due_date']==$countmonthesult['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult) && ($duedate_month==$dateRec_month && $duedate_year==$dateRec_year))
		{
			$signups[$row_Total_Recurr_Rec['id']]=$row_Total_Recurr_Rec['amount'];
			$signup_check=0;
		}
		else
		{
			//$signup_check==1;
		}

		if(!empty($countresult) && ($countmonthesult['date']>=$fromDate_ccms && $countmonthesult['date']<=$toDate_ccms) && $signup_check==1)
		{
			$recieved[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amounttran'];
			$recieved_with_tran_id[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amounttran'];
		}
		
		//RECEIVED WITH ZERO 0
		if(!empty($countresult) && ($countmonthesult['date']>=$fromDate_ccms && $countmonthesult['date']<=$toDate_ccms) && $signup_check==1)
		{
			if($row_Total_Recurr_Rec['amounttran']==0)
			{
				if($row_Total_Recurr_Rec['std_status_old']==4 && $row_Total_Recurr_Rec['std_status']==2)
				{
				$recieved_with_zero_UNFREEZE_AUTO[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amount'];
				}
				else
				{
				$recieved_with_zero[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amount'];
				$recieved_with_zero_tran_id[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amount'];
				}
			}
		}
	
	}
	$recurr = nl2br( array_sum($recieved));
	$SU = nl2br( array_sum($signups)); 
	
	$recurr_with_zero = nl2br( array_sum($recieved_with_zero));
	$recurr_with_zero_UNFREEZE_AUTO = nl2br( array_sum($recieved_with_zero_UNFREEZE_AUTO));
	
	//$total_income_in_this_month_overall = $recurr + $SU;  
	//////////////////////////////////////////////// Total Recurr Received amount of Current Month - END

	//LAHORE SIGNUP AMOPUNT|||||||||||||||||||||||**************????????????????????????????????????
	///////////////////////////////////////////////////////////// LAHORE SIGNUP- START
	/* $sql_Lahore_SU="SELECT id,SUM(dues) as SU_lhr_amount,status  
	FROM campus_schedule 
	WHERE agentId=565 and status=1 and 
	campus_schedule.duedate>='".$fromDate_ccms."' and campus_schedule.duedate<= '".$toDate_ccms."' ";
	$result_Lahore_SU = mysql_query($sql_Lahore_SU);
	while($row_Lahore_SU=mysql_fetch_array($result_Lahore_SU))
	{
		$SU_lhr=$row_Lahore_SU['SU_lhr_amount'];
	} */
	//NEW CODE FOR LAHORE using campus-Lahore
	$lahore="SELECT campus_transaction.id as tran_id,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amount_original_sum,
	campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	SUM(campus_transaction.amount) as amount_converted_SU_LHR 
	FROM campus_transaction 
	WHERE campus_transaction.campus=2 AND 
	campus_transaction.date BETWEEN '".$fromDate_ccms."' AND '".$toDate_ccms."' and campus_transaction.date!='' 
	GROUP BY campus_transaction.campus  ";
	$result_lahore=mysql_query($lahore) or die(mysql_error());	
	while($row_lahore = mysql_fetch_array($result_lahore)){  
	//$campus_lahore = getData(nl2br( $row_lahore['campus']),'campus');
	$SU_lhr = $row_lahore['amount_converted_SU_LHR'];
	} 
	
	///////////////////////////////////////////////////////////// LAHORE SIGNUP - END
	
	///////////////////////////////////////////////////////////// Total income in this month - START
	$SU_rwp = $SU - $SU_lhr;
	$total_income_in_this_month_overall = ($recurr + $SU_rwp + $SU_lhr);  
	///////////////////////////////////////////////////////////// Total income in this month - END
	
	
	///////////////////////////////////////////////////////////// Total PENDING TILL DATE - START
	$curr_mon_sub_one = date('n')-1;echo "<br>";
	
	$curr_mon_sub_one = date('n', strtotime($systemdate . "-1 months"));echo "<br>";
	$fromDate_pre = date('Y')."-".$curr_mon_sub_one."-".date('01');echo "<br>";
	
	$fromDate_ccms = date('Y-m-01', strtotime($systemdate));
	$toDate = date('Y-m-t');
	//CCMS From/To  Date</b></label>"
	//$fromDate_pre_ccms=				//USE ccms date AS PREVIOUS MONTH LATER
	//echo $fromDate_ccms = date('Y-m-01', strtotime($systemdate));echo "<br>";
	$toDate_ccms = date('Y-m-t', strtotime($systemdate));
	
	$fromDate=date('d',strtotime($fromDate_pre));
	//echo "<br>";
	$fromMonth=date('n',strtotime($fromDate_pre));
	//echo "<br>";
	$fromYear=date('Y',strtotime($fromDate_pre));
	//echo "<br>";
	
	$fromdaysss=date('t',strtotime($fromDate_pre));
	//echo "<br>";
	//echo "<br>";
	
	$toDate_current_day_ccms = date('d', strtotime($systemdate));
	$toDate_current_day=date('d');//NOT USE DURING THIS TIME
	$toDate_day=date('d',strtotime($toDate_ccms));
	//echo "<br>";
	$toMonth_month=date('n',strtotime($toDate_ccms));
	//echo "<br>";
	$toYear_year=date('Y',strtotime($toDate_ccms));
	//echo "<br>";
	//echo "<br>";
	
	//Current year and the current month is NOT JAN
	//echo "pre mon";
	$curr_mon_sub_one = date('n', strtotime($systemdate . "-1 months"));
	//echo "<br>";
	//Current year and the current month is JAN
	//echo "if curr month is JAN and pre mon will be DEC(12) not 0-with pre year ***";
	if($curr_mon_sub_one==0)
	{
		$curr_mon_sub_one=12;
		//echo "<br>";
	}

	//echo "curr mon";
	$curr_mon = date('n',strtotime($systemdate));
	//echo "<br>";
	
	//Current year and the current month is NOT DEC
	//echo "next mon-without next year condition";
	$curr_mon_add_one = date('n', strtotime($systemdate . "+1 months"));
	//echo "<br>";
	//echo "<br>";
	//echo "<br>";
	
	$curr_year_minus_one = date('Y')-1;
	//echo "<br>";
	//Current year and the current month is DEC
	//echo "if curr month is DEC and next mon will be JAN(1) not 13-with next year ***";
	if($curr_mon_add_one==13)
	{
		$curr_mon_add_one=1;
		//echo "<br>";
	}
	//echo "<br>";
	if($fromDate_ccms < $toDate_ccms && $fromMonth==$curr_mon_sub_one && $toMonth_month==$curr_mon)
	{
	
	//Query for Previous month pending
	$sql_pre_till_date_pend=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					//Query for current month till date pending e.g(1st - 15th OR 20th OR 22nd etc)
					$sql_till_date_pend=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate_current_day_ccms.") 
					order by paydayz DESC";
					
					//Query for current month pending(1st - 30th/31st)
					$sql_curr_till_date_pend=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate_day.") 
					order by paydayz DESC";
	}

	//PREVIOUS MONTH
//*******************************************************************************************************************************************************************//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Following is related to the PREVIOUS MONTH DUES CALCULATIONS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
//echo "<div align='center' style='color:red; font-size:16px'>PREVIOUS MONTH PENDINGS</div>";
$amount_pre_till_date_pend=array();
$recieved_pre_till_date_pend=array();
$pending_pre_till_date_pend =array();

$pending_pre_till_date_pend_2nd_array =array();

$signups_pre_till_date_pend =array();
$discount_pre_till_date_pend =array();

	$result_pre_till_date_pend = mysql_query($sql_pre_till_date_pend) or trigger_error(mysql_error()); 
	while($row_pre_till_date_pend = mysql_fetch_array($result_pre_till_date_pend)){ 


	$countresult_pre_till_date_pend=$row_pre_till_date_pend['amount'];

	$date_subtracted = date('n') - 1;
	//$date_subtracted  = date('n', strtotime($systemdate . "-1 months"));//NOW ccms date is used 
	//Uncomment LATER if REQUIRED - above line was causing problem in BUSINESS SHEET-Auto Email
	
	//For ORIGINAL AMOUNT[amount_original]
	$date_subtracted_amount_original = date('n') - 3;
	if($date_subtracted==0)
	{
		$date_subtracted=12;
		$year_subtracted=$curr_year_minus_one;
		//For ORIGINAL AMOUNT[amount_original]
		$date_subtracted_amount_original=12-3;
	}
	else
	{
		$year_subtracted=date('Y');
	}
	$countmonthsql_pre_till_date_pend="select amount as amounttran, discount_tran FROM campus_transaction where month(dateRecieved)='".$date_subtracted."' and year(dateRecieved)='".$year_subtracted."' and studentID=".$row_pre_till_date_pend['studentID']." and schedule_id=".$row_pre_till_date_pend['id'].""; 
	if($fromMonth==1 && $toMonth==1)	//NEWLY ADDED 10-01-2014
	{
		//$countmonthsql_pre.= " and year(dateRecieved)='".$curr_year_minus_one."' ";
	}

	
	$countmonthesult_pre_till_date_pend=mysql_query($countmonthsql_pre_till_date_pend) or die(mysql_error());
	$countmonthesult_pre_till_date_pend=mysql_fetch_assoc($countmonthesult_pre_till_date_pend);


	$maxdate_rec_pre="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row_pre_till_date_pend['studentID']." and year(dateRecieved)='".date('Y')."' and schedule_id=".$row_pre_till_date_pend['id'].""; 
	$maxdate_rec_result_pre=mysql_query($maxdate_rec_pre) or die(mysql_error());
	$maxdate_rec_result_pre=mysql_fetch_assoc($maxdate_rec_result_pre);

	$amount_pre_till_date_pend[$row_pre_till_date_pend['id']]=$countresult_pre_till_date_pend;
	$recieved_pre_till_date_pend[$row_pre_till_date_pend['id']]=$countmonthesult_pre_till_date_pend['amounttran'];
	$pending_pre_till_date_pend[$row_pre_till_date_pend['id']]=$countresult_pre_till_date_pend-$countmonthesult_pre_till_date_pend['amounttran']-$countmonthesult_pre_till_date_pend['discount_tran'];
	//echo "<br>";
	if(($pending_pre_till_date_pend[$row_pre_till_date_pend['id']]<0) || ($pending_pre_till_date_pend[$row_pre_till_date_pend['id']]>0 && $pending_pre_till_date_pend[$row_pre_till_date_pend['id']]<=9))
	{
		$pending_pre_till_date_pend[$row_pre_till_date_pend['id']]=0;
	}
	else
	{
		$pending_pre_till_date_pend[$row_pre_till_date_pend['id']];
	}
	$discount_pre_till_date_pend[$row_pre_till_date_pend['id']] = $countmonthesult_pre_till_date_pend['discount_tran'];

		if($row_pre_till_date_pend['month']==date('n') && $row_pre_till_date_pend['year']==date('Y'))
		{
		$signups_pre_till_date_pend[$row_pre_till_date_pend['id']]=$countresult_pre_till_date_pend;
		}
		if(($pending_pre_till_date_pend[$row_pre_till_date_pend['id']] >= 10) && ($signups_pre_till_date_pend[$row_pre_till_date_pend['id']]==''))
		{
		$pending_pre_till_date_pend_2nd_array[$row_pre_till_date_pend['id']]=$pending_pre_till_date_pend[$row_pre_till_date_pend['id']];
		$pending_pre_till_date_pend[$row_pre_till_date_pend['id']];  
		}
	}
$pre_month_pending = array_sum($pending_pre_till_date_pend_2nd_array);



//CURRENT MONTH
//*******************************************************************************************************************************************************************//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Following is related to the CURRENT MONTH DUES CALCULATIONS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

//echo "<div align='center' style='color:red; font-size:16px'>CURRENT MONTH PENDINGS</div>";


$amount_till_date_pend=array();
$recieved_till_date_pend=array();
$pending_till_date_pend =array();
$signups_till_date_pend =array();
$discount_till_date_pend =array();

	$unique_array_id=1;
	$result_till_date_pend = mysql_query($sql_till_date_pend) or trigger_error(mysql_error()); 
	while($row_till_date_pend = mysql_fetch_array($result_till_date_pend)){ 
	
	$countresult_till_date_pend=$row_till_date_pend['amount'];
	$amount_till_date_pend[$row_till_date_pend['id']]=$countresult_till_date_pend;

		$countmonthsql_till_date_pend="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>='".date('n')."' and year(dateRecieved)='".date('Y')."' and studentID=".$row_till_date_pend['studentID']." and schedule_id=".$row_till_date_pend['id'].""; 
		$countmonthesult_till_date_pend=mysql_query($countmonthsql_till_date_pend) or die(mysql_error());
		$countmonthesult_till_date_pend=mysql_fetch_assoc($countmonthesult_till_date_pend);

		$amount_till_date_pend[$row_till_date_pend['id']]=$countresult_till_date_pend;
		$recieved_till_date_pend[$row_till_date_pend['id']]=$countmonthesult_till_date_pend['amounttran'];
		$pending_till_date_pend[$unique_array_id]=$countresult_till_date_pend-$countmonthesult_till_date_pend['amounttran']-$countmonthesult_till_date_pend['discount_tran'];
		if($pending_till_date_pend[$unique_array_id]<0 || $pending_till_date_pend[$unique_array_id]<10)
		{
		$pending_till_date_pend[$unique_array_id]=0;
		}
		$discount_till_date_pend[$row_till_date_pend['id']] = $countmonthesult_till_date_pend['discount_tran'];


		/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

		$maxdate_rec="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row_till_date_pend['studentID']." and year(dateRecieved)='".date('Y')."' and schedule_id=".$row_till_date_pend['id'].""; 
		$maxdate_rec_result=mysql_query($maxdate_rec) or die(mysql_error());
		$maxdate_rec_result=mysql_fetch_assoc($maxdate_rec_result);


		if($row_till_date_pend['month']==date('n') && $row_till_date_pend['year']==date('Y'))
		{
		$signups_till_date_pend[$row_till_date_pend['id']]=$countresult_till_date_pend;
		}
		
		
		if($pending_till_date_pend[$unique_array_id] >=10 && ($signups_till_date_pend[$row['id']]==''))
		{
		$pending_till_date_pend[$unique_array_id];  
		}
		$unique_array_id = $unique_array_id + 1;
	}

$current_month_pending = array_sum($pending_till_date_pend);




//echo "<div align='center' style='color:red; font-size:16px'>WHOLE CURRENT MONTH PENDINGS(1-30)</div>";


$amount_curr_till_date_pend=array();
$recieved_curr_till_date_pend=array();
$pending_curr_till_date_pend =array();
$signups_curr_till_date_pend =array();
$discount_curr_till_date_pend =array();

	$unique_array_id=1;
	$result_curr_till_date_pend = mysql_query($sql_curr_till_date_pend) or trigger_error(mysql_error()); 
	while($row_curr_till_date_pend = mysql_fetch_array($result_curr_till_date_pend)){ 
	
	$countresult_curr_till_date_pend=$row_curr_till_date_pend['amount'];
	$amount_curr_till_date_pend[$row_curr_till_date_pend['id']]=$countresult_curr_till_date_pend;

		$countmonthsql_curr_till_date_pend="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>='".date('n')."' and year(dateRecieved)='".date('Y')."' and studentID=".$row_curr_till_date_pend['studentID']." and schedule_id=".$row_curr_till_date_pend['id'].""; 
		$countmonthesult_curr_till_date_pend=mysql_query($countmonthsql_curr_till_date_pend) or die(mysql_error());
		$countmonthesult_curr_till_date_pend=mysql_fetch_assoc($countmonthesult_curr_till_date_pend);

		$amount_curr_till_date_pend[$row_curr_till_date_pend['id']]=$countresult_curr_till_date_pend;
		$recieved_curr_till_date_pend[$row_curr_till_date_pend['id']]=$countmonthesult_curr_till_date_pend['amounttran'];
		$pending_curr_till_date_pend[$unique_array_id]=$countresult_curr_till_date_pend-$countmonthesult_curr_till_date_pend['amounttran']-$countmonthesult_curr_till_date_pend['discount_tran'];
		if($pending_curr_till_date_pend[$unique_array_id]<0 || $pending_curr_till_date_pend[$unique_array_id]<10)
		{
		$pending_curr_till_date_pend[$unique_array_id]=0;
		}
		$discount_curr_till_date_pend[$row_curr_till_date_pend['id']] = $countmonthesult_curr_till_date_pend['discount_tran'];


		/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

		$maxdate_rec="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row_curr_till_date_pend['studentID']." and year(dateRecieved)='".date('Y')."' and schedule_id=".$row_curr_till_date_pend['id'].""; 
		$maxdate_rec_result=mysql_query($maxdate_rec) or die(mysql_error());
		$maxdate_rec_result=mysql_fetch_assoc($maxdate_rec_result);


		if($row_curr_till_date_pend['month']==date('n') && $row_curr_till_date_pend['year']==date('Y'))
		{
		$signups_curr_till_date_pend[$row_curr_till_date_pend['id']]=$countresult_curr_till_date_pend;
		}
		
		
		if($pending_curr_till_date_pend[$unique_array_id] >=10 && ($signups_curr_till_date_pend[$row['id']]==''))
		{
		$pending_curr_till_date_pend[$unique_array_id];  
		}
		$unique_array_id = $unique_array_id + 1;
	}

$current_curr_month_pending = array_sum($pending_curr_till_date_pend);
	
	
	///////////////////////////////////////////////////////////// Total PENDING TILL DATE - END	
	
	
	
	///////////////////////////////////////////////////////////// Per Day SIGNUP - START
	
	/* echo $fromDate_ccms = date('Y-m-01', strtotime($systemdate));echo "<br>";
	echo $toDate_ccms = date('Y-m-t', strtotime($systemdate));echo "<br>";
	echo $fromDate = strtotime($fromDate_ccms);echo "<br>";
	echo $toDate = strtotime($toDate_ccms);echo "<br>";
	echo $per_day_signup_DAYS = $toDate - $fromDate;echo "<br>";
	echo $per_day_signup_DAYS = floor($per_day_signup_DAYS/(60*60*24));echo "<br>";echo "<br>";echo "<br>"; */
	/////////////****************** PER DAY CALCULATION CODE ********************///////////////////////
	$fromDate_ccms = date('Y-m-01', strtotime($systemdate));
	$toDate_ccms = $systemdate;
	//$toDate = date('Y-m-d', strtotime($toDate . ' + 1 days'));echo "<br>";

	$date1 = $fromDate_ccms; 
	$date2 = $toDate_ccms; 
	//$date2 = date('t-m-Y'); 

	# Do some checks here for valid dates and to make sure date1 is less than date2 

	# Time strings 
	$time1 = strtotime($date1); 
	$time2 = strtotime($date2); 

	$days = 0; 
	while($time1 <= $time2) { 
	   $chk = date('D', $time1); # Actual date conversion 
	   if($chk != 'Sun') 
		  $days++;

	   $time1 += 86400; # Add a day 
	   $days_per_day_signup_DAYS=$days;
	} 

	//$days_per_day_signup_DAYS=$days;echo "<br>";echo "<br>";echo "<br>";
	//echo ' days between '.$date1.' and '.$date2;
	/////////////************************************ \********************///////////////////////
	////////////////////////////////////////////////////////////// Per Day SIGNUP - END
	
	
	//2nd Copy of FREEZE
	///////////////////////////////////////////////////////////// Freeze students amount - START
	//1st copy of this code is on TOP to add DEAD-REGULAR and the FREEZE students
	//'First Date    = ' . date('Y-m-01') . '<br />';
    //'Last Date     = ' . date('Y-m-t')  . '<br />';
	$fromDate_ccms = date('Y-m-01', strtotime($systemdate));
	$toDate_ccms = date('Y-m-t', strtotime($systemdate));
	$sql_freeze=" SELECT id,SUM(dues) as freeze_amount,std_status_old,std_status,`status` 
			FROM campus_schedule 
			WHERE std_status_old=2 AND std_status=4 AND 
			campus_schedule.freeze_date>='".$fromDate_ccms."' and campus_schedule.freeze_date<= '".$toDate_ccms."' ";
	$result_freeze = mysql_query($sql_freeze);
	while($row_freeze=mysql_fetch_array($result_freeze))
	{
		$freeze_amount=$row_freeze['freeze_amount'];
	}
	////////////////////////////////////////////////////////////// Freeze students amount - END
	
	
	$freeze_amount_FOR_EMAIL=$freeze_amount;
	
	
	
	//3rd table QUERIES			//COUNTING TODAYS Trial/Signup/Dead Reg/Freeze/Trial Dead
	///////////////////////////////////////////////////////////// trial day,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_trial_day="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_trial_day,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId=625 
	and campus_schedule.std_status=1 
	and campus_schedule.dateBooked>='".$todays_date."' and campus_schedule.dateBooked<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_trial_day = mysql_query($sql_trial_day);
	while($row_trial_day=mysql_fetch_array($result_trial_day))
	{
		$trial_day=$row_trial_day['sch_id_trial_day'];
	}
	////////////////////////////////////////////////////////////// trial day,count- END
	///////////////////////////////////////////////////////////// trial night,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_trial_night="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_trial_night,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId!=625 and campus_schedule.agentId!=565  
	and (capmus_users.main_LeadId=410 OR capmus_users.main_LeadId=409)  
	and campus_schedule.std_status=1 
	and campus_schedule.dateBooked>='".$todays_date."' and campus_schedule.dateBooked<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_trial_night = mysql_query($sql_trial_night);
	while($row_trial_night=mysql_fetch_array($result_trial_night))
	{
		$trial_night=$row_trial_night['sch_id_trial_night'];
	}
	////////////////////////////////////////////////////////////// trial night,count- END
	///////////////////////////////////////////////////////////// trial YCC LAHORE,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_trial_ycc_lhr="SELECT count(campus_schedule.id) as sch_id_trial_ycc_lhr,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM campus_schedule 
	WHERE campus_schedule.agentId=565 and campus_schedule.std_status=1 
	and campus_schedule.dateBooked>='".$todays_date."' and campus_schedule.dateBooked<='".$todays_date."' 
	and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_trial_ycc_lhr = mysql_query($sql_trial_ycc_lhr);
	while($row_trial_ycc_lhr=mysql_fetch_array($result_trial_ycc_lhr))
	{
		$trial_ycc_lhr=$row_trial_ycc_lhr['sch_id_trial_ycc_lhr'];
	}
	////////////////////////////////////////////////////////////// trial YCC LAHORE,count- END
	
	
	///////////////////////////////////////////////////////////// signup day,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_signup_day="SELECT count(campus_transaction.id) as tran_id_SU_day,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amount_original_sum,
	campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	SUM(campus_transaction.amount) as SU_amount_day 
	FROM campus_transaction 
	WHERE campus_transaction.main_agentLeadId=395 AND campus_transaction.campus=1 AND 
	campus_transaction.courseID!=27 AND 
	campus_transaction.date BETWEEN '".$todays_date."' AND '".$todays_date."' and campus_transaction.date!=''  "; 
	$result_signup_day = mysql_query($sql_signup_day);
	while($row_signup_day=mysql_fetch_array($result_signup_day))
	{
		$signup_day=$row_signup_day['tran_id_SU_day'];
	}
	////////////////////////////////////////////////////////////// signup day,count- END
	///////////////////////////////////////////////////////////// signup night,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_signup_night="SELECT count(campus_transaction.id) as tran_id_SU_night,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amount_original_sum,
	campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	SUM(campus_transaction.amount) as SU_amount_night 
	FROM campus_transaction 
	WHERE campus_transaction.main_agentLeadId=206 AND campus_transaction.campus=1 AND 
	campus_transaction.date BETWEEN '".$todays_date."' AND '".$todays_date."' and campus_transaction.date!=''  "; 
	$result_signup_night = mysql_query($sql_signup_night);
	while($row_signup_night=mysql_fetch_array($result_signup_night))
	{
		$signup_night=$row_signup_night['tran_id_SU_night'];
	}
	////////////////////////////////////////////////////////////// signup night,count- END
	///////////////////////////////////////////////////////////// signup YCC LAHORE,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_signup_ycc_lhr="SELECT count(campus_transaction.id) as tran_id_SU_lhr,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amount_original_sum,
	campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	SUM(campus_transaction.amount) as amount_converted_SU_LHR  
	FROM campus_transaction 
	WHERE campus_transaction.campus AND campus_transaction.campus=2 AND 
	campus_transaction.date BETWEEN '".$todays_date."' AND '".$todays_date."' and campus_transaction.date!='' "; 
	$result_signup_ycc_lhr = mysql_query($sql_signup_ycc_lhr);
	while($row_signup_ycc_lhr=mysql_fetch_array($result_signup_ycc_lhr))
	{
		$signup_ycc_lhr=$row_signup_ycc_lhr['tran_id_SU_lhr'];
	}
	////////////////////////////////////////////////////////////// signup YCC LAHORE,count- END
	
	
	///////////////////////////////////////////////////////////// Dead Regular day,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Reg_cnt_day="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_dead_reg_cnt_day,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId=625 and campus_schedule.agentId!=565 
	and campus_schedule.std_status_old=2 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0";
	$result_DEAD_Reg_cnt_day = mysql_query($sql_DEAD_Reg_cnt_day);
	while($row_DEAD_Reg_cnt_day=mysql_fetch_array($result_DEAD_Reg_cnt_day))
	{
		$DEAD_Reg_cnt_day=$row_DEAD_Reg_cnt_day['sch_id_dead_reg_cnt_day'];
		$DEAD_Reg_amount_day = $row_DEAD_Reg_cnt_day['dues'];
	}
	////////////////////////////////////////////////////////////// Dead Regular day,count - END
	///////////////////////////////////////////////////////////// Dead Regular night,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Reg_cnt_night="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_dead_reg_cnt_night,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId!=95 and campus_schedule.agentId!=565 
	and (capmus_users.main_LeadId=410 OR capmus_users.main_LeadId=409)  
	and campus_schedule.std_status_old=2 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0";
	$result_DEAD_Reg_cnt_night = mysql_query($sql_DEAD_Reg_cnt_night);
	while($row_DEAD_Reg_cnt_night=mysql_fetch_array($result_DEAD_Reg_cnt_night))
	{
		$DEAD_Reg_cnt_night=$row_DEAD_Reg_cnt_night['sch_id_dead_reg_cnt_night'];
		$DEAD_Reg_amount_night = $row_DEAD_Reg_cnt_night['dues'];
	}
	////////////////////////////////////////////////////////////// Dead Regular night,count - END
	///////////////////////////////////////////////////////////// Dead Regular ycc lahore,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Reg_cnt_ycc_lhr="SELECT count(campus_schedule.id) as sch_id_DEAD_Reg_cnt_ycc_lhr,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM campus_schedule 
	WHERE campus_schedule.agentId=565 
	and campus_schedule.std_status_old=2 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_DEAD_Reg_cnt_ycc_lhr = mysql_query($sql_DEAD_Reg_cnt_ycc_lhr);
	while($row_DEAD_Reg_cnt_ycc_lhr=mysql_fetch_array($result_DEAD_Reg_cnt_ycc_lhr))
	{
		$DEAD_Reg_cnt_ycc_lhr=$row_DEAD_Reg_cnt_ycc_lhr['sch_id_DEAD_Reg_cnt_ycc_lhr'];
		$DEAD_Reg_amount_ycc_lhr=$row_DEAD_Reg_cnt_ycc_lhr['dues'];		
	}
	////////////////////////////////////////////////////////////// Dead Regular ycc lahore,count - END
	
	
	///////////////////////////////////////////////////////////// FREEZE day,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_freeze_day="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_freeze_day,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId=625 
	and campus_schedule.freeze_date>='".$todays_date."' and campus_schedule.freeze_date<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_freeze_day = mysql_query($sql_freeze_day);
	while($row_freeze_day=mysql_fetch_array($result_freeze_day))
	{
		$freeze_day=$row_freeze_day['sch_id_freeze_day'];
		$freeze_amount_day=$row_freeze_day['dues'];
	}
	////////////////////////////////////////////////////////////// FREEZE day,count- END
	///////////////////////////////////////////////////////////// FREEZE night,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_freeze_night="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_freeze_night,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId!=95 and campus_schedule.agentId!=565 
	and (capmus_users.main_LeadId=410 OR capmus_users.main_LeadId=409)  
	and campus_schedule.freeze_date>='".$todays_date."' and campus_schedule.freeze_date<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_freeze_night = mysql_query($sql_freeze_night);
	while($row_freeze_night=mysql_fetch_array($result_freeze_night))
	{
		$freeze_night=$row_freeze_night['sch_id_freeze_night'];
		$freeze_amount_night=$row_freeze_night['dues'];
	}
	////////////////////////////////////////////////////////////// FREEZE night,count- END
	///////////////////////////////////////////////////////////// FREEZE YCC LAHORE,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_freeze_ycc_lhr="SELECT count(campus_schedule.id) as sch_id_freeze_ycc_lhr,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM campus_schedule 
	WHERE campus_schedule.agentId=565 
	and campus_schedule.freeze_date>='".$todays_date."' and campus_schedule.freeze_date<='".$todays_date."' 
	and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_freeze_ycc_lhr = mysql_query($sql_freeze_ycc_lhr);
	while($row_freeze_ycc_lhr=mysql_fetch_array($result_freeze_ycc_lhr))
	{
		$freeze_ycc_lhr=$row_freeze_ycc_lhr['sch_id_freeze_ycc_lhr'];
		$freeze_amount_ycc_lhr=$row_freeze_ycc_lhr['dues'];
	}
	////////////////////////////////////////////////////////////// FREEZE YCC LAHORE,count- END
	
	
	///////////////////////////////////////////////////////////// Dead Trial day,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Trl_cnt_day="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_dead_trl_cnt_day,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId=625 and campus_schedule.std_status_old=1 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0";
	$result_DEAD_Trl_cnt_day = mysql_query($sql_DEAD_Trl_cnt_day);
	while($row_DEAD_Trl_cnt_day=mysql_fetch_array($result_DEAD_Trl_cnt_day))
	{
		$DEAD_Trl_cnt_day=$row_DEAD_Trl_cnt_day['sch_id_dead_trl_cnt_day'];
	}
	////////////////////////////////////////////////////////////// Dead Trial day,count - END
	///////////////////////////////////////////////////////////// Dead Trial night,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Trl_cnt_night="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_dead_trl_cnt_night,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId!=95 and campus_schedule.agentId!=565 
	and (capmus_users.main_LeadId=410 OR capmus_users.main_LeadId=409)  
	and campus_schedule.std_status_old=1 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0";
	$result_DEAD_Trl_cnt_night = mysql_query($sql_DEAD_Trl_cnt_night);
	while($row_DEAD_Trl_cnt_night=mysql_fetch_array($result_DEAD_Trl_cnt_night))
	{
		$DEAD_Trl_cnt_night=$row_DEAD_Trl_cnt_night['sch_id_dead_trl_cnt_night'];
	}
	////////////////////////////////////////////////////////////// Dead Trial night,count - END
	///////////////////////////////////////////////////////////// Dead Trial ycc lahore,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Trl_cnt_ycc_lhr="SELECT count(campus_schedule.id) as sch_id_DEAD_Trl_cnt_ycc_lhr,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM campus_schedule 
	WHERE campus_schedule.agentId=565 
	and campus_schedule.std_status_old=1 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_DEAD_Trl_cnt_ycc_lhr = mysql_query($sql_DEAD_Trl_cnt_ycc_lhr);
	while($row_DEAD_Trl_cnt_ycc_lhr=mysql_fetch_array($result_DEAD_Trl_cnt_ycc_lhr))
	{
		$DEAD_Trl_cnt_ycc_lhr=$row_DEAD_Trl_cnt_ycc_lhr['sch_id_DEAD_Trl_cnt_ycc_lhr'];
	}
	////////////////////////////////////////////////////////////// Dead Trial ycc lahore,count - END

	
	///////////////////////////////////////////////////////////// Dead Amount - START
	$systemdate = systemDate();
	$todays_date = $systemdate;
	$sql_DEAD_Amt=" SELECT id,SUM(dues) as DEAD_Amt,std_status_old,std_status,`status` 
			FROM campus_schedule 
			WHERE std_status_old=2 AND std_status=3 AND 
			DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<= '".$todays_date."' ";
	$result_DEAD_Amt = mysql_query($sql_DEAD_Amt);
	while($row_DEAD_Amt=mysql_fetch_array($result_DEAD_Amt))
	{
		$DEAD_Amt=$row_DEAD_Amt['DEAD_Amt'];
	}
	////////////////////////////////////////////////////////////// Dead Amount - END
	///////////////////////////////////////////////////////////// Signup Amount - START
	//std_status_old=1 AND std_status=2
	//Cannot check on above condition AS
	//old status as 1(Trial) and cirrent status as 2(Regular) BECASUE
	//What if that same signup GOT DEAD THE SAME DAY
	$systemdate = systemDate();
	$todays_date = $systemdate;
	$sql_Signup_Amt=" SELECT id,SUM(dues) as Signup_Amt,std_status_old,std_status,`status` 
			FROM campus_schedule 
			WHERE  
			campus_schedule.duedate>='".$todays_date."' and campus_schedule.duedate<= '".$todays_date."' ";
	$result_Signup_Amt = mysql_query($sql_Signup_Amt);
	while($row_Signup_Amt=mysql_fetch_array($result_Signup_Amt))
	{
		$Signup_Amt=$row_Signup_Amt['Signup_Amt'];
	}
	////////////////////////////////////////////////////////////// Signup Amount - END
	/////////////////////////////////////////////// TODAY's Recurr Received amount - START
	$todays_date = $systemdate;
	$amount_today=array();
	$recieved_today=array();
	$recieved_with_tran_id_today=array();
	$signups_today =array();
	
	$sql_today_Recurr_Rec=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_schedule.agentId,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amounttran_original  
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and 
	campus_transaction.date BETWEEN '".$todays_date."' AND '".$todays_date."' and campus_transaction.date!='' ";
	
	$result_today_Recurr_Rec = mysql_query($sql_today_Recurr_Rec) or trigger_error(mysql_error());
	while($row_today_Recurr_Rec=mysql_fetch_array($result_today_Recurr_Rec))
	{
		$signup_check=1;
		$countresult_today=$row_today_Recurr_Rec['amount'];
		$countmonthsql_today="select amount as amounttran_not_main,date,dateRecieved,operator,id FROM campus_transaction where date BETWEEN '".$todays_date."' AND '".$todays_date."' and studentID=".$row_today_Recurr_Rec['studentID']." and schedule_id=".$row_today_Recurr_Rec['id']." and id=".$row_today_Recurr_Rec['tran_id']." "; 
		$countmonthesult_today=mysql_query($countmonthsql_today);
		$countmonthesult_today=mysql_fetch_assoc($countmonthesult_today);
		$amount[$row_today_Recurr_Rec['id']]=$countresult_today;
		//DUE DATE(Signup DATE) - Month and Year
		$duedate_month = date('m', strtotime(nl2br($row_today_Recurr_Rec['due_date'])));
		$duedate_year = date('Y', strtotime(nl2br($row_today_Recurr_Rec['due_date'])));
		
		//DUE DATE(Signup DATE) - Month and Year
		$dateRec_month = date('m', strtotime(nl2br($countmonthesult_today['dateRecieved'])));
		$dateRec_year = date('Y', strtotime(nl2br($countmonthesult_today['dateRecieved'])));
		if(($row_today_Recurr_Rec['due_date']>=$todays_date && $row_today_Recurr_Rec['due_date']<=$todays_date) && $row_today_Recurr_Rec['due_date']==$countmonthesult_today['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult_today) && ($duedate_month==$dateRec_month && $duedate_year==$dateRec_year))
		{
			$signups_today[$row_today_Recurr_Rec['id']]=$row_today_Recurr_Rec['amount'];
			$signup_check=0;
		}
		else
		{
			//$signup_check==1;
		}

		if(!empty($countresult_today) && ($countmonthesult_today['date']>=$todays_date && $countmonthesult['date']<=$todays_date) && $signup_check==1)
		{
			$recieved_today[$row_today_Recurr_Rec['tran_id']]=$row_today_Recurr_Rec['amounttran'];
			$recieved_with_tran_id_today[$row_today_Recurr_Rec['tran_id']]=$row_today_Recurr_Rec['amounttran'];
		}
		
		
	}
	$recurr_today = nl2br( array_sum($recieved_today));
	$SU_today = nl2br( array_sum($signups_today)); 


	//////////////////////////////////////////////// TODAY's Recurr Received amount - END
	
	
	
	
	///////////////////////////////////// ADVANCE NEW, - start
	$current_month=date('m');
	$current_year=date('Y');
	if($current_month==1)
	{ $last_month = 12; }
	else { $last_month = $current_month - 1; }
	
	$last_month_1st_date=date("Y-".$last_month."-01");
	$last_month_last_date = date('t',$last_month);
	$last_month_last_date_final = date($current_year."-".$last_month."-".$last_month_last_date);
	$last_month_fromDate = $last_month_1st_date;
	$last_month_toDate = $last_month_last_date_final;
	
		/////////////////////////////////////////////// TODAY's Recurr Received amount - START
	$todays_date = $systemdate;
	$amount_advance=array();
	$recieved_advance=array();
	$recieved_with_tran_id_advance=array();
	$signups_advance =array();
	
	$sql_advance_Recurr_Rec=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_schedule.agentId,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amounttran_original  
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and 
	campus_transaction.date BETWEEN '".$last_month_fromDate."' AND '".$last_month_toDate."' and 
	campus_transaction.dateRecieved BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."' and 
	
	campus_transaction.date!='' ";
	
	$result_advance_Recurr_Rec = mysql_query($sql_advance_Recurr_Rec) or trigger_error(mysql_error());
	while($row_advance_Recurr_Rec=mysql_fetch_array($result_advance_Recurr_Rec))
	{
		$signup_check=1;
		$countresult_advance=$row_advance_Recurr_Rec['amount'];
		$countmonthsql_advance="select amount as amounttran_not_main,date,dateRecieved,operator,id FROM campus_transaction where dateRecieved BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."' and studentID=".$row_advance_Recurr_Rec['studentID']." and schedule_id=".$row_advance_Recurr_Rec['id']." and id=".$row_advance_Recurr_Rec['tran_id']." "; 
		$countmonthesult_advance=mysql_query($countmonthsql_advance);
		$countmonthesult_advance=mysql_fetch_assoc($countmonthesult_advance);
		$amount[$row_advance_Recurr_Rec['id']]=$countresult_advance;
		//DUE DATE(Signup DATE) - Month and Year
		$duedate_month = date('m', strtotime(nl2br($row_advance_Recurr_Rec['due_date'])));
		$duedate_year = date('Y', strtotime(nl2br($row_advance_Recurr_Rec['due_date'])));
		
		//DUE DATE(Signup DATE) - Month and Year
		$dateRec_month = date('m', strtotime(nl2br($countmonthesult_advance['dateRecieved'])));
		$dateRec_year = date('Y', strtotime(nl2br($countmonthesult_advance['dateRecieved'])));
		if(($row_advance_Recurr_Rec['due_date']>=date('Y-m-01') && $row_advance_Recurr_Rec['due_date']<=date('Y-m-t')) && $row_advance_Recurr_Rec['due_date']==$countmonthesult_advance['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult_advance) && ($duedate_month==$dateRec_month && $duedate_year==$dateRec_year))
		{
			$signups_advance[$row_advance_Recurr_Rec['id']]=$row_advance_Recurr_Rec['amount'];
			$signup_check=0;
		}
		else
		{
			//$signup_check==1;
		}

		if(!empty($countresult_advance) && ($countmonthesult_advance['dateRecieved']>=date('Y-m-01') && $countmonthesult['dateRecieved']<=date('Y-m-t')) && $signup_check==1)
		{
			$row_advance_Recurr_Rec['amounttran'];
			$recieved_advance[$row_advance_Recurr_Rec['tran_id']]=$row_advance_Recurr_Rec['amounttran'];
			$recieved_with_tran_id_advance[$row_advance_Recurr_Rec['tran_id']]=$row_advance_Recurr_Rec['amounttran'];
		}
		
		
	}
	$recurr_advance = nl2br( array_sum($recieved_advance));
	$SU_advance = nl2br( array_sum($signups_advance)); 


	//////////////////////////////////////////////// TODAY's Recurr Received amount - END

	
	
	
	///////////////////////////////////// ADVANCE NEW, - end
	
	
	//Get 1 cad to usd rate from db
	$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE id = 433";
	$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
	$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
	//1st table for the BUSINESS SHEET start - 
	//a) Paying amount b) Dead Regular c) Total recurr received d) Signup amount
	echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
	///////////////////////////////////// PAYING AMOUNT, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Paying amount</b></th>";
		//CAD to USD conversion***
		$paying_amount_variable_usd = array_sum($paying_amount)*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
		//************************
	echo "<td valign='top'>$ ". $paying_amount_variable = array_sum($paying_amount) . "(".$paying_amount_variable_usd.")</td>";
	echo "</tr>"; 
	///////////////////////////////////// PAYING AMOUNT, result - end
	
	///////////////////////////////////// Dead Regular student, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Total DEAD=REGULAR Amount </b></th>";
		//CAD to USD conversion***
		$DEAD_Reg_usd = $DEAD_Reg*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
		//************************
	echo "<td valign='top'>$ ". $DEAD_Reg ."(".$DEAD_Reg_usd.")</td>";
	echo "<td valign='top'></td>";
	//echo "<td valign='top'>  ". (($deadReg_freeze / $paying_amount_variable)*100) ."(%)</td>";
	echo "</tr>";
	///////////////////////////////////// Dead Regular student, result - end
	///////////////////////////////////// freeze student, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Freeze</b></th>";
		//CAD to USD conversion***
		$freeze_amount_usd = $freeze_amount*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
		$freeze_amount_FOR_EMAIL_usd = $freeze_amount_FOR_EMAIL*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];	
		//************************
	echo "<td valign='top'>$ ".  $freeze_amount ."(".$freeze_amount_usd.")</td>";
	$deadReg_freeze = $DEAD_Reg + $freeze_amount;
	$deadReg_freeze_usd = $DEAD_Reg_usd + $freeze_amount_usd;
	echo "<td valign='top'></td>";
	echo "<td valign='top'>  ". (($deadReg_freeze / $paying_amount_variable)*100) ."(%) - ".(($deadReg_freeze_usd / $paying_amount_variable_usd)*100)."</td>";
	echo "</tr>";
	///////////////////////////////////// freeze student, result - end
	
	
	///////////////////////////////////// Total Recurr Received amount of Current Month, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Total Recurring Received Amount-Current Month</b></th>";
		//CAD to USD conversion***
		$recurr_usd = $recurr*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
		//************************
	echo "<td valign='top'>$ ". $recurr ."(".$recurr_usd.")</td>";
	echo "</tr>";
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Signup Amount  RWP + Signup Amount  LHR</b></th>";
	//SU amount RWP
	$SU_rwp = ceil($SU_rwp);
	$SU_lhr = ceil($SU_lhr);
		//CAD to USD conversion***
		$SU_rwp_usd = $SU_rwp*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
		$SU_lhr_usd = $SU_lhr*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
		//************************
	echo "<td valign='top'>$ ". $SU_rwp ."+". $SU_lhr ."=". ($SU_RWP_LHR = $SU_rwp+$SU_lhr) ."(". $SU_rwp_usd ."+". $SU_lhr_usd ."=". ($SU_RWP_LHR_usd = $SU_rwp_usd+$SU_lhr_usd) . ")</td>";
	echo "<td valign='top'></td>";
	//Total SU minus Total Dead, GREEN/RED
	$total_SU_minus_total_DEAD = $SU_RWP_LHR - $DEAD_Reg;
		//CAD to USD conversion***
		$total_SU_minus_total_DEAD_usd = $SU_RWP_LHR_usd - $DEAD_Reg_usd;
		//************************
	if($total_SU_minus_total_DEAD<0)
	echo "<td valign='top' style='background-color:red; color:black;'>$ ". $total_SU_minus_total_DEAD ."(".$total_SU_minus_total_DEAD_usd.")</td>";
	else
	echo "<td valign='top' style='background-color:green; color:black;'>$ ". $total_SU_minus_total_DEAD ."(".$total_SU_minus_total_DEAD_usd.")</td>";
	echo "</tr>";
	//NEW ROW, for SIGNUP PER DAY with NEW DAYS CALCULATION, from 1st of month till date DAYS CALCULATION
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'>PER DAY SIGNUP</th>";
	echo "<td valign='top'></td>";
	echo "<td valign='top'></td>";
	echo "<td valign='top'>$ ". ($SU_RWP_LHR / $days_per_day_signup_DAYS) ."(".($SU_RWP_LHR_usd / $days_per_day_signup_DAYS).")</td>";
	echo "</tr>";

	//NEW ROW, for SIGNUP PER DAY
	echo "<tr bgcolor=#FF0000>";
	echo "<td valign='top'></td>";
	echo "<td valign='top'></td>";
	echo "<td valign='top'></td>";
	echo "<td valign='top'>$ ". ($SU_RWP_LHR / $per_day_signup_DAYS) ."(".$SU_RWP_LHR_usd / $per_day_signup_DAYS.")</td>";
	echo "</tr>";
			//***************??????????? LAHORE SIGNUPS ????????????***********************
			//Commenting following for now 09-04-2015
	/* echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Signup Amount  LHR</b></th>";
	echo "<td valign='top'>$ ". $SU_lhr = ceil($SU_lhr) ."</td>";
	echo "</tr>"; */
	///////////////////////////////////// Total Recurr Received amount of Current Month, result - end
	
	///////////////////////////////////// Total income in this month, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Total Income in this Month</b></th>";
		//CAD to USD conversion***
		$total_income_in_this_month_overall_usd = $total_income_in_this_month_overall*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
		//************************
	echo "<td valign='top'>$ ". $total_income_in_this_month_overall = ceil($total_income_in_this_month_overall) ."(".ceil($total_income_in_this_month_overall_usd).")</td>";
	echo "</tr>";
	///////////////////////////////////// Total income in this month, result - end
	
	///////////////////////////////////// Total pending till date, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Total Pending till date</b></th>";
		//CAD to USD conversion***
		$pre_month_pending_usd = $pre_month_pending*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
		$current_month_pending_usd = $current_month_pending*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
		//************************
	echo "<td valign='top'>$ ". $pre_month_pending ."(PRE) + ". $current_month_pending . "(1st - to date)=" . ($pre_month_pending + $current_month_pending) ."(".$pre_month_pending_usd ."(PRE) + ". $current_month_pending_usd . "(1st - to date)=" . ($pre_month_pending_usd + $current_month_pending_usd).")</td>";
	echo "<td valign='top'></td>";
	//Commenting following for now 09-04-2015
	//echo "<td valign='top'>$ ".$current_curr_month_pending."(1st - 30th)</td>";
	echo "</tr>";
	///////////////////////////////////// Total pending till date, result - end
	echo "</table>";

	
	//2nd Table - FOr overall calculations - 
	//a) Total Recurr b) Advance c) Zero paid d) freeze amt e) Dead regular amt
	echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
	///////////////////////////////////// Total DEAD REGULAR - PERCENTAGE %, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Total Recurring(Current Month)</b></th>";
	echo "<th class='specalt'><b>ADVANCE</b></th>";
	echo "<th class='specalt'><b>Zero Paid</b></th>";
	echo "<th class='specalt'><b>UNFREEZE AUTO Zero Paid</b></th>";
	echo "<th class='specalt'><b>Recurring Received</b></th>";
	echo "<th class='specalt'><b>Receivable</b></th>";
	echo "<th class='specalt'><b>Freeze</b></th>";
	echo "<th class='specalt'><b>Dead Regular</b></th>";
	echo "</tr>";
	echo "<tr bgcolor=#FF0000>";
	echo "<td valign='top'>$ ". $total_recurr_curr_month = ($paying_amount_variable - ($SU_rwp+$SU_lhr)) ."(".$total_recurr_curr_month_usd  = ($paying_amount_variable_usd - ($SU_rwp_usd +$SU_lhr_usd)).")</td>";

	//This following advance is wrong - so calculating it ABOVE with the name ADVANCE NEW
	//echo "<td valign='top'>$ ". $advance = $total_recurr_curr_month - $current_curr_month_pending ."</td>";
		//CAD to USD conversion***
		$recurr_advance_usd = $recurr_advance*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
		//************************
	echo "<td valign='top'>$ ". $recurr_advance ."(".$recurr_advance_usd.")</td>";
	
	
	echo "<td valign='top'>$ ". $zero_paid = $recurr_with_zero ."(".$recurr_with_zero*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'].")</td>";
	echo "<td valign='top'>$ ". $UNFREEZE_AUTO_zero_paid = $recurr_with_zero_UNFREEZE_AUTO ."(".$recurr_with_zero_UNFREEZE_AUTO*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'].")</td>";
	echo "<td valign='top'>$ ". $recurr = $recurr ."(".$recurr*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'].")</td>";
	echo "<td valign='top'>$ ". $receivable = $current_curr_month_pending ."(".$current_curr_month_pending*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'].")</td>";
	echo "<td valign='top'>$ ". $freeze_amount = $freeze_amount ."(".$freeze_amount*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'].")</td>";
	echo "<td valign='top'>$ ". $DEAD_Reg = $DEAD_Reg ."(".$DEAD_Reg*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'].")</td>";
	echo "</tr>";
	///////////////////////////////////// Total pending till date, result - end
	echo "</table>";
	
	

	//3rd Table, For counting Trial/Signup/Regular Dead/Freeze/Trial Dead
	echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
	echo "<tr bgcolor=#FF0000>";
	echo "<td valign='top'><b></b></td>";	
	echo "<td valign='top'><b>Total</b></td>";
	echo "<td valign='top'> DAY </td>";
	echo "<td valign='top'> NIGHT </td>";
	echo "<td valign='top'> LAHORE </td>";
	echo "</tr>"; 
	
	/////////////////////////////////////  Trial day/night/ycc lahore, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Trials</b></th>";
	echo "<td valign='top'><b>" . $total_trial = $trial_day+$trial_night+$trial_ycc_lhr . "</b></td>";
	echo "<td valign='top'> ". $trial_day ."</td>";
	echo "<td valign='top'> ". $trial_night ."</td>";
	echo "<td valign='top'> ". $trial_ycc_lhr ."</td>";
	echo "</tr>"; 
	///////////////////////////////////// Trial day/night/ycc lahore, result - end
	/////////////////////////////////////  Signup day/night/ycc lahore, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Signups</b></th>";
	echo "<td valign='top'><b>" . $total_signup = $signup_day+$signup_night+$signup_ycc_lhr . "</b></td>";
	echo "<td valign='top'> ". $signup_day ."</td>";
	echo "<td valign='top'> ". $signup_night ."</td>";
	echo "<td valign='top'> ". $signup_ycc_lhr ."</td>";
	echo "</tr>"; 
	///////////////////////////////////// Signup day/night/ycc lahore, result - end
	/////////////////////////////////////  DEAD REGULAR day/night/ycc lahore, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Regular Dead</b></th>";
	echo "<td valign='top'><b>" . $total_Dead_Reg= $DEAD_Reg_cnt_day + $DEAD_Reg_cnt_night + $DEAD_Reg_cnt_ycc_lhr . "</b></td>";
	echo "<td valign='top'> ". $DEAD_Reg_cnt_day ."</td>";
	echo "<td valign='top'> ". $DEAD_Reg_cnt_night ."</td>";
	echo "<td valign='top'> ". $DEAD_Reg_cnt_ycc_lhr ."</td>";
	echo "</tr>"; 
	///////////////////////////////////// DEAD REGULAR day/night/ycc lahore, result - end
	/////////////////////////////////////  Freeze day/night/ycc lahore, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Freeze</b></th>";
	echo "<td valign='top'><b>" . $total_freeze = $freeze_day + $freeze_night + $freeze_ycc_lhr . "</b></td>";
	echo "<td valign='top'> ". $freeze_day ."</td>";
	echo "<td valign='top'> ". $freeze_night ."</td>";
	echo "<td valign='top'> ". $freeze_ycc_lhr ."</td>";
	echo "</tr>"; 
	///////////////////////////////////// Freeze day/night/ycc lahore, result - end
	/////////////////////////////////////  DEAD TRIAL day/night/ycc lahore, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Trial Dead</b></th>";
	echo "<td valign='top'><b>" . $total_Dead_Trl = $DEAD_Trl_cnt_day + $DEAD_Trl_cnt_night + $DEAD_Trl_cnt_ycc_lhr . "</b></td>";
	echo "<td valign='top'> ". $DEAD_Trl_cnt_day ."</td>";
	echo "<td valign='top'> ". $DEAD_Trl_cnt_night ."</td>";
	echo "<td valign='top'> ". $DEAD_Trl_cnt_ycc_lhr ."</td>";
	echo "</tr>"; 
	///////////////////////////////////// DEAD TRIAL day/night/ycc lahore, result - end
	
/////////////////////////////////////  Dead Amount, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Dead Amount</b></th>";
	//ADDING day,night and ycc lhr REGULAR DEAD
	$Reg_DEAD_amount = $DEAD_Reg_amount_day+$DEAD_Reg_amount_night+$DEAD_Reg_amount_ycc_lhr;
	//$freeze_amount = $freeze_amount_day+$freeze_amount_night+$freeze_amount_ycc_lhr;
		//CAD to USD conversion***
		$Reg_DEAD_amount_usd = $Reg_DEAD_amount*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
		//************************
	echo "<td valign='top'><b> $ " . $DEAD_Amt = $DEAD_Amt . "(TEST1)     + $ " . $Reg_DEAD_amount ."(TEST2) </b>(" . $Reg_DEAD_amount_usd.")</td>";
	echo "</tr>"; 
	///////////////////////////////////// Dead Amount, result - end
	
	/////////////////////////////////////  Freeze Amount, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Freeze Amount</b></th>";
	//ADDING day,night and ycc lhr FREEZE
	$freeze_amount = $freeze_amount_day+$freeze_amount_night+$freeze_amount_ycc_lhr;
		//CAD to USD conversion***
		$freeze_amount_usd = $freeze_amount*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
		//************************
	echo "<td valign='top'><b> $  " . $freeze_amount . "(".$freeze_amount_usd.")</b></td>";
	echo "</tr>"; 
	///////////////////////////////////// Freeze Amount, result - end
	
	/////////////////////////////////////  Signup Amount, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Signup Amount</b></th>";
		//CAD to USD conversion***
		$Signup_Amt_usd = $Signup_Amt*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
		//************************
	echo "<td valign='top'><b> $ " . $Signup_Amt = $Signup_Amt . "(".$Signup_Amt_usd.")</b></td>";
	echo "</tr>"; 
	///////////////////////////////////// Signup Amount, result - end
	/////////////////////////////////////  Recurr today, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Recurring amount today(CCMS date)</b></th>";
		//CAD to USD conversion***
		$recurr_today_usd = $recurr_today*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
		//************************
	echo "<td valign='top'><b> $ " . $recurr_today = $recurr_today . "(".$recurr_today_usd.")</b></td>";
	echo "</tr>"; 
	///////////////////////////////////// Recurr today, result - end
	echo "</table>";
	
	
	/////////////////////////////////// To send email to MANAGEMENT
	
	//1st table of BUSINESS SHEET
	$business_sheet_email_to_send = "
	<div align='center' style='font-size:15px; font-weight:bold'>BUSINESS SHEET</div>
	<table border='1' id='' cellspacing=2px > 
	<tr bgcolor=#eceff5>
	<td class='' valign='top'><b>Paying amount</b></td>
	<td valign='top'>$ ".round($paying_amount_variable_usd)."</td></tr>
	
	
	<tr bgcolor=#eceff5>
	<td><b>Total DEAD=REGULAR Amount </b></td>
	<td valign='top'>$ ".round($DEAD_Reg_usd)."</td>
	<td valign='top'></td></tr>
	
	<tr bgcolor=#eceff5>
	<td class=''><b>Freeze</b></td>
	<td valign='top'>$ ".round($freeze_amount_FOR_EMAIL_usd)."</td>";
	$deadReg_freeze_usd = $DEAD_Reg_usd + $freeze_amount_FOR_EMAIL_usd;
	$business_sheet_email_to_send.="<td valign='top'></td>
	<td valign='top'>  ". (($deadReg_freeze_usd / $paying_amount_variable_usd)*100)."</td></tr>
	
	<tr bgcolor=#eceff5>
	<td class=''><b>Total Recurring Received Amount-Current Month</b></td>
	<td valign='top'>$ ".round($recurr_usd)."</td></tr>";
	
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class=''><b>Signup Amount  RWP + Signup Amount  LHR</b></td>";
	$SU_rwp_usd = ceil($SU_rwp_usd);
	$SU_lhr_usd = ceil($SU_lhr_usd);	
	$business_sheet_email_to_send.="
	<td valign='top'>$ ". $SU_rwp_usd ."+". $SU_lhr_usd ."=". round(($SU_RWP_LHR_usd = $SU_rwp_usd+$SU_lhr_usd)) ."</td>
	<td valign='top'></td>";
	//Total SU minus Total Dead, GREEN/RED
	$total_SU_minus_total_DEAD = $SU_RWP_LHR - $DEAD_Reg;
	if($total_SU_minus_total_DEAD<0)
	$business_sheet_email_to_send.="<td valign='top' style='background-color:red; color:black;'>$ ".$total_SU_minus_total_DEAD_usd."</td>";
	else
	$business_sheet_email_to_send.="<td valign='top' style='background-color:green; color:black;'>$ ".$total_SU_minus_total_DEAD_usd."</td></tr>";
	//NEW ROW, for SIGNUP PER DAY with NEW DAYS CALCULATION, from 1st of month till date DAYS CALCULATION
	$business_sheet_email_to_send.="
	<tr bgcolor=#eceff5>
	<td class='specalt'><b>PER DAY SIGNUP</b></td>
	<td valign='top'></td>
	<td valign='top'></td>
	<td valign='top'>$ ". round(($SU_RWP_LHR_usd / $days_per_day_signup_DAYS))."</td></tr>";
	//NEW ROW, for SIGNUP PER DAY
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td valign='top'></td>
	<td valign='top'></td>
	<td valign='top'></td>
	<td valign='top'>$ ".round(($SU_RWP_LHR_usd / $per_day_signup_DAYS))."</td></tr>";
	///////////////////////////////////// Total income in this month, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Total Income in this Month</b></td>
	<td valign='top'>$ ".ceil($total_income_in_this_month_overall_usd)."</td></tr>";
	///////////////////////////////////// Total income in this month, result - end	
	///////////////////////////////////// Total pending till date, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Total Pending till date</b></td>
	<td valign='top'>$ ".$pre_month_pending_usd ."(PRE) + ". $current_month_pending_usd . "(1st - to date)=" . round($pre_month_pending_usd + $current_month_pending_usd).")</td>
	<td valign='top'></td></table>";
	
	$business_sheet_email_to_send.="<br><br><br>"; // New lines for 2nd table
	
	//2nd table of BUSINESS SHEET	
	$business_sheet_email_to_send.="<table border=1 id='table_liquid' cellspacing='2px' >
	<tr bgcolor=#eceff5>
	<th class='specalt'><b>Total Recurring(Current Month)</b></th>
	<th class='specalt'><b>ADVANCE</b></th>
	<th class='specalt'><b>Zero Paid</b></th>
	<th class='specalt'><b>UNFREEZE AUTO Zero Paid</b></th>
	<th class='specalt'><b>Recurring Received</b></th>
	<th class='specalt'><b>Receivable</b></th>
	<th class='specalt'><b>Freeze</b></th>
	<th class='specalt'><b>Dead Regular</b></th></tr>";
	
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td valign='top'>$ ". round($total_recurr_curr_month_usd  = ($paying_amount_variable_usd - ($SU_rwp_usd +$SU_lhr_usd)))."</td>
	<td valign='top'>$ ". round($recurr_advance_usd)."</td>
	<td valign='top'>$ ". $zero_paid = round($recurr_with_zero*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'])."</td>
	<td valign='top'>$ ". $UNFREEZE_AUTO_zero_paid = round($recurr_with_zero_UNFREEZE_AUTO*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'])."</td>
	<td valign='top'>$ ". $recurr = round($recurr*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'])."</td>
	<td valign='top'>$ ". $receivable = round($current_curr_month_pending*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'])."</td>
	<td valign='top'>$ ". round($freeze_amount_FOR_EMAIL*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'])."</td>
	<td valign='top'>$ ". $DEAD_Reg = round($DEAD_Reg*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'])."</td></tr></table>";
	
	$business_sheet_email_to_send.="<br><br><br>"; // New lines for 2nd table
	
	//3rd table of BUSINESS SHEET	
	$business_sheet_email_to_send.="<table border=1 id='table_liquid' cellspacing='2px' >
	<tr bgcolor=#eceff5>
	<td valign='top'><b></b></td>
	<td valign='top'><b>Total</b></td>
	<td valign='top'> DAY </td>
	<td valign='top'> NIGHT </td>
	<td valign='top'> LAHORE </td></tr>";
	/////////////////////////////////////  Trial day/night/ycc lahore, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Trials</b></td>
	<td valign='top'><b>" . $total_trial = $trial_day+$trial_night+$trial_ycc_lhr . "</b></td>
	<td valign='top'> ". $trial_day ."</td>
	<td valign='top'> ". $trial_night ."</td>
	<td valign='top'> ". $trial_ycc_lhr ."</td></tr>";
	///////////////////////////////////// Trial day/night/ycc lahore, result - end
	/////////////////////////////////////  Signup day/night/ycc lahore, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Signups</b></td>
	<td valign='top'><b>" . $total_signup = $signup_day+$signup_night+$signup_ycc_lhr . "</b></td>
	<td valign='top'> ". $signup_day ."</td>
	<td valign='top'> ". $signup_night ."</td>
	<td valign='top'> ". $signup_ycc_lhr ."</td></tr>"; 
	///////////////////////////////////// Signup day/night/ycc lahore, result - end
	/////////////////////////////////////  DEAD REGULAR day/night/ycc lahore, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Regular Dead</b></td>
	<td valign='top'><b>" . $total_Dead_Reg= $DEAD_Reg_cnt_day + $DEAD_Reg_cnt_night + $DEAD_Reg_cnt_ycc_lhr . "</b></td>
	<td valign='top'> ". $DEAD_Reg_cnt_day ."</td>
	<td valign='top'> ". $DEAD_Reg_cnt_night ."</td>
	<td valign='top'> ". $DEAD_Reg_cnt_ycc_lhr ."</td></tr>";
	///////////////////////////////////// DEAD REGULAR day/night/ycc lahore, result - end
	/////////////////////////////////////  Freeze day/night/ycc lahore, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Freeze</b></td>
	<td valign='top'><b>" . $total_freeze = $freeze_day + $freeze_night + $freeze_ycc_lhr . "</b></td>
	<td valign='top'> ". $freeze_day ."</td>
	<td valign='top'> ". $freeze_night ."</td>
	<td valign='top'> ". $freeze_ycc_lhr ."</td></tr>";
	///////////////////////////////////// Freeze day/night/ycc lahore, result - end
	/////////////////////////////////////  DEAD TRIAL day/night/ycc lahore, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Trial Dead</b></td>
	<td valign='top'><b>" . $total_Dead_Trl = $DEAD_Trl_cnt_day + $DEAD_Trl_cnt_night + $DEAD_Trl_cnt_ycc_lhr . "</b></td>
	<td valign='top'> ". $DEAD_Trl_cnt_day ."</td>
	<td valign='top'> ". $DEAD_Trl_cnt_night ."</td>
	<td valign='top'> ". $DEAD_Trl_cnt_ycc_lhr ."</td></tr>";
	///////////////////////////////////// DEAD TRIAL day/night/ycc lahore, result - end
	
	/////////////////////////////////////  Dead Amount, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Dead Amount</b></td>";
	//ADDING day,night and ycc lhr REGULAR DEAD
	$Reg_DEAD_amount = $DEAD_Reg_amount_day+$DEAD_Reg_amount_night+$DEAD_Reg_amount_ycc_lhr;
	//$freeze_amount = $freeze_amount_day+$freeze_amount_night+$freeze_amount_ycc_lhr;
	$business_sheet_email_to_send.="<td valign='top'> $ " . $Reg_DEAD_amount_usd . "</td></tr>";
	///////////////////////////////////// Dead Amount, result - end
	
	/////////////////////////////////////  Freeze Amount, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Freeze Amount</b></td>";
	//ADDING day,night and ycc lhr FREEZE
	$freeze_amount = $freeze_amount_day+$freeze_amount_night+$freeze_amount_ycc_lhr;
	$business_sheet_email_to_send.="<td valign='top'><b> $  " . $freeze_amount_usd ."</b></td></tr>";
	///////////////////////////////////// Freeze Amount, result - end
	
	/////////////////////////////////////  Signup Amount, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Signup Amount</b></td>
	<td valign='top'><b> $ " . $Signup_Amt = $Signup_Amt_usd ."</b></td></tr>";
	///////////////////////////////////// Signup Amount, result - end
	/////////////////////////////////////  Recurr today, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Recurring amount today(CCMS date)</b></td>
	<td valign='top'><b> $ " . $recurr_today = $recurr_today_usd ."</b></td></tr>
	</table>";

$mail->IsSMTP();
$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com'; // "ssl://smtp.gmail.com" didn't worked
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
// or try these settings (worked on XAMPP and WAMP):
// $mail->Port = 587;
// $mail->SMTPSecure = 'tls';
echo $letter_format=$_POST['letter_format'];
echo $customer_email = $_POST['customer_email'];
 
$mail->Username = "yccbizsheet@gmail.com";
$mail->Password = "getheavy123";
 
$mail->IsHTML(true); // if you are going to send HTML formatted emails
$mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.
 
$mail->From = "yccbizsheet@gmail.com";
$mail->FromName = "CCMS";
 
$mail->addAddress("junaid.abbas86@hotmail.com","Junaid Hotmail Address");
$mail->addAddress("junaid9898@yahoo.com","Junaid yahoo address");
$mail->addAddress("faheem@yourcloudcampus.com","Faheem Email");



$mail->Subject = "Business Sheet USD - Auto Generated Email From CCMS ycc";
$mail->Body    = $business_sheet_email_to_send;

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}
echo "Message has been sent";	
	///////////////////////////////////////////////////////////////

	
?>
