<?php
/**
 * Help_editor automated integration tests
 *
 * PHP Version 5
 *
 * @category Test
 * @package  Loris
 * @author   Ted Strauss <ted.strauss@mcgill.ca>
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPLv3
 * @link     https://github.com/aces/Loris
 */

set_include_path(get_include_path().":../php:");
require_once __DIR__ . "/../../../test/integrationtests/LorisIntegrationTest.class.inc";
require_once "HelpFile.class.inc";

class helpEditorTestIntegrationTest extends LorisIntegrationTest
{

    public function getDataSet()
    {
        
    }
    
    /**
     * Tests that, when clicking the help_editor icon the
     * pull-down appears and is visible with the appropriate title.
     * Steps one and two on help_module test plan.
     *
     * @author Evan McIlroy <evanmcilroy@gmail.com>
     * @return void
     */
    function testHelpEditorContextualPullDown()
    {
        $this->webDriver->get($this->url . "?test_name=help_editor");
        $helpEditorButton = $this->webDriver->findElement(WebDriverBy::cssSelector(".navbar-brand.pull-right.help-button"));
        $helpEditorButton->click();

        $contextualPulldown = $this->webDriver->findElement(WebDriverBy::cssSelector(".help-content.visible"));
        $this->assertEquals(true, $contextualPulldown->isDisplayed());

        $helpTitle = $contextualPulldown->findElement(WebDriverBy::cssSelector("h3"));
        
        $helpID = HelpFile::hashToID(md5('help_editor'));

        $help_file = HelpFile::factory($helpID);
        $data      = $help_file->toArray();
        
        $this->assertEquals($data['topic'], $helpTitle->getText());
    }

    /**
     * Tests that, when clicking the help_editor close
     * button, the pull-down is no longer visibile to the user.
     * Step three on the help_module test plan.
     *
     * @author Evan McIlroy <evanmcilroy@gmail.com>
     * @return void
     */
    function testHelpEditorButtonClose()
    {
        $this->webDriver->get($this->url . "?test_name=help_editor");
        $helpEditorButton = $this->webDriver->findElement(WebDriverBy::cssSelector(".navbar-brand.pull-right.help-button"));
        $helpEditorButton->click();

        $contextualPulldown = $this->webDriver->findElement(WebDriverBy::cssSelector(".help-content.visible"));
        $closeButton = $contextualPulldown->findElement(WebDriverBy::cssSelector("#helpclose"));
        $closeButton->click();

        $this->assertEquals(false, $contextualPulldown->isDisplayed());
        
    }
    function helpEditorLastUpdate(){
        
    }
    
    /**
     * Tests that, when loading the help_editor module, some
     * text appears in the body.
     *
     * @return void
     */
    function testHelpEditorDoespageLoad()
    {
        $this->webDriver->get($this->url . "?test_name=help_editor");
        $bodyText = $this->webDriver->findElement(WebDriverBy::cssSelector("body"))->getText();
        $this->assertContains("Help Editor", $bodyText);
    }
    /**
     * Tests that, when loading the help_editor module > edit help submodule, some
     * text appears in the body.
     *
     * @return void
     */
    function testHelpEditorEditHelpContentDoespageLoad()
    {
        $this->webDriver->get($this->url . "?test_name=help_editor&subtest=edit_help_content");
        $bodyText = $this->webDriver->findElement(WebDriverBy::cssSelector("body"))->getText();
        $this->assertContains("Edit Help Content", $bodyText);
    }

    function testHelpEditorSelectionFilter()
    {
        $DB = Database::singleton();
        //Get the default values
        if (Utility::isErrorX($DB)) {
            return PEAR::raiseError("Could not connect to database: ".
                                     $DB->getMessage());
        }

        $this->webDriver->get($this->url . "?test_name=help_editor");
        $bodyText = $this->webDriver->findElement(WebDriverBy::cssSelector("body"))->getText();
        
        $help = $DB->pselectRow("SELECT topic from help", array());
        foreach ($help as $val){
            $this->assertContains($val, $bodyText);
        }        
    }

    function permissionsTest(){
        
        

    }
}
?>