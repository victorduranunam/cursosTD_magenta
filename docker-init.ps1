$container = "magenta-web"
$host_port = 8080
$container_port = 8080
$network = "magenta-network"

Write-Output "Stopping container..."
docker stop ${container}

Write-Output "Deleting previous container..."
docker rm ${container}

Write-Output "Building new container..."
docker build -t custom-php:7.4.33-cli .

Write-Output "Creating new container..."
docker run -it --name ${container} `
  --network ${network} `
  -p ${host_port}:${container_port} `
  custom-php:7.4.33-cli