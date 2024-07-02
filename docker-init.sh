#!/bin/bash

CONTAINER="magenta-web"
HOST_PORT=8080
CONTAINER_PORT=8080
NETWORK="magenta-network"

echo Stopping container...
docker stop ${CONTAINER}

echo Deleting previous CONTAINER...
docker rm ${CONTAINER}

echo Building new container...
docker build -t custom-php:7.4.33-cli .

echo Creating new CONTAINER...
docker run -it --name ${CONTAINER} --network ${NETWORK} -p ${HOST_PORT}:${CONTAINER_PORT} custom-php:7.4.33-cli
