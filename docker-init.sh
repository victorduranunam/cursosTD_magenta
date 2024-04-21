#!/bin/bash

# Stop the container
docker stop magenta

docker rm magenta

docker run -d --name=magenta -p 8080:8080 -v $PWD:/var/www/html php:7.2-apache

docker exec -it magenta bash
