echo "Building image...";
docker build . -t tvi/translate --platform linux/amd64;
echo "Starting docker containers..."
docker-compose up -d
echo "Done"