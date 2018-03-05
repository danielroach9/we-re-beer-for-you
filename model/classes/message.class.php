<?php

/**
 *
 */
class Message
{
  private $message_id, $recipient_uuid, $sender_uuid, $title, $content;

	// Get the Message's ID
	public function getMessageID(){return $this->message_id;}
	// Get the Message's recipient ID
	public function getRecipientID(){return $this->recipient_uuid;}
	// Get the Message's sender ID
	public function getSenderID(){return $this->sender_uuid;}
	// Get the Message's title
	public function getTitle(){return $this->title;}
	// Get the Message's content
	public function getContent(){return $this->content;}
}