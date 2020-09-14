#!/bin/bash

mysqldump --defaults-extra-file=mysql-cred.cnf better_reviews > $(date +%Y%m%d-%H%M%S)-better_reviews.sql
