<?php
	function m_main($folder = ''){
		$TEMPLATE = &$GLOBALS['TEMPLATE'];
		include_once('api.mail.gecko.php');

		if(isset($_POST['subcommand'])){switch($_POST['subcommand']){
			case 'mailSave':
				$mail = mails_save($_POST);
				if(isset($mail['errorDescription'])){print_r($mail['errorDescription']);exit;}
				break;
		}}


		$TEMPLATE['mail.write'] = common_loadSnippet('m/snippets/mail.write');
		$mails = mails_getWhere(1);
		$s = '<table class="mail-list"><thead><tr><th style="width:1px;"></th><th></th></tr></thead><tbody>';
		foreach($mails as $mail){
//FIXME: reset replace iterator
			$mail['mailSnippet'] = substr($mail['mailBody'],0,600);
			$s .= common_loadSnippet('m/snippets/mail.row',$mail);
		}
		$s .= '</tbody></table>';
		$TEMPLATE['mail.list'] = $s;

		common_renderTemplate('m/mail.box');
	}
?>
