<?php
//
// Copyright (C) 2018-2021 Authlete, Inc.
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
 * File containing the definition of TokenCreateRequest class.
 */


namespace Authlete\Dto;


use Authlete\Types\Arrayable;
use Authlete\Types\ArrayCopyable;
use Authlete\Types\GrantType;
use Authlete\Types\Jsonable;
use Authlete\Util\ArrayTrait;
use Authlete\Util\JsonTrait;
use Authlete\Util\LanguageUtility;
use Authlete\Util\ValidationUtility;


/**
 * Request to Authlete's /api/auth/token/create API.
 *
 * The API can be used to create an arbitrary access token without using
 * standard flows.
 */
class TokenCreateRequest implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $grantType             = null;  // \Authlete\Types\GrantType
    private $clientId              = null;  // string or (64-bit) integer
    private $subject               = null;  // string
    private $scopes                = null;  // array of string
    private $accessTokenDuration   = null;  // string or (64-bit) integer
    private $refreshTokenDuration  = null;  // string or (64-bit) integer
    private $properties            = null;  // array of \Authlete\Dto\Property
    private $clientIdAliasUsed     = false; // boolean
    private $accessToken           = null;  // string
    private $refreshToken          = null;  // string
    private $accessTokenPersistent = false; // boolean
    private $certificateThumbprint = null;  // string
    private $dpopKeyThumbprint     = null;  // string


    /**
     * Get the grant type to be emulated for a newly created access token.
     *
     * @return GrantType
     *     The grant type.
     */
    public function getGrantType()
    {
        return $this->grantType;
    }


    /**
     * Set the grant type to be emulated for a newly created access token.
     *
     * When `$grantType` is either `GrantType::$IMPLICIT` or
     * `GrantType::$CLIENT_CREDENTIALS`, a refresh token is not issued.
     * This request parameter is mandatory.
     *
     * @param GrantType $grantType
     *     The grant type.
     *
     * @return TokenCreateRequest
     *     `$this` object.
     */
    public function setGrantType(GrantType $grantType = null)
    {
        $this->grantType = $grantType;

        return $this;
    }


    /**
     * Get the ID of the client application which will be associated with a
     * newly created access token.
     *
     * @return integer|string
     *     The client ID.
     */
    public function getClientId()
    {
        return $this->clientId;
    }


    /**
     * Set the ID of the client application which will be associated with a
     * newly created access token.
     *
     * This request parameter is mandatory.
     *
     * @param integer|string $clientId
     *     The client ID.
     *
     * @return TokenCreateRequest
     *     `$this` object.
     */
    public function setClientId($clientId)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$clientId', $clientId);

        $this->clientId = $clientId;

        return $this;
    }


    /**
     * Get the subject (= unique identifier) of the end-user who will be
     * associated with a newly created access token.
     *
     * @return string
     *     The subject of the end-user.
     */
    public function getSubject()
    {
        return $this->subject;
    }


    /**
     * Set the subject (= unique identifier) of the end-user who will be
     * associated with a newly created access token.
     *
     * This request parameter is required unless the grant type is
     * `GrantType::$CLIENT_CREDENTIALS`. The value must consist of only
     * ASCII characters and its length must not exceed 100.
     *
     * @param string $subject
     *     The subject of the end-user.
     *
     * @return TokenCreateRequest
     *     `$this` object.
     */
    public function setSubject($subject)
    {
        ValidationUtility::ensureNullOrString('$subject', $subject);

        $this->subject = $subject;

        return $this;
    }


    /**
     * Get the scopes which will be associated with a newly created access
     * token.
     *
     * @return string[]
     *     The scopes.
     */
    public function getScopes()
    {
        return $this->scopes;
    }


    /**
     * Set the scopes which will be associated with a newly created access
     * token.
     *
     * Scopes that are not supported by the service cannot be specified and
     * requesting them will cause an error. This request parameter is optional.
     *
     * @param string[] $scopes
     *     The scopes.
     *
     * @return TokenCreateRequest
     *     `$this` object.
     */
    public function setScopes(array $scopes = null)
    {
        ValidationUtility::ensureNullOrArrayOfString('$scopes', $scopes);

        $this->scopes = $scopes;

        return $this;
    }


    /**
     * Get the duration of a newly created access token in seconds.
     *
     * @return integer|string
     *     The duration of the access token.
     */
    public function getAccessTokenDuration()
    {
        return $this->accessTokenDuration;
    }


    /**
     * Set the duration of a newly created access token in seconds.
     *
     * If `$duration` is 0, the duration is determined according to the
     * settings of the service. This request parameter is optional.
     *
     * @param integer|string $duration
     *     The duration of the access token.
     *
     * @return TokenCreateRequest
     *     `$this` object.
     */
    public function setAccessTokenDuration($duration)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->accessTokenDuration = $duration;

        return $this;
    }


    /**
     * Get the duration of a newly created refresh token in seconds.
     *
     * @return integer|string
     *     The duration of the refresh token.
     */
    public function getRefreshTokenDuration()
    {
        return $this->refreshTokenDuration;
    }


    /**
     * Set the duration of a newly created refresh token in seconds.
     *
     * If `$duration` is 0, the duration is determined according to the
     * settings of the service. This request parameter is optional.
     *
     * No refresh token is created (1) if the service is configured not to
     * support `GrantType::$REFRESH_TOKEN`, or (2) if the specified grant
     * type is either `GrantType::$IMPLICIT` or
     * `GrantType::$CLIENT_CREDENTIALS`.
     *
     * @param integer|string $duration
     *     The duration of the refresh token.
     *
     * @return TokenCreateRequest
     *     `$this` object.
     */
    public function setRefreshTokenDuration($duration)
    {
        ValidationUtility::ensureNullOrStringOrInteger('$duration', $duration);

        $this->refreshTokenDuration = $duration;

        return $this;
    }


    /**
     * Get properties to be associated with a newly created access token.
     *
     * @return Property[]
     *     Properties.
     */
    public function getProperties()
    {
        return $this->properties;
    }


    /**
     * Set properties to be associated with a newly created access token.
     *
     * Note that the `properties` request parameter is accepted only when
     * `Content-Type` of the request is `application/json`, so don't use
     * `application/x-www-form-urlencoded` if you want to use this
     * `properties` request parameter.
     *
     * @param Property[] $properties
     *     Properties.
     *
     * @return TokenCreateRequest
     *     `$this` object.
     */
    public function setProperties(array $properties = null)
    {
        ValidationUtility::ensureNullOrArrayOfType(
            '$properties', $properties, __NAMESPACE__ . '\Property');

        $this->properties = $properties;

        return $this;
    }


    /**
     * Get the flag which indicates whether to emulate that the client ID
     * alias is used instead of the original numeric client ID when a new
     * access token is created.
     *
     * @return boolean
     *     `true` if use of the client ID alias is emulated.
     */
    public function isClientIdAliasUsed()
    {
        return $this->clientIdAliasUsed;
    }


    /**
     * Set the flag which indicates whether to emulate that the client ID
     * alias is used instead of the original numeric client ID when a new
     * access token is created.
     *
     * This has an effect only on the value of the `aud` claim in a response
     * from a [userinfo endpoint](https://openid.net/specs/openid-connect-core-1_0.html#UserInfo).
     * When you access the userinfo endpoint (which is expected to be
     * implemented using Authlete's `/api/auth/userinfo` API and
     * `/api/auth/userinfo/issue` API) with an access token which has been
     * created using Authlete's `/api/auth/token/create` API with this
     * request parameter `true`, the client ID alias is used as the value
     * of the `aud` claim in a response from the userinfo endpoint.
     *
     * Note that if a client ID alias is not assigned to the client when
     * Authlete's `/api/auth/token/create` API is called, this request
     * parameter has no effect (it is always regarded as `false`).
     *
     * @param boolean $used
     *     `true` to emulate use of the client ID alias.
     *
     * @return TokenCreateRequest
     *     `$this` object.
     */
    public function setClientIdAliasUsed($used)
    {
        ValidationUtility::ensureBoolean('$used', $used);

        $this->clientIdAliasUsed = $used;

        return $this;
    }


    /**
     * Get the value of the new access token.
     *
     * @return string
     *     The value of the new access token.
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }


    /**
     * Set the value of the new access token.
     *
     * This request parameter is optional.
     *
     * The `/api/auth/token/create` API generates an access token. Therefore,
     * callers of the API do not have to specify values of newly created
     * access tokens. However, in some cases, for example, if you want to
     * migrate existing access tokens from an old system to Authlete, you may
     * want to specify values of access tokens. In such a case, you can
     * specify the value of a newly created access token by passing a non-null
     * value as the value of the `accessToken` request parameter. The
     * implementation of the `/api/auth/token/create` API uses the value of
     * the `accessToken` request parameter instead of generating a new value
     * when the request parameter holds a non-null value.
     *
     * Note that if the hash value of the specified access token already
     * exists in Authlete's database, the access token cannot be inserted and
     * the `/api/auth/token/create` API will report an error.
     *
     * @param string $accessToken
     *     The value of the new access token.
     *
     * @return TokenCreateRequest
     *     `$this` object.
     */
    public function setAccessToken($accessToken)
    {
        ValidationUtility::ensureNullOrString('$accessToken', $accessToken);

        $this->accessToken = $accessToken;

        return $this;
    }


    /**
     * Get the value of the new refresh token.
     *
     * @return string
     *     The value of the new refresh token.
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }


    /**
     * Set the value of the new refresh token.
     *
     * This request parameter is optional.
     *
     * The `/api/auth/token/create` API generates a refresh token as
     * necessary. Therefore, callers of the API do not have to specify values
     * of newly created refresh tokens. However, in some cases, for example,
     * if you want to migrate existing refresh tokens from an old system to
     * Authlete, you may want to specify values of refresh tokens. In such a
     * case, you can specify the value of a newly created refresh token by
     * passing a non-null value as the value of the `refreshToken`request
     * parameter. The implementation of the `/api/auth/token/create` API uses
     * the value of the `refreshToken` request parameter instead of generating
     * a new value when the request parameter holds a non-null value.
     *
     * Note that if the hash value of the specified refresh token already
     * exists in Authlete's database, the refresh token cannot be inserted and
     * the `/api/auth/token/create` API will report an error.
     *
     * @param string $refreshToken
     *     The value of the new refresh token.
     *
     * @return TokenCreateRequest
     *     `$this` object.
     */
    public function setRefreshToken($refreshToken)
    {
        ValidationUtility::ensureNullOrString('$refreshToken', $refreshToken);

        $this->refreshToken = $refreshToken;

        return $this;
    }


    /**
     * Get whether the access token expires or not. By default, all access
     * tokens expire after a period of time determined by their service.
     * If this request parameter is `true` then the access token will not
     * automatically expire.
     *
     * If this request parameter is `true`, the `accessTokenDuration` request
     * parameter is ignored.
     *
     * @return boolean
     *     `false` if the access token expires (default).
     *     `true` if the access token does not expire.
     *
     * @since 1.8
     */
    public function isAccessTokenPersistent()
    {
        return $this->accessTokenPersistent;
    }


    /**
     * Set whether the access token expires or not. By default, all access
     * tokens expire after a period of time determined by their service.
     * If this request parameter is `true` then the access token will not
     * automatically expire.
     *
     * If this request parameter is `true`, the `accessTokenDuration` request
     * parameter is ignored.
     *
     * @param boolean $persistent
     *     `false` to make the access token expire (default).
     *     `true` to make the access token be persistent.
     *
     * @return TokenCreateRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setAccessTokenPersistent($persistent)
    {
        ValidationUtility::ensureBoolean('$persistent', $persistent);

        $this->accessTokenPersistent = $persistent;

        return $this;
    }


    /**
     * Get the thumbprint of the client certificate bound to the access token.
     * If this request parameter is set, a certificate whose thumbprint matches
     * the value must be presented when the client uses the access token.
     *
     * @return string
     *     The base64url-encoded SHA-256 certificate thumbprint.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function getCertificateThumbprint()
    {
        return $this->certificateThumbprint;
    }


    /**
     * Set the thumbprint of the client certificate bound to the access token.
     * If this request parameter is set, a certificate whose thumbprint matches
     * the value must be presented when the client uses the access token.
     *
     * @param string $thumbprint
     *     The base64url-encoded SHA-256 certificate thumbprint.
     *
     * @return TokenCreateRequest
     *     `$this` object.
     *
     * @see https://www.rfc-editor.org/rfc/rfc8705.html RFC 8705 OAuth 2.0 Mutual-TLS Client Authentication and Certificate-Bound Access Tokens
     *
     * @since 1.8
     */
    public function setCertificateThumbprint($thumbprint)
    {
        ValidationUtility::ensureNullOrString('$thumbprint', $thumbprint);

        $this->certificateThumbprint = $thumbprint;

        return $this;
    }


    /**
     * Get the thumbprint of the public key used for DPoP presentation of this
     * access token. If this request parameter is set, a DPoP proof signed with
     * the corresponding private key must be presented when the client uses the
     * access token.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @return string
     *     The JWK publick key thumbprint.
     *
     * @since 1.8
     */
    public function getDpopKeyThumbprint()
    {
        return $this->dpopKeyThumbprint;
    }


    /**
     * Set the thumbprint of the public key used for DPoP presentation of this
     * access token. If this request parameter is set, a DPoP proof signed with
     * the corresponding private key must be presented when the client uses the
     * access token.
     *
     * See "OAuth 2.0 Demonstration of Proof-of-Possession at the Application
     * Layer (DPoP)" for details.
     *
     * @param string $thumbprint
     *     The JWK publick key thumbprint.
     *
     * @return TokenCreateRequest
     *     `$this` object.
     *
     * @since 1.8
     */
    public function setDpopKeyThumbprint($thumbprint)
    {
        ValidationUtility::ensureNullOrString('$thumbprint', $thumbprint);

        $this->dpopKeyThumbprint = $thumbprint;

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
        $array['grantType']             = LanguageUtility::toString($this->grantType);
        $array['clientId']              = LanguageUtility::orZero($this->clientId);
        $array['subject']               = $this->subject;
        $array['scopes']                = $this->scopes;
        $array['accessTokenDuration']   = LanguageUtility::orZero($this->accessTokenDuration);
        $array['refreshTokenDuration']  = LanguageUtility::orZero($this->refreshTokenDuration);
        $array['properties']            = LanguageUtility::convertArrayOfArrayCopyableToArray($this->properties);
        $array['clientIdAliasUsed']     = $this->clientIdAliasUsed;
        $array['accessToken']           = $this->accessToken;
        $array['refreshToken']          = $this->refreshToken;
        $array['accessTokenPersistent'] = $this->accessTokenPersistent;
        $array['certificateThumbprint'] = $this->certificateThumbprint;
        $array['dpopKeyThumbprint']     = $this->dpopKeyThumbprint;
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
        // grantType
        $this->setGrantType(
            GrantType::valueOf(
                LanguageUtility::getFromArray('grantType', $array)));

        // clientId
        $this->setClientId(
            LanguageUtility::getFromArray('clientId', $array));

        // subject
        $this->setSubject(
            LanguageUtility::getFromArray('subject', $array));

        // scopes
        $_scopes = LanguageUtility::getFromArray('scopes', $array);
        $this->setScopes($_scopes);

        // accessTokenDuration
        $this->setAccessTokenDuration(
            LanguageUtility::getFromArray('accessTokenDuration', $array));

        // refreshTokenDuration
        $this->setRefreshTokenDuration(
            LanguageUtility::getFromArray('refreshTokenDuration', $array));

        // properties
        $_properties = LanguageUtility::getFromArray('properties', $array);
        $_properties = LanguageUtility::convertArrayToArrayOfArrayCopyable($_properties, __NAMESPACE__ . '\Property');
        $this->setProperties($_properties);

        // clientIdAliasUsed
        $this->setClientIdAliasUsed(
            LanguageUtility::getFromArrayAsBoolean('clientIdAliasUsed', $array));

        // accessToken
        $this->setAccessToken(
            LanguageUtility::getFromArray('accessToken', $array));

        // refreshToken
        $this->setRefreshToken(
            LanguageUtility::getFromArray('refreshToken', $array));

        // accessTokenPersistent
        $this->setAccessTokenPersistent(
            LanguageUtility::getFromArrayAsBoolean('accessTokenPersistent', $array));

        // certificateThumbprint
        $this->setCertificateThumbprint(
            LanguageUtility::getFromArray('certificateThumbprint', $array));

        // dpopKeyThumbprint
        $this->setDpopKeyThumbprint(
            LanguageUtility::getFromArray('dpopKeyThumbprint', $array));
    }
}
?>
