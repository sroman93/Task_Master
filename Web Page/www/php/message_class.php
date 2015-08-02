<?php

if (session_status() == PHP_SESSION_NONE) 
{
	session_start();
}

include_once 'db_connect.php';
include_once 'user_class.php';

class message
{
	var $senderID;
	var $receiverID;
	var $content;
	var $timestamp;
	var $read;
	var $messageID;
	
	
	//
	//SETTERS
	//
	
	
	//Sends a message. Use this after making a new instance of message.
	//
	//Inputs:
	//info['recieverID'] - userID of person to send message to
	//info['content'] - The text of the message to send
	public function send($info)
	{
		$error = array();
		
		//validate given data
		$error = initialize($info);
		
		if (count($error) != 0)
			return $error;
		else
			return NULL;
		
		//add it to the database
		$dbhandle = db_connect();
		
		$stmt = $dbhandle->init_stmt();
		$stmt->prepare("INSERT INTO Messages (SenderID, ReceiverID, Content, ReadFlag, Time) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("iisii", $this->senderID, $this->recieverID, $this->content, $this->read, $this->timestamp);
		$stmt->execute();
		$stmt->store_result();
		
		$this->messageID = $dbhandle->insert_id;
		
		$stmt->close();
		$dbhandle->close();
		
		return NULL;
	}
	
	//Validates info for send()
	public function initialize($info)
	{
		$error = array();
		
		//check that you are logged in
		if(isset($_SESSION['userid']))
			$this->senderID = $_SESSION['userid'];
		else
			$error['login'] = true;
		
		//check that recipient exists
		$recipient = new user();
		if(isset($info['receiverID']) && $recipient->checkExistence($info['receiverID']))
			$this->recieverID = $info['recieverID'];
		else
			$error['receiverID'] = true;
		
		//strip any tags from message body
		if(isset($info['content']))
			$this->content = strip_tags($info['content']);
		else
			$error['content'] = true;
		
		//sets timestamp
		$this->timestamp = time();
		
		//sets read status to 0
		$this->read = 0;
		
		if (count($error) != 0)
			return $error;
		else
			return NULL;
	}
	
	
	//
	//GETTERS
	//
	
	
	//Populates the instance with info retrieved from the database corresponding to given ID
	public function getFromDB($inMsgID)
	{
		$dbhandle = db_connect();
		
		$stmt = $dbhandle->init_stmt();
		$stmt->prepare("SELECT FROM Messages SenderID, ReceiverID, Content, ReadFlag, Time, MessageID WHERE MessageID=? LIMIT 1");
		$stmt->bind_param("i", $inMsgID);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($this->senderID);
		$stmt->bind_result($this->receiverID);
		$stmt->bind_result($this->content);
		$stmt->bind_result($this->read);
		$stmt->bind_result($this->timestamp);
		$stmt->bind_result($this->messageID);
		$stmt->fetch();
		
		$stmt->close();
		$dbhandle->close();
		
		return NULL;
	}
	
	//Returns true if message with given ID exists, false if not
	public function checkExistence($inMsgID)
	{
		$retval; 
		
		//do the query
		$dbhandle = db_connect();
		
		$stmt = $dbhandle->stmt_init();
		$stmt->prepare("SELECT MessageID FROM Messages WHERE MessageID=?");
		$stmt->bind_param("i", $inMsgID);
		$stmt->execute();
		$stmt->store_result();
		
		if ($stmt->num_rows == 0) //message not found
			$retval = false;
		else //message found
			$retval = true;
		
		$stmt->close();
		$dbhandle->close();
		
		return $retval;
	}
}

?>