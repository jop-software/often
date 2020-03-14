<?php

namespace App\Core;

use Base;
use DateInterval;
use DateTime;

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

    /**
     * return the expiration date from the current session
     * 
     * @return DateTime
     */
    private static function getExpireDate() : ?DateTime
    {
        // return the expiration date, casted to a date to DateTime for proper return type
        return Base::instance()->get("SESSION.expire_date");
    }

    /**
     * update the expiration date in the session to now + TTL, set in config.ini
     * 
     * @return void
     */
    public static function updateExpireDate() : void
    {
        $now = new DateTime();
        $ttl = Base::instance()->get("security.session.ttl");
        $ttl = new DateInterval("PT{$ttl}M");
        
        // add the configured amout of minute to $now
        $expire = $now->add($ttl);

        // write the expire date back into the session
        Base::instance()->set("SESSION.expire_date", $expire);
    }

    /**
     * check if the current session has exired yet.
     * 
     * @return bool
     */
    public static function isExpired() : bool
    {
        // get now and the expire date from the session
        $now = new DateTime();
        $sessionExpire = self::getExpireDate();

        return ($now > $sessionExpire);
    }

    /**
     * Get the user id, stored in the current session.
     * returns null if there is no user id
     * 
     * @return string 
     */
    public static function getUserId() : ?string
    {
        return Base::instance()->get("SESSION.userid");
    }

    /**
     * set the user id to the given string 
     * you also can pass null to log the user out
     */
    public static function setUserId(?string $userId) : void
    {
        Base::instance()->set("SESSION.userid", $userId);
    }
}