#!/bin/bash

# Stop the container
docker stop magestic

docker rm magestic

docker run -d --name=magestic -p 8080:8080 -v $PWD:/var/www/html php:7.2-apache

docker exec -it magestic bash
