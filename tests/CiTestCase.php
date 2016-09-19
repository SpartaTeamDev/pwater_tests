<?php

/**
 * Class Ci_Framework_TestCase
 * @author tuan_dung
 */
abstract class Ci_Framework_TestCase extends \PHPUnit_Framework_TestCase
{
    /** @var \MX_Controller */
    protected $CI;
    /** @var \Faker\Generator */
    protected $faker;

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->faker = \Faker\Factory::create();
        $this->CI = &get_instance();
        $this->CI->db->cache_off();

        foreach (glob(APPPATH . 'models/*.php', GLOB_NOSORT) as $v)
        {
            if (false !== stripos($v, 'order_20150401'))
            {
                continue;
            }

            $this->CI->load->model(basename($v, '.php'));
        }

        parent::setUp();
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        \Mockery::close();
        echo $this->CI->db->last_query();
        echo PHP_EOL . PHP_EOL;

        parent::tearDown();
    }
}