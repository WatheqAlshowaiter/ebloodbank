<?php
/**
 * City Model
 *
 * @package EBloodBank
 * @subpackage Models
 * @since 1.0
 */
namespace EBloodBank\Models;

use EBloodBank\Exceptions\InvaildProperty;

/**
 * @since 1.0
 *
 * @Entity(repositoryClass="EBloodBank\Models\CityRepository")
 * @Table(name="city")
 */
class City extends Model
{
    /**
     * @var int
     * @since 1.0
     *
     * @Id
     * @GeneratedValue
     * @Column(type="integer", name="city_id")
     */
    protected $id = 0;

    /**
     * @var string
     * @since 1.0
     *
     * @Column(type="string", name="city_name")
     */
    protected $name;

    /**
     * @var District[]
     * @since 1.0
     *
     * @OneToMany(targetEntity="EBloodBank\Models\District", mappedBy="city")
     */
    protected $districts = array();

    /**
     * @return mixed
     * @since 1.0
     */
    public static function sanitize($key, $value)
    {
        switch ($key) {
            case 'id':
                $value = (int) $value;
                break;
            case 'name':
                $value = filter_var($value, FILTER_SANITIZE_STRING);
                break;
        }
        return $value;
    }

    /**
     * @throws \EBloodBank\Exceptions\InvaildProperty
     * @return bool
     * @since 1.0
     */
    public static function validate($key, $value)
    {
        switch ($key) {
            case 'id':
                if (! isVaildID($value)) {
                    throw new InvaildProperty(__('Invaild city ID.'), 'invaild_city_id');
                }
                break;
            case 'name':
                if (empty($value) || ! is_string($value)) {
                    throw new InvaildProperty(__('Invaild city name.'), 'invaild_city_name');
                }
                break;
        }
        return true;
    }
}
