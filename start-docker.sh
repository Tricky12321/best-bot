echo "Building image...";
docker build . -t tvi/translate
echo "Starting docker containers..."
docker-compose up -d
echo "Done"