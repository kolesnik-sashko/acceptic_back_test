<?php

namespace Acceptic\TestRest\Api\Data;

interface ShopperInterface 
{
    const CACHE_TAG    = 'acceptic_rest_shopper';
    const REGISTRY_KEY = 'acceptic_rest_shopper';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     * @return ShopperInterface
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return ShopperInterface
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param string $lastName
     * @return ShopperInterface
     */
    public function setLastName($lastName);

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param string $phone
     * @return ShopperInterface
     */
    public function setPhone($phone);

    /**
     * @return string
     */
    public function getCity();

    /**
     * @param string $city
     * @return ShopperInterface
     */
    public function setCity($city);

    /**
     * @return string
     */
    public function getStreet();

    /**
     * @param string $street
     * @return ShopperInterface
     */
    public function setStreet($street);

    /**
     * @return string
     */
    public function getHouseNumber();

    /**
     * @param string $houseNumber
     * @return ShopperInterface
     */
    public function setHouseNumber($houseNumber);
}