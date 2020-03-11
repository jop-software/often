<?php

namespace App\Core;

use Base;

class SessionWrapper 
{

    /**
     * Add a message to the session
     * messges will get passed to twig during the next render process and then deleted
     * 
     * @param string $message
     * @param string $type
     * @return void
     */
    public static function addMessage(string $message, string $type) : void
    {
        // load all messages currently stored in the session or initialize an empty array
        $sessionMessages = Base::instance()->get("SESSION.MESSAGES");

        // check if we got messages back from the session
        if (!$sessionMessages) {
            // if not, assign empty array
            $sessionMessages = array();
        }

        // create and append the message object
        $sessionMessages[] = [
            "message" => $message,
            "type" => $type
        ];


        // write the errors back to the session
        Base::instance()->set("SESSION.MESSAGES", $sessionMessages);
    }

    /**
     * Get all messages from the session
     * returns null if there are no messages
     * 
     * @return null|array
     */
    public static function getMessages() : ?array
    {
        return Base::instance()->get("SESSION.MESSAGES");
    }

    public static function clearMessages() : void
    {
        // write null to the messages array in the session
        Base::instance()->set("SESSION.MESSAGES", null);
    }

}