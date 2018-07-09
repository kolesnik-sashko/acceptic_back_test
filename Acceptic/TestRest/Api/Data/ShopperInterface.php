<?php
namespace Acceptic\TestRest\Api\Data;

interface ShopperInterface 
{
    const CACHE_TAG = 'acceptic_rest_shopper';

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getEmail();

    /**
     * @param $email
     * @return ShopperInterface
     */
    public function setEmail($email);

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param $name
     * @return ShopperInterface
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getLastName();

    /**
     * @param $lastName
     * @return ShopperInterface
     */
    public function setLastName($lastName);

    /**
     * @return mixed
     */
    public function getPhone();

    /**
     * @param $phone
     * @return ShopperInterface
     */
    public function setPhone($phone);

    /**
     * @return mixed
     */
    public function getCity();

    /**
     * @param $city
     * @return ShopperInterface
     */
    public function setCity($city);

    /**
     * @return mixed
     */
    public function getStreet();

    /**
     * @param $street
     * @return ShopperInterface
     */
    public function setStreet($street);

    /**
     * @return mixed
     */
    public function getHouseNumber();

    /**
     * @param $houseNumber
     * @return ShopperInterface
     */
    public function setHouseNumber($houseNumber);
}