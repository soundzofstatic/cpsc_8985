#!/bin/bash

echo "Provide the filename (with path) to the MySql dump you want to replace with."

read dumpname

mysql --defaults-extra-file=mysql-cred.cnf better_reviews < $dumpname
