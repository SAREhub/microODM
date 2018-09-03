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

use MongoDB\Client;
use SAREhub\MicroODM\Schema\DatabaseSchema;


class DatabaseManager
{

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $prefix;


    public function __construct(Client $client, string $prefix)
    {
        $this->client = $client;
        $this->prefix = $prefix;
    }

    public function create(string $name, DatabaseSchema $schema): void
    {
        $database = $this->client->selectDatabase($this->getPrefixedName($name));
        foreach ($schema->getCollections() as $collectionSchema) {
            $database->createCollection($collectionSchema->getName());
            $collection = $database->selectCollection($collectionSchema->getName());
            foreach ($collectionSchema->getIndexes() as $index) {
                $collection->createIndex($index->getKey(), $index->getOptions());
            }
        }
    }

    public function drop(string $name): void
    {
        $this->client->dropDatabase($this->getPrefixedName($name));
    }

    public function getList(): array
    {
        $it = $this->client->listDatabases();
        $list = [];
        foreach ($it as $databaseInfo) {
            $name = $databaseInfo->getName();
            if (strpos($name, $this->prefix) === 0) {
                $list[] = $this->removePrefixFromName($name);
            }
        }
        return $list;
    }

    public function isExists(string $name): bool
    {
        foreach ($this->getList() as $value) {
            if ($name === $value) {
                return true;
            }
        }
        return false;
    }

    private function getPrefixedName(string $name): string
    {
        return $this->prefix . $name;
    }

    private function removePrefixFromName(string $prefixedName): string
    {
        return substr($prefixedName, strlen($this->prefix));
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }
}