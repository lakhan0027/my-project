<?php

class UserRegistration
{
    public $id = '';
    public $first_name = '';
    public $last_name = '';
    public $phone_number = '';
    public $email = '';
    public $father_name = '';
    public $father_occupation = '';
    public $tenth_board = '';
    public $tenth_percentage = '';
    public $tenth_year = '';
    public $twelfth_board = '';
    public $twelfth_percentage = '';
    public $twelfth_year = '';
    public $graduation_university = '';
    public $graduation_percentage = '';
    public $graduation_year = '';
    public $passport = '';
    public $description = '';

    /**
     * Optional constructor to initialize via array
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = is_string($value) ? trim($value) : $value;
            }
        }
    }
}
