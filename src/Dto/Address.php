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
 * File containing the definition of Address class.
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
 * Address claim that represents a physical mailing address.
 *
 * See "[5.1.1. Address Claim](https://openid.net/specs/openid-connect-core-1_0.html#AddressClaim)"
 * of [OpenID Connect Core 1.0](https://openid.net/specs/openid-connect-core-1_0.html)
 * for details.
 *
 * @see https://openid.net/specs/openid-connect-core-1_0.html#AddressClaim OpenID Connect Core 1.0, 5.1.1. Address Claim
 */
class Address implements ArrayCopyable, Arrayable, Jsonable
{
    use ArrayTrait;
    use JsonTrait;


    private $formatted     = null;  // string
    private $streetAddress = null;  // string
    private $locality      = null;  // string
    private $region        = null;  // string
    private $postalCode    = null;  // string
    private $country       = null;  // string


    /**
     * Get the full mailing address, formatted for display or use on
     * a mailing label.
     *
     * @return string
     *     The full mailing address.
     */
    public function getFormatted()
    {
        return $this->formatted;
    }


    /**
     * Set the full mailing address, formatted for display or use on
     * a mailing label.
     *
     * @param string $formatted
     *     The full mailing address.
     *
     * @return Address
     *     `$this` object.
     */
    public function setFormatted($formatted)
    {
        ValidationUtility::ensureNullOrString('$formatted', $formatted);

        $this->formatted = $formatted;

        return $this;
    }


    /**
     * Get the full street address component, which MAY include house
     * number, street name, Post Office Box, and multi-line extended
     * street address information.
     *
     * @return string
     *     The full street address.
     */
    public function getStreetAddress()
    {
        return $this->streetAddress;
    }


    /**
     * Set the full street address component, which MAY include house
     * number, street name, Post Office Box, and multi-line extended
     * street address information.
     *
     * @param string $streetAddress
     *     The full street address component.
     *
     * @return Address
     *     `$this` object.
     */
    public function setStreetAddress($streetAddress)
    {
        ValidationUtility::ensureNullOrString('$streetAddress', $streetAddress);

        $this->streetAddress = $streetAddress;

        return $this;
    }


    /**
     * Get the city or locality component.
     *
     * @return string
     *     The city or locality component.
     */
    public function getLocality()
    {
        return $this->locality;
    }


    /**
     * Set the city or locality component.
     *
     * @param string $locality
     *     The city or locality component.
     *
     * @return Address
     *     `$this` object.
     */
    public function setLocality($locality)
    {
        ValidationUtility::ensureNullOrString('$locality', $locality);

        $this->locality = $locality;

        return $this;
    }


    /**
     * Get the state, province, prefecture, or region component.
     *
     * @return string
     *     The state, province, prefecture, or region component.
     */
    public function getRegion()
    {
        return $this->region;
    }


    /**
     * Set the state, province, prefecture, or region component.
     *
     * @param string $region
     *     The state, province, prefecture, or region component.
     *
     * @return Address
     *     `$this` object.
     */
    public function setRegion($region)
    {
        ValidationUtility::ensureNullOrString('$region', $region);

        $this->region = $region;

        return $this;
    }


    /**
     * Get the zip code or postal code component.
     *
     * @return string
     *     The zip code or postal code component.
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }


    /**
     * Set the zip code or postal code component.
     *
     * @param string $postalCode
     *     The zip code or postal code component.
     *
     * @return Address
     *     `$this` object.
     */
    public function setPostalCode($postalCode)
    {
        ValidationUtility::ensureNullOrString('$postalCode', $postalCode);

        $this->postalCode = $postalCode;

        return $this;
    }


    /**
     * Get the country name component.
     *
     * @return string
     *     The country name component.
     */
    public function getCountry()
    {
        return $this->country;
    }


    /**
     * Set the country name component.
     *
     * @param string $country
     *     The country name component.
     *
     * @return Address
     *     `$this` object.
     */
    public function setCountry($country)
    {
        ValidationUtility::ensureNullOrString('$country', $country);

        $this->country = $country;

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
        $array['formatted']      = $this->formatted;
        $array['street_address'] = $this->streetAddress;
        $array['locality']       = $this->locality;
        $array['region']         = $this->region;
        $array['postal_code']    = $this->postalCode;
        $array['country']        = $this->country;
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
        // formatted
        $this->setFormatted(
            LanguageUtility::getFromArray('formatted', $array));

        // street_address
        $this->setStreetAddress(
            LanguageUtility::getFromArray('street_address', $array));

        // locality
        $this->setLocality(
            LanguageUtility::getFromArray('locality', $array));

        // region
        $this->setRegion(
            LanguageUtility::getFromArray('region', $array));

        // postal_code
        $this->setPostalCode(
            LanguageUtility::getFromArray('postal_code', $array));

        // country
        $this->setCountry(
            LanguageUtility::getFromArray('country', $array));
    }
}
?>
