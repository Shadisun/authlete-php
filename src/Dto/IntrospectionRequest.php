<?php
//
// Copyright (C) 2018 Authlete, Inc.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing,
// software distributed under the License is distributed on an
// "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
// either express or implied. See the License for the specific
// language governing permissions and limitations under the
// License.
//


/**
 * File containing the definition of IntrospectionRequest class.
 */


namespace Authlete\Dto;


use Authlete\Types\Arrayable;
use Authlete\Types\ArrayCopyable;
use Authlete\Types\Jsonable;
use Authlete\Util\ArrayTrait;
use Authlete\Util\JsonTrait;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Request to Authlete's /api/auth/introspection API.
 *
 * The API returns information about an access token.
 */
class IntrospectionRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $token   = null;  // string
    private $scopes  = null;  // array of string
    private $subject = null;  // string


    /**
     * Get the access token.
     *
     * @return string
     *     The access token.
     */
    public function getToken()
    {
        return $this->token;
    }


    /**
     * Set the access token.
     *
     * @param string $token
     *     The access token.
     *
     * @return IntrospectionRequest
     *     `$this` object.
     */
    public function setToken($token)
    {
        ValidationUtility::ensureNullOrString('$token', $token);

        $this->token = $token;

        return $this;
    }


    /**
     * Get scopes which are required to access the protected resource endpoint
     * of the resource server.
     *
     * @return string[]
     *     The scopes which are required to access the protected resource
     *     endpoint.
     */
    public function getScopes()
    {
        return $this->scopes;
    }


    /**
     * Set scopes which are required to access the protected resource endpoint
     * of the resource server.
     *
     * If the given array contains one or more scopes which are not covered by
     * the access token, Authlete's /api/auth/introspection API returns
     * `IntrospectionAction::FORBIDDEN` as the `action` and sets
     * `insufficient_scope` as the error code. If `null` is given,
     * /api/auth/introspection API does not check scopes of the access token.
     *
     * @param string[] $scopes
     *     The scopes which the access token is required to have in order to
     *     access the protected resource endpoint.
     *
     * @return IntrospectionRequest
     *     `$this` object.
     */
    public function setScopes(array $scopes = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of an end-user which is required
     * to access the protected resource endpoint of the resource server.
     *
     * @return string
     *     The subject which the access token is required to be associated
     *     with in order to access the protected resource endpoint.
     */
    public function getSubject()
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of an end-user which is required
     * to access the protected resource endpoint of the resource server.
     *
     * If the specified subject is different from the one associated with
     * the access token, Authlete's /api/auth/introspection API returns
     * `IntrospectionAction::FORBIDDEN` as the `action` and sets
     * `invalid_request` as the error code. If `null` is given,
     * /api/auth/introspection API does not check the subject of the access
     * token.
     *
     * @param string $subject
     *     The subject which the access token is required to be associated
     *     with in order to access the protected resource endpoint.
     *
     * @return IntrospectionRequest
     *     `$this` object.
     */
    public function setSubject($subject)
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param array $array
     *     {@inheritdoc}
     */
    public function copyToArray(array &$array)
    {
        $array['token']   = $this->token;
        $array['scopes']  = $this->scopes;
        $array['subject'] = $this->subject;
    }


    /**
     * {@inheritdoc}
     *
     * {@inheritdoc}
     *
     * @param array $array
     *     {@inheritdoc}
     */
    public function copyFromArray(array &$array)
    {
        // token
        $this->setToken(
            LanguageUtility::getFromArray('token', $array));

        // scopes
        $this->setScopes(
            LanguageUtility::getFromArray('scopes', $array));

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));
    }
}
?>
