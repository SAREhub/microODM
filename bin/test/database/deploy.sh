#!/usr/bin/env bash
set -e -u
source $DOCKERUTIL_PATH
set -a
source ./bin/test/.env
set +a

docker service create \
    --publish "$DATABASE_PUBLISH_PORT:$DATABASE_PORT" \
    --name $DATABASE_SERVICE  \
    --env MONGO_INITDB_ROOT_USERNAME=$DATABASE_USER \
    --env MONGO_INITDB_ROOT_PASSWORD=$TEST_PASSWORD \
    --label $TESTENV_LABEL \
    --detach=true \
    $DATABASE_SERVICE_IMAGE &>/dev/null

dockerutil::print_success "created service: $DATABASE_SERVICE"