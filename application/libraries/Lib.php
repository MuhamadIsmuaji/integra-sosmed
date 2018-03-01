<?php

class Lib
{
    public static function getRedirectTo($role)
    {
        switch ($role) {
            case 1:
                return 'backend';
                break;

            case 2:
                return 'posts';
                break;

            default:
                return '/';
                break;
        }
    }

    public static function to($url, $opsi = null)
    {
        if (is_null($opsi)) {
            $url = base_url() . $url;
        }

        echo '<script>location.href="' . $url . '"</script>';
    }

    // fungsi ini seperti var_dump
    public static function dump($value)
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }

    // fungsi pagingData.
    // mengembalikan total page, page dan offset
    // @param total_rows = total data
    // @param limit = jml limit page
    public static function pagingData($page, $total_rows, $limit)
    {
        $tot_page = floor($total_rows / $limit);
        $tot_page += $total_rows % $limit > 0 ? 1 : 0 ;
        $data['tot_page'] = $tot_page;

        if ($page == '' || $page <= 0 || $page > $tot_page):
          $page = 1;
        endif;
        $data['page'] = $page;

        $data['offset'] = ($page - 1) * $limit;

        return $data;
    }

    // method doupload. berfungsi untuk mengupload file foto ke directory
    public static function douploadphoto($path, $file, $resize, $sizeImg, $name = null)
    {
        require_once 'Mupload/Mupload.php';
        $mupload = new Mupload();  // create a new object

        // get type img
        $type = explode('.', $file['name']);
        $type = $type[count($type) - 1];

        $name = !$name ? date('YmdHis') : $name; //cek nama apakah baru atau update

        $mupload->upload($file);
        if ($mupload->uploaded == true) :

            $mupload->allowed = ['image/*'];
        $mupload->file_new_name_body = $name;
        $mupload->image_resize = true;
        $mupload->file_overwrite = true;
        $mupload->image_convert = 'jpg';

        //cek image potrait or landscape
        if ($sizeImg[0] > $sizeImg[1]) :
              $mupload->image_x = $resize[0]; // image destination resize x in px
              $mupload->image_ratio_y = true; // true -> will get the resize x
            else :
              $mupload->image_ratio_x = true; // true -> will get the resize y
              $mupload->image_y = $resize[1];  // image destination resize x in px
            endif;

        $mupload->process($path);

        if ($mupload->processed == true) :

              $mupload->clean();
        return $name . '.jpg'; else :

                return false;

        endif;

        endif;
    }

    public static function smtpmailer($to, $from, $from_name, $subject, $body)
    {
        require_once dirname(__FILE__) . '/PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer();  // create a new object

        // set smtp
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = HOSTMAIL;
        $mail->Port = 465;
        $mail->Username = USERMAIL;
        $mail->Password = PWDMAIL;

        // set email content
        $mail->SetFrom($from, $from_name);
        $mail->Subject = $subject;

        $mail->Body = $body;
        $mail->IsHTML(true);
        $mail->AddAddress($to);

        // Lib::dumb($mail);

        if (!$mail->Send()) {
            $error = 'Mail error: ' . $mail->ErrorInfo;
            return false;
        } else {
            $error = 'Message sent!';
            return true;
        }
    }
}
