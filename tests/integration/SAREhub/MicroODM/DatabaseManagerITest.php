<?php
/**
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */

namespace SAREhub\MicroODM;

use PHPUnit\Framework\TestCase;
use SAREhub\MicroODM\Schema\CollectionSchema;
use SAREhub\MicroODM\Schema\DatabaseSchema;
use SAREhub\MicroODM\Schema\IndexSchema;
use SAREhub\MicroODM\Test\TestDatabaseHelper;


class DatabaseManagerITest extends TestCase
{
    /**
     * @var TestDatabaseHelper
     */
    private $helper;

    /**
     * @var DatabaseManager
     */
    private $manager;

    protected function setUp()
    {
        $databasePrefix = "database_manager";
        $this->helper = new TestDatabaseHelper($databasePrefix);
        $this->manager = $this->helper->getDatabaseManager();
    }

    protected function tearDown()
    {
        $this->helper->dropDatabases();
    }

    public function testCreate()
    {
        $this->manager->create("a", $this->createTestDatabaseSchema());
        $list = $this->manager->getList();
        $this->assertEquals(["a"], $list);
    }

    public function testDrop()
    {
        $this->manager->create("a", $this->createTestDatabaseSchema());
        $this->manager->drop("a");
        $list = $this->manager->getList();
        $this->assertEquals([], $list);
    }

    public function testIsExistsWhenExists()
    {
        $this->manager->create("a", $this->createTestDatabaseSchema());
        $this->assertTrue($this->manager->isExists("a"));
    }

    public function testIsExistsWhenNotExists()
    {
        $this->assertFalse($this->manager->isExists("a"));
    }

    private function createTestDatabaseSchema(): DatabaseSchema
    {
        return DatabaseSchema::newInstance()
            ->addCollection(CollectionSchema::collection("name")
                ->addIndex(new IndexSchema(["a" => 1])));
    }
}
