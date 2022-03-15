docker container rm test-composer-container 2> /dev/null;
docker run -it --name='test-composer-container' -v `pwd`:/best-bot tvi/translate composer update;
docker container rm test-composer-container 2> /dev/null;