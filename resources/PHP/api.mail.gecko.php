<?php
	$GLOBALS['tables']['mails'] = array('_id_'=>'INTEGER AUTOINCREMENT','mailSubject'=>'TEXT NOT NULL','mailBody'=>'TEXT NOT NULL',
		'mailTime'=>'TEXT NOT NULL','mailReceivers'=>'TEXT NOT NULL','mailReceiversHidden'=>'TEXT','mailIP'=>'TEXT',
		'mailTags'=>'TEXT','mailFiles'=>'TEXT');
	$GLOBALS['api']['mails'] = array('db.mails'=>'../db/api.mails.gecko.db',
		'table.mails'=>'mails');


	function mails_save($data,$db = false){
		if(isset($data['id'])){$data['_id_'] = $data['id'];unset($data['id']);}
		$_valid = $GLOBALS['tables']['mails'];
		foreach($data as $k=>$v){if(!isset($_valid[$k])){unset($data[$k]);}}
		include_once('inc.sqlite3.php');

		if(!isset($data['mailTime'])){$data['mailTime'] = time();}
		$shouldClose = false;if(!$db){$db = sqlite3_open($GLOBALS['api']['mails']['db.mail']);sqlite3_exec('BEGIN',$db);$shouldClose = true;}

		//FIXME: comprobaciones

		$r = sqlite3_insertIntoTable($GLOBALS['api']['mails']['table.mails'],$data,$db);
		if(!$r['OK']){if($shouldClose){sqlite3_close($db);}return array('errorCode'=>$r['errno'],'errorDescription'=>$r['error'],'file'=>__FILE__,'line'=>__LINE__);}
		$mail = mails_getSingle('(id = '.$r['id'].')',array('db'=>$db));
		if($shouldClose){$r = sqlite3_exec('COMMIT;',$db);$GLOBALS['DB_LAST_ERRNO'] = $db->lastErrorCode();$GLOBALS['DB_LAST_ERROR'] = $db->lastErrorMsg();if(!$r){sqlite3_close($db);return array('errorCode'=>$GLOBALS['DB_LAST_ERRNO'],'errorDescription'=>$GLOBALS['DB_LAST_ERROR'],'file'=>__FILE__,'line'=>__LINE__);}sqlite3_close($db);}
		return $mail;
	}

	function mails_getSingle($whereClause = false,$params = array()){
		include_once('inc.sqlite3.php');
		$shouldClose = false;if(!isset($params['db']) || !$params['db']){$params['db'] = sqlite3_open($GLOBALS['api']['mails']['db.mails'],SQLITE3_OPEN_READONLY);$shouldClose = true;}
		$r = sqlite3_getSingle($GLOBALS['api']['mails']['table.mails'],$whereClause,$params);
		if($shouldClose){sqlite3_close($params['db']);}
		return $r;
	}
	function mails_getWhere($whereClause = false,$params = array()){
		include_once('inc.sqlite3.php');
		$shouldClose = false;if(!isset($params['db']) || !$params['db']){$params['db'] = sqlite3_open($GLOBALS['api']['mails']['db.mails'],SQLITE3_OPEN_READONLY);$shouldClose = true;}
		$r = sqlite3_getWhere($GLOBALS['api']['mails']['table.mails'],$whereClause,$params);
		if($shouldClose){sqlite3_close($params['db']);}
		return $r;
	}
?>
