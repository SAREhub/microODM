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

namespace SAREhub\MicroODM\Client;


class ClientOptions
{
    const DEFAULT_HOST = "localhost";

    /**
     * @var string
     */
    private $host = self::DEFAULT_HOST;
    const DEFAULT_PORT = 27017;

    /**
     * @var int
     */
    private $port = self::DEFAULT_PORT;
    const DEFAULT_USERNAME = "mongo_admin";

    /**
     * @var string
     */
    private $username = self::DEFAULT_USERNAME;

    /**
     * @var string
     */
    private $password = "";

    public static function newInstance(): ClientOptions
    {
        return new self;
    }

    public function withHost(string $host): ClientOptions
    {
        $this->host = $host;
        return $this;
    }

    public function withPort(int $port): ClientOptions
    {
        $this->port = $port;
        return $this;
    }

    public function withUser(string $username): ClientOptions
    {
        $this->username = $username;
        return $this;
    }

    public function withPassword(string $password): ClientOptions
    {
        $this->password = $password;
        return $this;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
