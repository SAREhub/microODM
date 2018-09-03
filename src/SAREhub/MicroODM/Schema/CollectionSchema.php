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

namespace SAREhub\MicroODM\Schema;


class CollectionSchema
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $indexes;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->indexes = [];
    }

    public static function collection($name): self
    {
        return new self($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addIndex(IndexSchema $index): self
    {
        $this->indexes[] = $index;
        return $this;
    }

    /**
     * @return IndexSchema[]
     */
    public function getIndexes(): array
    {
        return $this->indexes;
    }
}
