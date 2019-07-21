name = mdpopen/gearman-worker
tags = 1.1.17 1.1.17-php5.6 1.1.17-php5.6-alpine 1.1.17-php5.6-alpine3.8

clean:
	docker rmi -f $$(docker images  $(name) -q)

build:
	docker build --rm -t $(name) .

tag:
	echo $(tags) | awk '{for(i=1;i<NF;i++){print $$i}}' | xargs -I % docker tag $(name):latest $(name):%
