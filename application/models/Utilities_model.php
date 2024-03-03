<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Utilities_model extends CI_Model {
	public function title_string($string) {
        $string = str_replace("  ", " ", $string);
        $string = ucwords(strtolower($string));
        return $string;
    }

    public function generate_key($value) {
        $get_key = hash("sha256", $value);
        return substr($get_key, 0, 32).substr(strrev($get_key), 0, 32);
    }

    public function GetMobileNumber($value) {
        return substr(preg_replace('/[^0-9]/', '', $value), -10);
    }

    public function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function set_upload_options($service, $fileName) {
        $config = array();
        switch ($service) {
            case "reg-stg":
                $config['upload_path']      = 'assets/data/stg/';
                break;
        }
        
        $config['allowed_types']    = 'jpg|jpeg|png';
        $config['overwrite']        = FALSE;
        $config['max_size']         = 5000;
        $config['file_name']        = $fileName.".jpg";

        return $config;
    }

    public function send_email($service, $value) {
        $statusCode     = 0;
        $description    = null;

        //$this->load->config('email');
        $this->load->library('phpmailer_library');
        $mail = $this->phpmailer_library->load();
        $mail->ClearAddresses();
        $mail->ClearAttachments();
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';

        $mail->Host = EMAIL_SMTP;
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL;
        $mail->Password = EMAIL_PASS;
        $mail->EMAIL_SMTP_ENCRYPT = EMAIL_PASS;
        $mail->Port = EMAIL_SMTP_PORT;
        $mail->setFrom(EMAIL, APP_NAME);
        //$this->email->clear();
        //$this->email->from(EMAIL, APP_NAME);

        switch ($service) {
            case "ForgotPassword":
                $subject    = "Password Reset";
                $email      = $value['Email'];
                $html_mail  =  file_get_contents(base_url()."assets/template/forgot.php");

                $data = array(
                    "name"          => $value['Name'],
                    "confirm_link"  => base_url()."user/reset/".$value['ParameterValue']
                );

                $placeholders = array(
                    "%NAME%",
                    "%CONFIRM_LINK%"
                );
                
                $message = str_replace($placeholders, $data, $html_mail);
                break;

            case "ApproveRegistration":
                $subject    = "Congratulations! Your Cocktail Competition Entry is Accepted 🍹";
                $email      = $value['Email'];
                /*$html_mail =  file_get_contents(base_url()."assets/template/registration.php");

                $data = array(
                    "name"          => $value['Name'],
                    "confirm_link"  => base_url()."user/confirm/".$value['ParameterValue']
                );*/
            
                $placeholders = array(
                    "%NAME%",
                    "%CONFIRM_LINK%"
                );
                //$message = str_replace($placeholders, $data, $html_mail);
                $message = "
                Dear <span style='font-weight: bold;'>".$value["Name"]."</span>, <br> <br>
                <span style='text-align: justify;'>
                    Congratulations! We are thrilled to inform you that your submission for the Emperador Academy: HRM Students' Cocktail Competition has been accepted! <br> <br>
                    Your creativity and skill truly stood out, and we look forward to witnessing your talent in action. In the coming days, you will receive further instructions and details if you will be able to make it to the next round. <br> <br>
                    Once again, congratulations on being selected, and we can't wait to see your impressive cocktail creation come to life at the Emperador Academy event.
                </span>
                <br> <br> <br>
                Best regards, <br> <br>
                Emperador Academy Cocktail Competition Team
                ";
                break;
            case "RejectRegistration":
                    $subject    = "URGENT: Incomplete Requirements for Emperador Academy Cocktail Competition 🍸";
                    $email      = $value['Email'];
                    /*$html_mail =  file_get_contents(base_url()."assets/template/registration.php");
    
                    $data = array(
                        "name"          => $value['Name'],
                        "confirm_link"  => base_url()."user/confirm/".$value['ParameterValue']
                    );*/
                
                    $placeholders = array(
                        "%NAME%",
                        "%CONFIRM_LINK%"
                    );
                    //$message = str_replace($placeholders, $data, $html_mail);
                    $message = "
                    Dear <span style='font-weight: bold;'>".$value["Name"]."</span>, <br> <br>
                    <span style='text-align: justify;'>
                        We hope this email finds you well. Thank you for your interest and submission to the Emperador Academy: HRM Students' Cocktail Competition. We appreciate your enthusiasm and passion for mixology.
                        <br> <br>
                        However, we noticed that your submission is <strong style='text-decoration: underline;'>incomplete (or invalid)</strong> as some required documentation or information is missing. To ensure that your entry is considered for the competition, we kindly request you to review your submission and provide the necessary details at your earliest convenience.
                        <br> <br>
                        The missing requirement/s include: <br> <br>
                        <strong>".nl2br($value["Remarks"])."</strong>
                        <br> <br>
                        Please take a moment to double-check your submission and make the necessary updates by ".date("F d, Y", strtotime(REG_ENDDATE)).". Incomplete entries will not be considered for the competition, so it's crucial to address this promptly.
                        <br> <br>
                        Should you encounter any challenges or have questions regarding the submission process, feel free to reach out to our support team at <a href='mailto:emperadoracademy@redbin.com.ph'>emperadoracademy@redbin.com.ph</a>
                        <br> <br>
                        We look forward to receiving your complete submission and wish you the best of luck in the Emperador Academy Cocktail Competition.
                        <br> <br>
                        Best regards,
                        <br> <br>
                        Emperador Academy Cocktail Competition Team
                    </span>
                    ";
                    break;
        }
        
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $message;
        //$mail->SMTPDebug = 2;
        /*$this->email->subject($subject);
        $this->email->to($email);
        $this->email->message($message);*/

        //if (! $this->email->send()) {
        if (!$mail->send()) {
            log_message("error", "Error sending registration confirmation. Reference: ".$value["Reference"]." Email: ".$value["Email"]);
            log_message("error", $mail->ErrorInfo);
            //log_message("error", $this->email->print_debugger());
        }
    }

    public function InsertActivityLog($model) {
        $result = false;
        $query = $this->db->insert('portal_activity_logs', $model);
        if ($this->db->affected_rows() > 0)
            $result = true;
        else
            log_message("error", "Error inserting activity logs. User ID: ".$model->UserId." | Session ID: ".$model->SID." ".$this->db->last_query());

        return $result;
    }
}