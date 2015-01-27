<?php

namespace eBloodBank;

/**
 * @since 0.1
 */
class Donor extends Model {

	/**
	 * @var int
	 * @since 0.1
	 */
	protected $donor_id = 0;

	/**
	 * @var string
	 * @since 0.1
	 */
	protected $donor_name;

	/**
	 * @var string
	 * @since 0.1
	 */
	protected $donor_gender;

	/**
	 * @var int
	 * @since 0.1
	 */
	protected $donor_weight = 0;

	/**
	 * @var string
	 * @since 0.1
	 */
	protected $donor_birthdate;

	/**
	 * @var string
	 * @since 0.2
	 */
	protected $donor_blood_group;

	/**
	 * @var int
	 * @since 0.1
	 */
	protected $donor_distr_id = 0;

	/**
	 * @var string
	 * @since 0.1
	 */
	protected $donor_phone;

	/**
	 * @var string
	 * @since 0.1
	 */
	protected $donor_email;

	/**
	 * @var string
	 * @since 0.1
	 */
	protected $donor_rtime;

	/**
	 * @var int
	 * @since 0.1
	 */
	protected $donor_status = 0;


	/*** Methods **************************************************************/

	/**
	 * @return void
	 * @since 0.1
	 */
	public function __construct( $data = array() ) {

		if ( is_object( $data ) ) {
			$data = get_object_vars( $data );
		}

		if ( ! $data || ! is_array( $data ) ) {
			return;
		}

		foreach( $data as $key => $value ) {

			if ( property_exists( $this, $key ) ) {
				$this->$key = $value;
			}

		}

	}

	// Getters

	/**
	 * @return mixed
	 * @since 0.1
	 */
	public function display( $key, $format = 'html' ) {

		switch( $format ) {

			case 'attr':
				echo esc_attr( $this->get( $key ) );
				break;

			case 'html':
				echo esc_html( $this->get( $key ) );
				break;

			default:
				echo $this->get( $key );
				break;

		}

	}

	/**
	 * @return mixed
	 * @since 0.1
	 */
	public function get( $key ) {

		if ( isset( $this->$key ) ) {
			return $this->$key;
		}

	}

	/**
	 * @return bool
	 * @since 0.1
	 */
	public function is_exists() {
		return ! empty( $this->city_id );
	}

	/**
	 * @return array
	 * @since 0.1
	 */
	public function to_array() {
		return get_object_vars( $this );
	}

}