<?php namespace site\src\controllers;

use DateTime;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use site\src\dao\Database;
use site\src\dao\userDao;
use site\src\models\Admin;
use site\src\models\Citizan;

class loginController
{
    private userDao $userDao; 
    public function __construct()
    {
        $this->userDao = new userDao(); 
    }
    public function login(array $request)
    {
        $user = $this->userDao->select(["email" => $request["email"], "password" => $request["password"]]);
        if(count($user) == 1)
	    {
            $data = $user[0]; 
            print_r($data);
            //TODO: hide PDO logic using doctorDao and PatientDao
            $isAdmin   = Database::getConnection()->query("SELECT * FROM ADMIN WHERE id={$data->getId()}"); 
            $isCitizan = Database::getConnection()->query("SELECT * FROM CITIZAN WHERE id={$data->getId()}"); 
            
            if($isAdmin->rowCount() == 1)
            {
                $isAdmin = $isAdmin->fetch();
                $user =  new Admin($data->getId(), $data->getFirstName(), $data->getLastName(), $data->getEmail(),$data->getPassword());
            }
            elseif($isCitizan->rowCount() == 1)
            {
                $isCitizan = $isCitizan->fetch(); 
                $birthDate = DateTime::createFromFormat('Y-m-d', $isCitizan["birthDate"]);
                $user =  new Citizan($data->getId(), $data->getFirstName(), $data->getLastName(), $data->getEmail(), $isCitizan["gender"],
                                    $data->getPassword(), $isCitizan["cin"],$birthDate,  $isCitizan["address"], $isCitizan["phoneNumber"]);
            }

            //user found => store in session
            session_start(); 
            $_SESSION["user"] = serialize($user);
            return $user; 
        }
        return false; 
    }

    public function forgorPassword($email)
    {
        
        $mail = new PHPMailer(true);
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
            $mail->addAddress($email, '');     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
        
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNsOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < 10; $i++)	$randomString .= $characters[mt_rand(0, strlen($characters) - 1)];

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Account details';
            $mail->Body    = 'Hi! here\'s your new password : <b>'.$randomString.'</b>';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();

            //update database
            (new userDao())->updatePassword($randomString, $email);
            echo "<script>console.log('email sent');</script>";
        } catch (Exception $e) {
            echo "<script>console.log('Email not sent');</script>";
        }
    }
}
?>