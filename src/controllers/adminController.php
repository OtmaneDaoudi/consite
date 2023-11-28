<?php namespace site\src\controllers;
      use site\src\dao\DiscussionDao;
      use site\src\models\Demand;
      use site\src\models\Discussion;
require_once("../../vendor/autoload.php");

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use site\src\dao\CitizanDao;
use site\src\dao\DemandDao;

class AdminController
{
    private citizanDao $citizanDao; 
    private DemandDao $demandDao; 
    public function __construct()
    {
        $this->citizanDao = new CitizanDao(); 
        $this->demandDao = new DemandDao();
    }

    public function addDemand(Demand $data)
    {
        //insert discussion entry
        return $this->demandDao->insert($data); 
    }

    public function deleteCitizan(int $id)
    {
        $this->citizanDao->delete($id);
    }

    public function deleteDemand(int $demandId)
    {
        $this->demandDao->delete($demandId);
    }

    public function fetchDemands()
    {
        // session_start();
        return $this->demandDao->select(["idAdmin" => unserialize($_SESSION["user"])->getId()]);    
    }
    public function fetchCitizans() : array
    {
        return $this->citizanDao->select(); 
    }

    public function getAllEmails()
    {
        $citizans = $this->citizanDao->select(); 
        $emails = array_map(function($value)
        {
            return $value->getEmail(); 
        }, $citizans); 
        return $emails; 
    }
    public function getAllCins()
    {
        $citizans = $this->citizanDao->select(); 
        $emails = array_map(function($value)
        {
            return $value->getCin(); 
        }, $citizans); 
        return $emails; 
    }

    public function sendEmailToUser(string $to, string $password)
    {
        $mail = new PHPMailer(true);
        // $mail->setLanguage('fr', '/optional/path/to/language/directory/');
        
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'eaeeb569e4ea2c';
            $mail->Password = '56afc4fa36b6b4';                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('construction@site.com', '');
            $mail->addAddress($to, '');     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
        
            
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Account details';
            $mail->Body    = 'Hi! here\'s your account password : <b>'.$password.'</b>';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo "<script>console.log('email sent');</script>";
        } catch (Exception $e) {
            echo "<script>console.log('Email not sent');</script>";
        }
    }
}
?>