<?php

class search_test extends DokuWikiTest {
    function strip_index_data($entry) {
        $n_entry = array();
        foreach(array('id', 'type', 'level', 'open') as $k) {
            $n_entry[$k] = $entry[$k];
        }
        return $n_entry;
    }

    function test_search_index(){
        $data = array();
        search($data, dirname(__FILE__) . '/data', 'search_index',
               array('ns' => 'ns2'));
        $this->assertEquals(array_map(array($this, 'strip_index_data'), $data),
                           array(
                              array(
                                'id'   => 'ns1',
                                'type' => 'd',
                                'level' => 1,
                                'open' => false
                              ), array(
                                'id'   => 'ns2',
                                'type' => 'd',
                                'level' => 1,
                                'open' => true
                              ), array(
                                'id' => 'ns2:page1',
                                'type' => 'f',
                                'level' => 2,
                                'open' => true,
                              ), ));
        $data = array();
        search($data, dirname(__FILE__) . '/data', 'search_index',
               array('ns' => 'ns1/ns3'));
        $this->assertEquals(array_map(array($this, 'strip_index_data'), $data),
                           array(
                              array(
                                'id' => 'ns1',
                                'type' => 'd',
                                'level' => 1,
                                'open' => true,
                              ),
                              array(
                                'id' => 'ns1:ns3',
                                'type' => 'd',
                                'level' => 2,
                                'open' => true,
                              ),
                              array(
                                'id' => 'ns1:ns3:page3',
                                'type' => 'f',
                                'level' => 3,
                                'open' => true,
                              ),
                              array(
                                'id' => 'ns1:page1',
                                'type' => 'f',
                                'level' => 2,
                                'open' => true,
                              ),
                              array(
                                'id' => 'ns1:page2',
                                'type' => 'f',
                                'level' => 2,
                                'open' => true,
                              ),
                              array(
                                'id' => 'ns2',
                                'type' => 'd',
                                'level' => 1,
                                'open' => false,
                              ), ));
        $data = array();
        search($data, dirname(__FILE__) . '/data', 'search_index',
               array('ns' => 'ns1/ns3', 'nofiles' => true));
        $this->assertEquals(array_map(array($this, 'strip_index_data'), $data),
                           array(
                              array(
                                'id' => 'ns1',
                                'type' => 'd',
                                'level' => 1,
                                'open' => true,
                              ),
                              array(
                                'id' => 'ns1:ns3',
                                'type' => 'd',
                                'level' => 2,
                                'open' => true,
                              ),
                              array(
                                'id' => 'ns2',
                                'type' => 'd',
                                'level' => 1,
                                'open' => false,
                              ), ));

    }
}
//Setup VIM: ex: et ts=4 :
