<?php

namespace App\Libraries;

use App\Entities\User;

/**
 * Class NothingPersonalValidator
 *
 * Checks password does not contain any personal information
 *
 * @package Myth\Auth\Authentication\Passwords\Validators
 */
class NothingPersonalValidator
    extends \Myth\Auth\Authentication\Passwords\NothingPersonalValidator
    implements \Myth\Auth\Authentication\Passwords\ValidatorInterface
{
    /**
     * isNotPersonal()
     *
     * Looks for personal information in a password. The personal info used
     * comes from Myth\Auth\Entities\User properties username and email.
     *
     * It is possible to include other fields as information sources.
     * For instance, a project might require adding `firstname` and `lastname` properties
     * to an extended version of the User class.
     * The new fields can be included in personal information testing in by setting
     * the `$personalFields` property in Myth\Auth\Config\Auth, e.g.
     *
     *      public $personalFields = ['firstname', 'lastname'];
     *
     * isNotPersonal() returns true if no personal information can be found, or false
     * if such info is found.
     *
     * @param string $password
     * @param User $user
     * @return boolean
     */
    protected function isNotPersonal($password, $user)
    {
        // $userName = \strtolower($user->username);
        // $email = \strtolower($user->email);
        $userNameOrEmail = strtolower($user->username ?? $user->email);
        $valid = true;

        // The most obvious transgressions
        if($password === $userNameOrEmail || $password === strrev($userNameOrEmail))
        {
            $valid = false;
        }

        // Parse out as many pieces as possible from username, password and email.
        // Use the pieces as needles and haystacks and look every which way for matches.
        if($valid)
        {
            // Take username apart for use as search needles
            $needles = isset($user->username) ? $this->strip_explode($user->username) : [];

            if (isset($user->email))
            {
                // extract local-part and domain parts from email as separate needles
                [$localPart, $domain] = \explode('@', $user->email);
                // might be john.doe@example.com and we want all the needles we can get
                $emailParts = $this->strip_explode($localPart);
                if( ! empty($domain))
                {
                    $emailParts[] = $domain;
                }
                $needles = empty($needles) ? $emailParts : \array_merge($needles, $emailParts);
            }

            // Get any other "personal" fields defined in config
            $personalFields = $this->config->personalFields;
            if( ! empty($personalFields))
            {
                foreach($personalFields as $value)
                {
                    if( ! empty($user->$value))
                    {
                        $needles[] = \strtolower($user->$value);
                    }
                }
            }

            $trivial = [
                'a', 'an', 'and', 'as', 'at', 'but', 'for',
                'if', 'in', 'not', 'of', 'or', 'so', 'the', 'then'
            ];

            // Make password into haystacks
            $haystacks = $this->strip_explode($password);

            foreach($haystacks as $haystack)
            {
                if(empty($haystack) || in_array($haystack, $trivial))
                {
                    continue;  //ignore trivial words
                }

                foreach($needles as $needle)
                {
                    if(empty($needle) || in_array($needle, $trivial))
                    {
                        continue;
                    }

                    // look both ways in case password is subset of needle
                    if(strpos($haystack, $needle) !== false ||
                        strpos($needle, $haystack) !== false)
                    {
                        $valid = false;
                        break 2;
                    }
                }
            }
        }
        if($valid)
        {
            return true;
        }

        $this->error = lang('Auth.errorPasswordPersonal');
        $this->suggestion = lang('Auth.suggestPasswordPersonal');
        return false;
    }

    /**
     * notSimilar() uses $password and $userName to calculate a similarity value.
     * Similarity values equal to, or greater than Myth\Auth\Config::maxSimilarity
     * are rejected for being too much alike and false is returned.
     * Otherwise, true is returned,
     *
     * A $maxSimilarity value of 0 (zero) returns true without making a comparison.
     * In other words, 0 (zero) turns off similarity testing.
     *
     * @param string $password
     * @param User $user
     * @return boolean
     */
    protected function isNotSimilar($password, $user)
    {
        $maxSimilarity = (float) $this->config->maxSimilarity;
        // sanity checking - working range 1-100, 0 is off
        if($maxSimilarity < 1)
        {
            $maxSimilarity = 0;
        }
        elseif($maxSimilarity > 100)
        {
            $maxSimilarity = 100;
        }

        if( ! empty($maxSimilarity))
        {
            $userName = \strtolower($user->username ?? $user->email);

            similar_text($password, $userName, $similarity);
            if($similarity >= $maxSimilarity)
            {
                $this->error = lang('Auth.errorPasswordTooSimilar');
                $this->suggestion = lang('Auth.suggestPasswordTooSimilar');
                return false;
            }
        }
        return true;
    }
}