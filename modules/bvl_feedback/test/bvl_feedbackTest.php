<?php
/**
 * create_timepoint automated integration tests
 *
 * PHP Version 5
 *
 * @category Test
 * @package  Loris
 * @author   Evan McIlroy <evanmcilroy@gmail.com>
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPLv3
 * @link     https://github.com/aces/Loris
 */

require_once __DIR__ . "/../../../test/integrationtests/LorisIntegrationTest.class.inc";
class createBVLFeedbackPanelIntegrationTest extends LorisIntegrationTest
{

    function setUp(){

        parent::setUp();

        $this->DB->insert(
            "candidate",
            array(
                'ID' => 99,
                'CandID' => 99999,
                'PSCID' => 'ZZZ999',
                'DoB' => '1999-01-01',
                'RegisteredBy' => 'admin',
                'Testdate' => '2015-01-01',
                'Gender' => 'Male',
                'CenterID' => 1,
            )
        );

         $this->DB->insert(
             "session",
             array(
                 'ID' => 99,
                 'CandID' => 99999,
                 'CenterID' => 1,
                 'VisitNo' => 1,
                 'Visit_label' => 'V01',
                 'Submitted' => 'N',
                 'Current_stage' => 'Visit',
                 'Date_stage_change' => '2015-01-01',
                 'Visit' => 'In Progress',
                 'Active' => 'Y',
                 'Scan_done' => 'N',
                 'MRIQCPending' => 'N',
                 'Testdate' => '2013-04-08 12:11:47',
                 'Date_registered' => '2013-04-08 12:11:47',
                 'UserID' => 'admin',
                 'RegisteredBy' => 'admin',
                 'Date_active' => '2013-02-28',
                 'Date_visit' => '2013-04-02',
                 'SubprojectID' => 1,

             )
         );

    }

    function tearDown(){
        parent::tearDown();
        $this->DB->delete("session", array('ID' => 99));
        $this->DB->delete("candidate", array('ID' => 99));

    }

    function testCreateTimepointDoespageLoad()
    {
        $this->webDriver->get($this->url . "?test_name=test_name=timepoint_list&candID=99999");


    }

    function testNewFeedback(){

    }

}
?>