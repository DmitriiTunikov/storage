<?php

define('NUM', 200);

/**
 * testController short summary.
 *
 * testController description.
 *
 * @version 1.0
 * @author a_koz
 */
class TestController
{
    function init($db)
    {
        $a = array('afd', 'bdx', 'cgf', 'dxf', 'ebgf', 'fxfv', 'gxfb',
                   'afdd', 'bedx', 'cgnf', 'dxfdr', 'ebgfcxd', 'fxfvfv', 'gxefb');

        $db->request("drop table if exists test");
        $db->request("create table test (test_id int unsigned not null auto_increment,
                                         name text not null,
                                         data text not null,
                                         primary key(test_id))");

        for ($i = 0; $i < 1000; $i++)
        {
            $db->request("insert into test(name, data) values('" . $a[$i % sizeof($a)] . "', 'hello')");
        }

        $db->request("create table test_copy_one as select * from test");

        for ($i = 1000; $i < 10000; $i++)
        {
            $db->request("insert into test(name, data) values('" . $a[$i % sizeof($a)] . "', 'hello')");
        }

        $db->request("create table test_copy_ten as select * from test");

        for ($i = 10000; $i < 100000; $i++)
        {
            $db->request("insert into test(name, data) values('" . $a[$i % sizeof($a)] . "', 'hello')");
        }

        $db->request("create table test_copy_hundred as select * from test");
    }

    function copy($db)
    {
        $db->request("create table test1t as select * from test_copy_one");
        $db->request("alter table test1t add primary key(test_id)");

        $db->request("create table test10t as select * from test_copy_ten");
        $db->request("alter table test10t add primary key(test_id)");

        $db->request("create table test100t as select * from test_copy_hundred");
        $db->request("alter table test100t add primary key(test_id)");
    }

    function __construct()
    {
        $db = new database();
        $db->connect();

        $this->copy($db);

        $db->close();
    }

    function __destruct()
    {
        $db = new database();
        $db->connect();

        $db->request("drop table if exists test, test1t, test10t, test100t");

        $db->close();
    }

    function actionIndex()
    {

        require_once(ROOT . '/views/test/index.php');
        return true;
    }

