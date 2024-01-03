php:
	docker exec -it ldv_app bash

psql:
	docker exec -it ldb_db psql -U postgres

nginx_reload:
	docker exec ldv_nginx nginx -s reload
