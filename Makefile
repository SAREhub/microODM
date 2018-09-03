export PROJECT_ID = microodm
export DOCKERUTIL_PATH = ./vendor/sarehub/dockerutil/bin/dockerutil
export BIN_SCRIPTS_PATH = bin/test

test_init: test_clean test_init_database

test_clean:
	bash ${BIN_SCRIPTS_PATH}/clean.sh

test_init_database:
	bash ${BIN_SCRIPTS_PATH}/database/deploy.sh



