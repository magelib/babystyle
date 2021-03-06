<?php
/**
 * Refer to LICENSE.txt distributed with the Temando Shipping module for notice of license
 */
namespace Temando\Shipping\Model\Shipment;

use Magento\Framework\DataObject;

/**
 * Temando Shipment Destination Entity
 *
 * This model contains the data used in the shipping module, not necessarily all
 * data available in its webservice representation.
 *
 * @package  Temando\Shipping\Model
 * @author   Christoph Aßmann <christoph.assmann@netresearch.de>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     http://www.temando.com/
 */
class ShipmentDestination extends DataObject implements ShipmentDestinationInterface
{
    /**
     * Get organisation name.
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->getData(ShipmentDestinationInterface::COMPANY);
    }

    /**
     * Get contact person's first name.
     *
     * @return string
     */
    public function getPersonFirstName()
    {
        return $this->getData(ShipmentDestinationInterface::PERSON_FIRST_NAME);
    }

    /**
     * Get contact person's last name.
     *
     * @return string
     */
    public function getPersonLastName()
    {
        return $this->getData(ShipmentDestinationInterface::PERSON_LAST_NAME);
    }

    /**
     * Get contact person's email address.
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(ShipmentDestinationInterface::EMAIL);
    }

    /**
     * Get contact person's telephone number.
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->getData(ShipmentDestinationInterface::PHONE_NUMBER);
    }

    /**
     * Get destination address street lines.
     *
     * @return string[]
     */
    public function getStreet()
    {
        return $this->getData(ShipmentDestinationInterface::STREET);
    }

    /**
     * Get destination address locality.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->getData(ShipmentDestinationInterface::CITY);
    }

    /**
     * Get destination address postal code.
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->getData(ShipmentDestinationInterface::POSTAL_CODE);
    }

    /**
     * Get destination address administrative area.
     *
     * @return string
     */
    public function getRegionCode()
    {
        return $this->getData(ShipmentDestinationInterface::REGION_CODE);
    }

    /**
     * Get destination address country ISO 2 code.
     * @return string
     */
    public function getCountryCode()
    {
        return $this->getData(ShipmentDestinationInterface::COUNTRY_CODE);
    }
}