    function actionSearch()
    {
        $db = new database();
        $db->connect();

        //////////////////////////////// search by key
        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("select * from test1t where test_id=" . rand(1, 1000));
        }
        $time_key_1 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("select * from test10t where test_id=" . rand(1, 10000));
        }
        $time_key_10 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("select * from test100t where test_id=" . rand(1, 100000));
        }
        $time_key_100 = (microtime(true) - $start) / NUM;

        //////////////////////////////// search by non-primary
        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("select * from test1t where name='dxfdr'");
        }
        $time_nkey_1 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("select * from test10t where name='dxfdr'");
        }
        $time_nkey_10 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("select * from test100t where name='dxfdr'");
        }
        $time_nkey_100 = (microtime(true) - $start) / NUM;

        //////////////////////////////// search by mask
        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("select * from test1t where name like '%f'");
        }
        $time_mask_1 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("select * from test10t where name like '%f'");
        }
        $time_mask_10 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("select * from test100t where name like '%f'");
        }
        $time_mask_100 = (microtime(true) - $start) / NUM;

        require_once(ROOT . '/views/test/search.php');

        $db->close();

        return true;
    }

    function actionAdd()
    {
        $db = new database();
        $db->connect();
        
        //////////////////////////////// insert + delete 1'000
        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("insert into test1t(test_id, name, data) values(" . (1001 + $i) . ", 'ggwp" . $i . "', 'hello')");
        }
        $time_insert_1 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("delete from test1t where test_id=" . ($i + 1));
        }
        $time_delete_key_1 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("delete from test1t where name='ggwp" . $i . "'");
        }
        $time_delete_nkey_1 = (microtime(true) - $start) / NUM;

        //////////////////////////////// insert + delete 10'000
        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("insert into test10t(test_id, name, data) values(" . (10001 + $i) . ", 'ggwp" . $i . "', 'hello')");
        }
        $time_insert_10 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("delete from test10t where test_id=" . ($i + 1));
        }
        $time_delete_key_10 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("delete from test10t where name='ggwp" . $i . "'");
        }
        $time_delete_nkey_10 = (microtime(true) - $start) / NUM;

        //////////////////////////////// insert + delete 100'000
        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("insert into test100t(test_id, name, data) values(" . (100001 + $i) . ", 'ggwp" . $i . "', 'hello')");
        }
        $time_insert_100 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("delete from test100t where test_id=" . ($i + 1));
        }
        $time_delete_key_100 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("delete from test100t where name='ggwp" . $i . "'");
        }
        $time_delete_nkey_100 = (microtime(true) - $start) / NUM;

        require_once(ROOT . '/views/test/add.php');

        $db->close();

        return true;
    }

    function actionEdit()
    {
        $db = new database();
        $db->connect();

        //////////////////////////////// edit 1'000
        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("update test1t set data='olpot' where test_id=" . rand(0, 1000));
        }
        $time_edit_key_1 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("update test1t set data='sokl' where name='ebgf'");
        }
        $time_edit_nkey_1 = (microtime(true) - $start) / NUM;

        //////////////////////////////// edit 10'000
        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("update test10t set data='olpot' where test_id=" . rand(0, 10000));
        }
        $time_edit_key_10 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("update test10t set data='sokl' where name='ebgf'");
        }
        $time_edit_nkey_10 = (microtime(true) - $start) / NUM;

        //////////////////////////////// edit 100'000
        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("update test100t set data='olpot' where test_id=" . rand(0, 100000));
        }
        $time_edit_key_100 = (microtime(true) - $start) / NUM;

        $start = microtime(true);
        for ($i = 0; $i < NUM; $i++)
        {
            $db->fetcharray("update test100t set data='sokl' where name='ebgf'");
        }
        $time_edit_nkey_100 = (microtime(true) - $start) / NUM;

        require_once(ROOT . '/views/test/edit.php');

        $db->close();

        return true;
    }

    function actionAddm()
    {
        $db = new database();
        $db->connect();

        //////////////////////////////// insert + delete 1'000
        $a = array('afd', 'bdx', 'cgf', 'dxf', 'ebgf', 'fxfv', 'gxfb',
        'afdd', 'bedx', 'cgnf', 'dxfdr', 'ebgfcxd', 'fxfvfv', 'gxefb');
        
        $time_insert_1 = 0;
        
        $time_delete_1 = 0;
        
        for ($i = 0; $i < NUM; $i++)
        {
          $start = microtime(true);
          for ($j = 0; $j < 100; $j++)
          {
            $db->fetcharray("insert into test1t(test_id, name, data) values(" . (1001 + $j) . ", 'top', 'hi')");
          }
          $time_insert_1 += microtime(true) - $start;
          $start = microtime(true);
        
          for ($j = 0; $j < 100; $j++)
          {
            $db->fetcharray("delete from test1t where test_id=" . (1001 + $j));
          }
          $time_delete_1 += microtime(true) - $start;
        }
        $time_insert_1 /= NUM;
        $time_delete_1 /= NUM;

        $time_insert_10 = 0;
        $time_delete_10 = 0;
        
        for ($i = 0; $i < NUM; $i++)
        {
          $start = microtime(true);
          for ($j = 0; $j < 100; $j++)
          {
            $db->fetcharray("insert into test10t(test_id, name, data) values(" . (10001 + $j) . ", 'top', 'hi')");
          }
          $time_insert_10 += microtime(true) - $start;
          $start = microtime(true);
        
          for ($j = 0; $j < 100; $j++)
          {
            $db->fetcharray("delete from test10t where test_id=" . (10001 + $j));
          }
          $time_delete_10 += microtime(true) - $start;
        }
        $time_insert_10 /= NUM;
        $time_delete_10 /= NUM;
        
        $time_insert_100 = 0;
        $time_delete_100 = 0;
        
        for ($i = 0; $i < NUM; $i++)
        {
          $start = microtime(true);
          for ($j = 0; $j < 100; $j++)
          {
            $db->fetcharray("insert into test100t(test_id, name, data) values(" . (100001 + $j) . ", 'top', 'hi')");
          }
          $time_insert_100 += microtime(true) - $start;
          $start = microtime(true);
        
          for ($j = 0; $j < 100; $j++)
          {
            $db->fetcharray("delete from test100t where test_id=" . (100001 + $j));
          }
          $time_delete_100 += microtime(true) - $start;
        }
        $time_insert_100 /= NUM;
        $time_delete_100 /= NUM;
        
        require_once(ROOT . '/views/test/addm.php');

        $db->close();

        return true;
    }

    function actionCompress($type)
    {
        $db = new database();
        $db->connect();

        if ($type == 1)
        {
            //////////////////////////////// delete 1'000
            for ($i = 0; $i < 200; $i++)
            {
                $db->fetcharray("delete from test1t where test_id=" . ($i + 1));
            }
            $start = microtime(true);
            $db->fetcharray("optimize table test1t");
            $time_comp_1 = microtime(true) - $start;
            
            //////////////////////////////// delete 10'000
            for ($i = 0; $i < 200; $i++)
            {
                $db->fetcharray("delete from test10t where test_id=" . ($i + 1));
            }
            $start = microtime(true);
            $db->fetcharray("optimize table test10t");
            $time_comp_10 = microtime(true) - $start;

            //////////////////////////////// delete 100'000
            for ($i = 0; $i < 200; $i++)
            {
                $db->fetcharray("delete from test100t where test_id=" . ($i + 1));
            }
            $start = microtime(true);
            $db->fetcharray("optimize table test100t");
            $time_comp_100 = microtime(true) - $start;
        }
        else
        {
            //////////////////////////////// delete 1'000
            for ($i = 0; $i < 800; $i++)
            {
                $db->fetcharray("delete from test1t where test_id=" . ($i + 1));
            }
            $start = microtime(true);
            $db->fetcharray("optimize table test1t");
            $time_comp_1 = microtime(true) - $start;

            //////////////////////////////// delete 10'000
            for ($i = 0; $i < 9800; $i++)
            {
                $db->fetcharray("delete from test10t where test_id=" . ($i + 1));
            }
            $start = microtime(true);
            $db->fetcharray("optimize table test10t");
            $time_comp_10 = microtime(true) - $start;

            //////////////////////////////// delete 100'000
            for ($i = 0; $i < 99800; $i++)
            {
                $db->fetcharray("delete from test100t where test_id=" . ($i + 1));
            }
            $start = microtime(true);
            $db->fetcharray("optimize table test100t");
            $time_comp_100 = microtime(true) - $start;
        }

        require_once(ROOT . '/views/test/compress.php');

        $db->close();

        return true;
    }
}