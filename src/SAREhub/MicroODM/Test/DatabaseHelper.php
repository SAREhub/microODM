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

namespace SAREhub\MicroODM\Test;

use MongoDB\Client;
use SAREhub\Commons\Misc\EnvironmentHelper;
use SAREhub\MicroODM\Client\ClientFactory;
use SAREhub\MicroODM\Client\ClientOptions;

class DatabaseHelper
{
    const ENV_HOST = "TEST_DATABASE_HOST";
    const ENV_PORT = "TEST_DATABASE_PORT";

    const ENV_USER = "TEST_DATABASE_USER";
    const DEFAULT_USER = "mongo_admin";

    const ENV_PASSWORD = "TEST_DATABASE_PASSWORD";
    const DEFAULT_PASSWORD = "test";

    /**
     * @var string
     */
    private $databasePrefix;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param string $databasePrefix
     */
    public function __construct(string $databasePrefix)
    {
        $this->databasePrefix = $databasePrefix;
        $this->client = self::createClient(self::getTestClientOptions());
    }

    public static function createClient(ClientOptions $options): Client
    {
        $factory = new ClientFactory();
        return $factory->create($options);
    }

    public static function getTestClientOptions(): ClientOptions
    {
        return ClientOptions::newInstance()
            ->withHost(EnvironmentHelper::getRequiredVar(self::ENV_HOST))
            ->withPort(EnvironmentHelper::getRequiredVar(self::ENV_PORT))
            ->withUser(EnvironmentHelper::getVar(self::ENV_USER, self::DEFAULT_USER))
            ->withPassword(EnvironmentHelper::getVar(self::ENV_PASSWORD, self::DEFAULT_PASSWORD));
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}