<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$err = array();

if (!$GLOBALS['APPLICATION']->CaptchaCheckCode($_REQUEST["captcha_word"], $_REQUEST["captcha_code"]))
	$err['required'][] = 'captcha_word';

if ($err) {
	$result['status'] = 'error';
	$result['errors'] = $err;
}
else
	$result['status'] = 'ok';

if($result['status'] == 'ok') {

		require './mail/PHPMailerAutoload.php';

		$text = array(
			'name'=> 'Your name',
			'email'=> 'E-mail',
			'phone'=> 'Phone',
			'qtype'=> 'Question type',
			'message'=> 'Message',
			'website' => 'Website',
			'customer' => 'Customer base',
			'coverage' => 'Regions coverage',
			'type' => 'Type'
		);

		$body = "<small>С сайта было отправлено сообщение следующего содержания:</small><br /><hr><br /><br />";

		foreach ($_REQUEST as $key => $value)
			if($text[$key]&&strlen($value)>0)
				$body .= $text[$key].': '.nl2br($value)."<br /><br />\r\n";

		foreach ($_FILES as $key => $value):
			if($text[$key]):
				$name  = $value['name'];
				$value = CFile::GetPath(CFile::SaveFile($value));
				$body .= $text[$key].': <a href="http://'.$_SERVER['HTTP_HOST'].$value.'">'.$name."</a><br /><br />\r\n";
			endif;
		endforeach;
		$body .= "<br /><hr><br />";

		if ($result['status'] == 'ok') {

			$emails = COption::GetOptionString("grain.customsettings", 'feedback');

			$mail = new PHPMailer;
			$mail->isSendmail();
			$mail->CharSet = 'UTF-8';
			$mail->Subject = "Сообщение с сайта ".$arSite['NAME'];
			$mail->setFrom("mailer@".$_SERVER['HTTP_HOST'], "Сайт ".$arSite['NAME']);
			$mail->addAddress($emails, $emails);
			$mail->msgHTML($body);
			$mail->send();
		}
}
print json_encode($result);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>
